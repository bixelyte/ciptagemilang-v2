<?php

namespace App\Livewire;

use App\Models\Client;
use Livewire\Component;

class ClientsPage extends Component
{
    public function render()
    {
        return view('livewire.clients-page', [
            'clients' => Client::active()->ordered()->withCount('projects')->get(),
        ])->layout('components.layouts.app', ['title' => 'Our Clients | CIPTA GEMILANG']);
    }
}
