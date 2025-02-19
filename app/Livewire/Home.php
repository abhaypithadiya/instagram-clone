<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

final class Home extends Component
{
    public $posts;

    #[On('closeModal')]
    public function revertUrl()
    {
        $this->js("history.replaceState({},'','/')");
    }

    #[On('post-created')]
    public function postCreated($id)
    {
        $post = Post::find($id);
        $this->posts = $this->posts->prepend($post);
    }

    public function mount()
    {
        $this->posts = Post::with('comments')->latest()->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
