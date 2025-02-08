<?php

namespace App\Livewire\Post;

use Livewire\Component;

class Item extends Component
{
    public $post;

    public $body;

    public function render()
    {
        return view('livewire.post.item');
    }
}
