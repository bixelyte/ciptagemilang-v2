<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class ServicesPage extends Component
{
    public function render()
    {
        return view('livewire.services-page', [
            'services' => Service::active()->ordered()->get(),
        ])->layout('components.layouts.app', ['title' => 'Our Services | CIPTA GEMILANG']);
    }
}
