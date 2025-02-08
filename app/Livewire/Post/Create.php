<?php

namespace App\Livewire\Post;

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
}
