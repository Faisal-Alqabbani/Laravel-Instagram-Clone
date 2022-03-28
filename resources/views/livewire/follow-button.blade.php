<div>
    {{-- Success is as dangerous as failure. --}}
    <button class="bg-blue-500 rounded-lg shadow pe-2 py-1 text-white" 
    wire:model="follow-button"
    wire:click="ToggleFollowing({{$profile_id}})"
    >{{$following }} </button>
</div>
