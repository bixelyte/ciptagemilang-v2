<?php

use App\Livewire\AboutPage;
use App\Livewire\ClientsPage;
use App\Livewire\ContactPage;
use App\Livewire\HomePage;
use App\Livewire\ProjectsPage;
use App\Livewire\ServicesPage;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/id');

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'id|en'], 'middleware' => [App\Http\Middleware\SetLocale::class]], function () {
    Route::get('/', HomePage::class)->name('home');
    Route::get('/services', ServicesPage::class)->name('services');
    Route::get('/projects', ProjectsPage::class)->name('projects');
    Route::get('/clients', ClientsPage::class)->name('clients');
    Route::get('/about', AboutPage::class)->name('about');
    Route::get('/contact', ContactPage::class)->name('contact');
});
