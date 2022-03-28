<div class="min-h-screen flex flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        <img src="logo1.jpg" alt="logo" class='xl:w-80 xl:h-80 md:h-64 md:w-64 w-0 h-0 me-12' />
    </div>

    <div class="felx felx-col">
         <div class="w-full sm:max-w-md mt-6 pe-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
        @if(str_contains(url()->current(), 'login'))
        <div class="w-full sm:max-w-md mt-6 pe-6 py-4 bg-white shadow-md overflow-hidden sm-rounded-lg flex justify-center items-center">
            <span class="text-sm text-gray-600 pe-5">{{__("Dont't have an account")}} <a href="{{route('register')}}" class="text-blue-700 hover:text-blue-900 text-base font-blod mx-2">{{__("Sign Up")}}</a></span>
        </div>
        @endif
    </div>

</div>
