<div x-data="{

canLoadMore:@entangle('canLoadMore')

}" @scroll.window.trottle="

scrollTop= window.scrollY ||window.scrollTop;
divHeight= window.innerHeight||document.documentElement.clientHeight;
scrollHeight = document.documentElement.scrollHeight;

isScrolled= scrollTop+ divHeight >= scrollHeight-1;

if(isScrolled && canLoadMore){
  @this.loadMore();
}" 
class="w-full h-full">

{{-- Header --}}
<header class="md:hidden sticky top-0 z-50 bg-white">
  <div class="grid grid-cols-12 gap-2 items-center">
    <div class="col-span-3">
      <img src="{{asset('assets/logo.png')}}" class="h-12 max-w-lg w-full" alt="logo">
    </div>
    <div class="col-span-8 flex justify-center px-2">
      <input type="text" placeholder="Search"
        class=" border-0 outline-none w-full focus:outline-none bg-gray-100 rounded-lg focus:ring-0 hover:ring-0">
    </div>
    <div class="col-span-1 flex justify-center">
      <a href="#">
        <span>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
          </svg>
        </span>
      </a>
    </div>
  </div>
</header>

{{-- main --}}
<main class="grid lg:grid-cols-12 gap-8 md:mt-10 ">
  <aside class="lg:col-span-8 overflow-hidden">
    <section>
      <ul class="flex overflow-x-auto scrollbar-hide items-center gap-2">
        @for ($i = 0; $i < 10; $i++) <li class="flex flex-col justify-center w-20 gap-1 p-2">
          <x-avatar wire:ignore story src="https://imgs.search.brave.com/C7ZIjfosJDy_SzqTCEKb6rqC43X2SMHqL-ZFb64IWxc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJjYXZlLmNv/bS93cC93cDU2MDk4/MzkucG5n" class="h-14 w-14" />
          <p class="text-xs font-medium truncate" wire:ignore> {{fake()->name}} </p>
          </li>
          @endfor
      </ul>
    </section>
    <section class="mt-5 p-2 space-y-4">
      @forelse ($posts as $post)
        @livewire('post.item',['post' => $post], key('post-'.$post->id))
      @empty
        <p class="font-bold flex justify-center">No Posts Found</p>
      @endforelse
    </section>
  </aside>


  {{-- sugestions --}}
  <aside class="lg:col-span-4 hidden lg:block p-4">
    <div class="flex items-center gap-2">
        <x-avatar wire:ignore src="https://imgs.search.brave.com/sJ1ac6WsghAy3PGvgm85rEJULE_LS2b6nZG3RZrir4M/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/dGFsZW50dmlldy5j/b20vd3AtY29udGVu/dC91cGxvYWRzL0Zl/YXR1cmVkLUltYWdl/LU1ha2VyLTUwMHg1/MDAtNi5wbmc" class="w-12 h-12" />
        <h4 class="font-medium" wire:ignore>{{fake()->name}} </h4>
    </div>
    <section class="mt-4">
        <h4 class="font-bold text-gray-700/95">Suggestions for you </h4>
        <ul class="my-2 space-y-3">
            @for ($i=0;$i<5;$i++)                
            <li class="flex items-center gap-3">
              <a href="javascript:void(0)" >
                <x-avatar wire:ignore src="https://imgs.search.brave.com/sJ1ac6WsghAy3PGvgm85rEJULE_LS2b6nZG3RZrir4M/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/dGFsZW50dmlldy5j/b20vd3AtY29udGVu/dC91cGxvYWRzL0Zl/YXR1cmVkLUltYWdl/LU1ha2VyLTUwMHg1/MDAtNi5wbmc" class="w-12 h-12" />
              </a>
              <div class="grid grid-cols-7 w-full gap-2">
                <div class="col-span-5">
                  <a href="javascript:void(0)" class="font-semibold truncate text-sm">{{fake()->name}}</a>
                  <p class="text-xs truncate" wire:ignore> Followed by {{fake()->name}} </p>
                </div>
                <div class="col-span-2 flex text-right justify-end">
                  <button class="font-bold text-blue-500 ml-auto text-sm">Follow</button> 
                </div>
              </div>
            </li>
            @endfor
        </ul>
    </section>
    <section class="mt-10">
        <ol class="flex gap-2 flex-wrap">
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">About</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Help</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">API</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Jobs</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Privacy</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Terms</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">Locations</a></li>
          <li class="text-xs text-gray-800/90 font-medium"><a href="#" class="hover:underline">About</a></li>
        </ol>
        <h3 class="text-gray-800/90 mt-6 text-sm"> @ 2023 INTAGRAM COURSE </h3>
    </section>
  </aside>


</main>

</div>