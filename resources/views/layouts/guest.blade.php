<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AuraCare') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-clinic-text antialiased bg-[#FAFAFA]">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        <div>
            <a href="/">
                <span class="font-serif text-4xl font-bold text-clinic-rose tracking-tight">AuraCare.</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-xl shadow-clinic-rose/10 overflow-hidden sm:rounded-3xl border border-gray-100">
            {{ $slot }}
        </div>
        
    </div>
</body>
</html>