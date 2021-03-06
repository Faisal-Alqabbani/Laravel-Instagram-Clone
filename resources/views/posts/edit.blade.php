<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <div class="text-2xl ml:text-5xl mt-7">
            <h1 class="text-2xl ml:text-5xl mt-7">{{__('Edit Post')}}</h1>
            </div>
        </div>
    </x-slot>

    <div class="grid grid-col-5 mt-7">
        <form action="/posts/{{$post->id}}" class="col-start-2 col-span-3 max-w-4xl" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <div>
                <x-jet-label>{{__('Caption')}}</x-jet-label>
                <x-jet-input class="block mt-1 w-full h-20" type="textarea" name="post_caption" :value="old('post_caption')" value="{{$post->post_caption}}" autofoucs />
            </div>
            <div class="mt-4">
                <x-jet-label>{{__('Image')}}</x-jet-label>
                <x-jet-input class="block mt-1 bg-white w-full p-2" type="file" name="image_path" :value="old('image_path')" value="{{$post->image_path}}" autocomplet="off"/>
            </div>
            <x-jet-button class="mt-4">
                {{__('Update')}}
            </x-jet-button>
        </form>
    </div>
</x-app-layout>