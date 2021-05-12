<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <livewire:styles />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <livewire:scripts />
    </head>

    <body class="flex justify-center">

    <div class="w-10/12 my-10 flex">

        <div class="w-5/12 rounded border p-2">
            <livewire:tickets />
        </div>

        <div class="w-7/12 mx-2 rounded border ">
            <livewire:comments />
        </div>

    </div>
    
    </body>
</html>
