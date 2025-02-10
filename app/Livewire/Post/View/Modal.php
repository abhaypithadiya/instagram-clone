<?php

namespace App\Livewire\Post\View;

use App\Models\Post;
use LivewireUI\Modal\ModalComponent;

class Modal extends ModalComponent
{
    public $post;

    public function mount()
    {
        $this->post = Post::findOrFail($this->post);
        $url = url('post/'.$this->post->id);
        $this->js("history.pushState({},'','{$url}')");
    }

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public function render()
    {
        return <<<'BLADE'
        <main class="bg-white  h-[calc(100vh_-_3.5rem)] p-2  md:h-[calc(100vh_-_5rem)] flex flex-col border gap-y-4 px-5">
            <header class="w-full py-2">
                <div class="flex justify-end">
                    <button wire:click="$dispatch('closeModal')" type="button" class="xl font-bold">X</button>
                </div>
            </header>
        </main>
        BLADE;
    }
}
