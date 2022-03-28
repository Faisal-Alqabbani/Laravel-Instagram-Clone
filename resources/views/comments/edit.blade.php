<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <div class="text-2xl ml:text-5xl mt-7">
            <h1 class="text-2xl ml:text-5xl mt-7">{{__('Edit Comment')}}</h1>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-col-5 mt-7">
        <form action="/comments/{{$comment->id}}" class="col-start-2 col-span-3 max-w-4xl" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <div>
                <x-jet-label>{{__('Comment')}}</x-jet-label>
                <x-jet-input class="block mt-1 w-full h-20" type="textarea" name="comment" :value="old('comment')" value="{{$comment->comment}}" autofoucs />
            </div>
      
            <x-jet-button class="mt-4">
                {{__('Update Comment')}}
            </x-jet-button>
        </form>
    </div>
</x-app-layout>