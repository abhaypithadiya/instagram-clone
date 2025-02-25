<div wire:key="reply-{{$reply->id}}" class="flex items-center gap-3 w-11/12 ml-auto py-2">
    <x-avatar wire:ignore src="https://imgs.search.brave.com/C7ZIjfosJDy_SzqTCEKb6rqC43X2SMHqL-ZFb64IWxc/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93YWxs/cGFwZXJjYXZlLmNv/bS93cC93cDU2MDk4/MzkucG5n" class="h-9 w-9 mb-auto" />
    <div class="grid grid-cols-7 w-full gap-2">
        {{-- comment  --}}
        <div class="col-span-6 flex flex-wrap text-sm">
            <p>
                <span class="font-bold text-sm"> {{$reply->user->name}} </span>
                {{$reply->body}}
            </p>
        </div>

        {{-- like --}}
        <div class="col-span-1 flex text-right justify-end mb-auto">
            <button class="font-bold text-sm ml-auto">
                <span wire:click='toggleCommentLike({{$reply->id}})'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.9"
                        stroke="currentColor" class="w-3 h-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                    </svg>
                </span> 
            </button>
        </div>

        {{-- footer --}}
        <div class="col-span-7 flex gap-2 text-sm items-center text-gray-700">
            <span> {{$reply->created_at->diffForHumans()}}</span>
            <span class="font-bold">
                @if ($reply->totalLikers>0 && !$reply->hide_like_view)
                 {{$reply->totalLikers}} {{$reply->totalLikers>1? 'likes':'like'}}
                @endif
            </span>
            <button wire:click="setParent({{$reply->id}})" class="font-semibold">Reply</button>
        </div>
    </div>
</div>


@if ($reply->replies->count()>0)
@foreach ($reply->replies as $reply )
    {{-- Reply --}}
    @include('livewire.post.view.partials.reply')
@endforeach
@endif