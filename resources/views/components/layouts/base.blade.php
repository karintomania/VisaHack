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
    <body class="text-neutral-500 bg-neutral-100">
        <x-layouts.header/>
        <main class="flex flex-col items-center px-4">
          {{ $slot }}
        </main>
    </body>
</html>
