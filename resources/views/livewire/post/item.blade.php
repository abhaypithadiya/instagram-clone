<div class="max-w-lg mx-auto">
    {{-- header --}}
    <header class="flex items-center gap-3">
        <x-avatar wire:ignore src="https://imgs.search.brave.com/C7ZIjfosJDy_SzqTCEKb6rqC43X2SMHqL-ZFb64IWxc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJjYXZlLmNv/bS93cC93cDU2MDk4/MzkucG5n" class="h-9 w-9" />
        <div class="grid grid-cols-7 w-full gap-2">
            <div class="col-span-5">
                <h5 class="font-semibold truncate text-sm"> {{$post->user->name}} </h5>
            </div>
            <div class="col-span-2 flex text-right justify-end">
                <button class="text-gray-500 ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                        <path
                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </header>
    <main>
        <div x-init="

        new Swiper($el,{

            modules: [Navigation, Pagination],
            loop:true,

            pagination: {
                el: '.swiper-pagination',
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

        });
        
        " class="swiper h-[500px] border bg-white">
            <ul x-cloak class="swiper-wrapper">
                @foreach ($post->media as $file)
                <li class="swiper-slide">
                @switch($file->mime)
                    @case('video')
                        @include('components.video',['source' => $file->url])
                        @break
                    @case('image')
                        <img src="{{$file->url}}" alt="" class="h-[500px] w-full block object-scale-down">
                        @break
                    @default
                @endswitch
                @endforeach
                </li>
            </ul>
            <div class="swiper-pagination"></div>
            @if (count($post->media) > 1)
            <div class="swiper-button-prev absolute top-1/2 z-10 p-2 cursor-pointer">
                <div class=" bg-white/95 border p-1 rounded-full text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </div>
            </div>
            <div class="swiper-button-next absolute right-0 top-1/2 z-10 p-2 cursor-pointer">
                <div class=" bg-white/95 border p-1 rounded-full text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.8"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </div>
            @endif
            <div class="swiper-scrollbar"></div>
        </main>
        <footer>

            {{-- actions --}}
            <div class=" flex gap-4 items-center my-2">

                {{-- heart --}}
                <button wire:click='togglePostLike()'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>

                </button>

                {{-- comment --}}
                <button
                    onclick="Livewire.dispatch('openModal',{component:'post.view.modal',arguments:{'post':1}})">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 006 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337z" />
                    </svg>

                </button>

                {{-- forward --}}
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-send w-5 h-5" viewBox="0 0 16 16">
                        <path
                            d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                    </svg>
                </span>

                {{-- Bookmark/favorites --}}
                <span class="ml-auto">

                    <button wire:click='toggleFavorite()'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                        </svg>
                    </button>
                </span>

            </div>

            {{-- likes and views --}}
            <p class="font-bold text-sm">1234 likes</p>

            {{-- name and comment --}}
            <div class="flex text-sm gap-2 font-medium">
                <p> <strong class="font-bold">{{$post->user->name}} </strong>
                    {{$post->description}}
                </p>
            </div>

            {{-- view post modal --}}
            <button onclick="Livewire.dispatch('openModal',{component:'post.view.modal',arguments:{'post': {{$post->id}}}})"
                class="text-slate-500/90 text-sm font-medium"> View all {{$post->comments->count()}} comments </button>

            {{-- show comments for auth --}}
            <ul class="my-2">
                @for ($i = 0; $i < 3; $i++)
                    <li class="grid grid-cols-12 text-sm items-center">
                    <span class="font-bold col-span-3 mb-auto">{{fake()->name()}} </span>
                    <span class="col-span-8">{{fake()->text()}} </span>
                    <button class="col-span-1 mb-auto flex justify-end pr-px">
                        <span wire:click='toggleCommentLike(1)'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                                stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>

                        </span>
                    </button>
                    </li>
                    @endfor
            </ul>

            {{-- leave comment --}}
            <form wire:key='{{time()}}' @submit.prevent="$wire.addComment()" x-data="{body:@entangle('body')}"
                class="grid grid-cols-12 items-center w-full">
                @csrf

                <input x-model="body" type="text" placeholder=" Leave a comment "
                    class="border-0 col-span-10 placeholder:text-sm outline-none focus:outline-none px-0 rounded-lg hover:ring-0 focus:ring-0">
                <div class="col-span-1 ml-auto flex justify-end text-right">
                    <button type="submit" x-cloak x-show="body.length>0"
                        class="text-sm font-semibold flex justify-end text-blue-500">
                        Post
                    </button>
                </div>

                <span class="col-span-1 ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                    </svg>
                </span>

            </form>
            </footer>
        </div>