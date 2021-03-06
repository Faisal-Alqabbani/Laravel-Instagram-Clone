<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="grid grid-cols-12 mt-7 gap-4">
        <div class="col-start-5 col-span-4">
            <h3 class="mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl">{{__('Follow Request')}}</h3>
            @if($requests != null && sizeof($requests)> 0)
                @foreach($requests as $req)
                <div class="flex flex-col mb-3">
                    <div class="flex flex-row justify-around">
                        <div class="flex flex-row row">
                            <a href="/{{$req->username}}">
                                <img src="{{$req->profile_photo_url}}" alt="avatar" class="rounded-full w-10 h-10" />
                            </a>
                            <div class="flex flex-col self-centered">
                                <a href="/{{$req->username}}" class="text-base hover:underline whitespace-nowrap">{{$req->username}}</a>
                                <h3 class="text-sm text-gray-500 truncate whitespace-nowrap" style="max-width: 25ch;">{{$req->bio}}</h3>
                            </div>
                        </div>
                        
                        @livewire('accept-follow', ["profile_id" => $req->id], key($req->username))
                        
                        @livewire('follow-button', ["profile_id" => $req->id], key($req->id))
                    </div>
                </div>
                @endforeach
            @else
                <div class="my-10 text-center">
                    <p class="font-semibold">{{__("Nothing to show")}}</p>
                </div>
            @endif

            {{-- pending request which the user sent --}}
            <h3 class="mt-4 mb-4 text-gray-500 font-semibold text-center text-3xl">{{__('Pending Request')}}</h3>
            @if($pendings != null && sizeof($pendings)> 0)
                @foreach($pendings as $pnn)
                <div class="flex flex-col mb-3">
                    <div class="flex flex-row justify-around">
                        <div class="flex flex-row row">
                            <a href="/{{$pnn->username}}">
                                <img src="{{$pnn->profile_photo_url}}" alt="avatar" class="rounded-full w-10 h-10" />
                            </a>
                            <div class="flex flex-col self-centered">
                                <a href="/{{$pnn->username}}" class="text-base hover:underline whitespace-nowrap">{{$pnn->username}}</a>
                                <h3 class="text-sm text-gray-500 truncate whitespace-nowrap" style="max-width: 25ch;">{{$pnn->bio}}</h3>
                            </div>
                        </div>
                        @livewire('follow-button', ["profile_id" => $pnn->id], key($pnn->id))
                    </div>
                </div>
                @endforeach
            @else
                <div class="my-10 text-center">
                    <p class="font-semibold">{{__("Nothing to show")}}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>