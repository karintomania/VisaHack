<div>

</div>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
         @vite('resources/js/app.js')
         @vite('resources/css/app.css')

        <title>VisaHack</title>

    </head>
    <body class="text-gray-400 bg-base">
        <x-layouts.header/>

        <div class="relative">
        <div class="opacity-10 rounded-3xl relative -top-4 left-0 bg-main z-0 h-20 w-40 sm:h-40 md:w-72 blur-2xl md:blur-3xl"></div>
        <main class="flex flex-col items-center z-10">
          {{ $slot }}
        </main>
        </div>
    </body>
</html>
