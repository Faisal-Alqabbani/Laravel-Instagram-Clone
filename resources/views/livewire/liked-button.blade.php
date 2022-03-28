<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{-- link posts with liked button .php --}}
   

    <div class="flex flex-col items-start ps-5 pb-1">
        <div class="flex flex-row items-center">
            <button class="text-2xl me-3 foucs:outline-none" wire:model="liked-button" wire:click="ToggleLike({{$post_id}})">
                <i class="{{$isLiked ? "fa fa-heart text-blue-700":"fa fa-heart"}}"></i> 
            </button>
            <button class="text-2xl me-3 foucs:outline-none" onClick="document.getElementById('comment{{$post_id}}').focus()">
                <i class="fa fa-comment"></i>
            </button>
            <button class="text-2xl me-3 foucs:outline-none" onClick="copyToClipboard({{$post_id}})" id={{$post_id}} value="{{url('')}}/posts/{{$post_id}}">
                <i class="fa fa-share-square"></i>
            </button>
        </div>
        <span>{{__('Liked by')}}: {{$likeCount}}</span>
    </div>

    
</div>
