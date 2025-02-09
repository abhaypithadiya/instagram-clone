<?php

namespace App\Livewire\Post;

use App\Models\Media;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class Create extends ModalComponent
{
    use WithFileUploads;

    public $media = [];

    public $description;

    public $location;

    public $hide_like_view = false;

    public $allow_commenting = false;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function render()
    {
        return view('livewire.post.create');
    }

    public function submit()
    {
        $this->validate([
            'media.*' => ['required', 'file', 'mimes:png,jpg,mp4,jpeg,mov', 'max:100000'],
            'allow_commenting' => ['boolean'],
            'hide_like_view' => ['boolean'],
        ]);

        $type = $this->getPostType($this->media);

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'description' => $this->description,
            'location' => $this->location,
            'allow_commenting' => $this->allow_commenting,
            'hide_like_view' => $this->hide_like_view,
            'type' => $type,
        ]);

        foreach ($this->media as $media) {
            $mime = $this->getMime($media);
            $path = $media->store('media', 'public');

            $url = url(Storage::url($path));

            Media::create([
                'url' => $url,
                'mime' => $mime,
                'mediable_id' => $post->id,
                'mediable_type' => Post::class,
            ]);

            $this->reset();
            $this->dispatch('close');

            $this->dispatch('post-created', $post->id);
        }
    }

    private function getMime($media): string
    {
        if (str()->contains($media->getMimeType(), 'video')) {
            return 'video';
        } else {
            return 'image';
        }
    }

    private function getPostType($media): string
    {
        if (count($media) === 1 && str()->contains($media[0]->getMimeType(), 'video')) {
            return 'reel';
        } else {
            return 'post';
        }
    }
}
