<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AuraCare | Skincare & Aesthetic Clinic</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAFAFA] font-sans text-clinic-text antialiased selection:bg-clinic-rose selection:text-white">

    <nav class="bg-white/90 backdrop-blur-md shadow-sm py-4 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center">
                <span class="font-serif text-2xl font-bold text-clinic-rose">AuraCare.</span>
            </div>
            <div class="space-x-6 text-sm font-medium flex items-center">
                <a href="{{ route('patient.services') }}" class="text-gray-500 hover:text-clinic-rose transition">Services</a>
                
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-clinic-dark font-semibold">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-clinic-rose transition">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-clinic-rose hover:bg-clinic-dark text-white px-5 py-2 rounded-full transition shadow-sm">Sign Up</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 flex flex-col md:flex-row items-center gap-12">
        
        <div class="md:w-1/2 space-y-6 text-center md:text-left">
            <span class="text-clinic-rose font-medium tracking-wider uppercase text-sm">Welcome to your best skin</span>
            <h1 class="font-serif text-5xl md:text-6xl font-bold leading-tight text-gray-900">
                Reveal your <br> <span class="text-clinic-rose italic">natural</span> radiance.
            </h1>
            <p class="text-lg text-gray-500 max-w-md mx-auto md:mx-0">
                Experience personalized aesthetic treatments designed to rejuvenate, heal, and enhance your skin. Book your appointment today.
            </p>
            <div class="pt-4">
                <a href="{{ route('appointments.book') }}" class="bg-clinic-rose hover:bg-clinic-dark text-white px-8 py-3 rounded-full text-lg font-medium transition shadow-md inline-block transform hover:-translate-y-1">
                    Book an Appointment
                </a>
            </div>
        </div>

        <div class="md:w-1/2 mt-12 md:mt-0 flex justify-center">
            <div class="relative w-[350px] h-[450px] bg-clinic-light rounded-[3rem] shadow-2xl flex items-center justify-center overflow-hidden border-4 border-white">
                <div class="absolute w-40 h-40 bg-clinic-blush rounded-full mix-blend-multiply filter blur-2xl opacity-70 top-10 left-10 animate-pulse"></div>
                <div class="absolute w-40 h-40 bg-white rounded-full mix-blend-multiply filter blur-2xl opacity-70 bottom-10 right-10"></div>
                
                <img src="https://images.unsplash.com/photo-1616683693504-3ea7e9ad6fec?q=80&w=800&auto=format&fit=crop" alt="Aesthetic Skincare Procedure" class="w-full h-full object-cover relative z-10 opacity-90 hover:opacity-100 transition duration-500">
            </div>
        </div>
    </main>

</body>
</html>