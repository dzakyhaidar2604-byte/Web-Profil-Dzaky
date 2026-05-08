<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ChatbotController;

// Halaman Utama Frontend
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::post('/contact', [FrontController::class, 'storeContact'])->name('contact.store');

// Endpoint API Chatbot
Route::post('/api/chat', [ChatbotController::class, 'chat'])->name('api.chat');

// (Routing Breeze Auth & Admin Panel diasumsikan otomatis dari instalasi Laravel Breeze)