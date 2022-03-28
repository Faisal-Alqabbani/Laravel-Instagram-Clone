<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <style>
            .post{
                position: relative;
                flex: 1 0 220px;
                color: #fff;
                width: 293px;
                height: 293px;
                
            }
            .post:hover .post-info,
            .post:focus .post-info{
                display: flex;
                justify-content: center;
                align-items: center;
                position: absolute;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.3);
            }
            .post-info{
                display:none;
            }
            .rtl{
                direction: rtl;
            }
            .lrt{
                direction: ltr;
            }
        </style>
    </head>
    <body class="font-sans antialiased {{isset($rtl) ? 'rtl':"ltr"}}">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                {{ $header }}
            @endif

            <!-- Page Content -->
            <main class="mt-10 pb-2">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        
        <script type="text/javascript">
            var img = document.getElementById('postImage');
            var sec1 = document.getElementById('sec1');
            var sec3 = document.getElementById('sec3');
            var sec4 = document.getElementById('sec4');
            if(img !== null){
                var imgHeight = img.offsetHeight;
                var sec1Height = sec1.offsetHeight;
                var sec3Height = sec3.offsetHeight;
                var sec4Height = sec4.offsetHeight;
                var height = imgHeight - (sec1Height + sec3Height + sec4Height);
                document.getElementById('commentArea').style.maxHeight = height.toString() + 'px';
                
            }
            // clipboard 
            function copyToClipboard(id){
                 var postlink = document.getElementById(id); 
                 navigator.clipboard.writeText(postlink.value); 
                 alert("The shareble Link: " + postlink.value);
            }
        </script>
    </body>
</html>
