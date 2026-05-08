@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section id="hero" class="min-h-screen flex items-center justify-center pt-20 px-6">
    <div class="max-w-7xl w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Text & CTA -->
        <div class="space-y-6">
            <h2 class="text-5xl font-extrabold leading-tight">
                Crafting <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-pink-500">Digital</span> Experiences.
            </h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Halo, saya Maszeh. Fullstack Developer yang fokus membangun website modern, kencang, dan memiliki estetika masa kini.
            </p>
            <div class="flex gap-4">
                <a href="#portfolio" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full font-semibold shadow-lg shadow-indigo-500/30 transition-all hover:-translate-y-1">Lihat Karya</a>
                <a href="#contact" class="px-6 py-3 border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 dark:border-indigo-400 rounded-full font-semibold hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition-all">Hubungi Saya</a>
            </div>
        </div>
        
        <!-- 3D Image Placeholder (Gunakan Floating Animation) -->
        <div class="relative flex justify-center animate-[bounce_5s_ease-in-out_infinite]">
            <!-- Glow Effect di belakang gambar -->
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-400 to-pink-400 blur-3xl opacity-30 dark:opacity-50 rounded-full w-3/4 h-3/4 m-auto"></div>
            <!-- Masukkan Foto 3D Manual Anda di sini -->
            <img src="{{ asset('images/my-3d-avatar.png') }}" alt="Maszeh 3D" class="relative z-10 w-80 drop-shadow-2xl hover:scale-105 transition-transform duration-500">
        </div>
    </div>
</section>

<!-- Portfolio Section (Contoh Looping Card 3D Effect) -->
<section id="portfolio" class="py-20 px-6">
    <div class="max-w-7xl mx-auto">
        <h3 class="text-3xl font-bold mb-10 text-center">Featured Projects</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($portfolios as $item)
            <!-- Card dengan Hover 3D Glassmorphism -->
            <div class="glass dark:glass-dark rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 group cursor-pointer">
                <div class="h-48 bg-gray-200 dark:bg-gray-700 overflow-hidden">
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                </div>
                <div class="p-6">
                    <h4 class="font-bold text-xl mb-2">{{ $item->title }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($item->description, 80) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection