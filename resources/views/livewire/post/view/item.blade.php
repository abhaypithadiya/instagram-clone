<div class="grid lg:grid-cols-12 gap-3 h-full w-full overflow-hidden">

    <aside class=" hidden lg:flex lg:col-span-7 m-auto items-center w-full overflow-scroll">
        <div
            class="relative flex overflow-x-scroll overscroll-contain w-[500px] selection:snap-x snap-mandatory gap-2 px-2">
            @foreach ($post->media as $key =>$file)
            <div class="w-full h-full shrink-0 snap-always snap-center">
                @switch($file->mime)
                @case('video')
                <x-video source="{{$file->url}}" />
                @break
                @case('image')
                <img src="{{$file->url}}" alt="image" class="h-full w-full block object-scale-down">
                @break
                @default
                @endswitch
            </div>
            @endforeach
        </div>
    </aside>
    <aside class="lg:col-span-5 h-full scrollbar-hide relative flex gap-4 flex-col overflow-hidden overflow-y-scroll">
        <header class="flex  items-center gap-3 border-b py-2  sticky  top-0 bg-white z-10 ">
            <x-avatar wire:ignore story src="https://imgs.search.brave.com/C7ZIjfosJDy_SzqTCEKb6rqC43X2SMHqL-ZFb64IWxc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJjYXZlLmNv/bS93cC93cDU2MDk4/MzkucG5n" class="h-9 w-9" />
            <div class="grid grid-cols-7 w-full gap-2">
                <div class="col-span-5">
                    <h5 class="font-semibold truncate text-sm">{{$post->user->name}} </h5>
                </div>
            </div>
        </header>
</div>
