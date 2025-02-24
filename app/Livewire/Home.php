<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

final class Home extends Component
{
    public $posts;

    public $canLoadMore;

    public $perPageIncrements = 5;

    public $perPage = 10;

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
        $this->loadPosts();
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function loadMore()
    {
        if (! $this->canLoadMore) {
            return null;
        }

        $this->perPage += $this->perPageIncrements;
        $this->loadPosts();
    }

    public function loadPosts()
    {

        $this->posts = Post::with('comments.replies')
            ->latest()
            ->take($this->perPage)->get();

        $this->canLoadMore = (count($this->posts) >= $this->perPage);

    }
}
