<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ServiceDetailPage extends Component
{
    public Service $service;
    public $otherServices;

    public function mount($slug)
    {
        $this->service = Service::where('slug', $slug)->active()->firstOrFail();
        $this->otherServices = Service::where('id', '!=', $this->service->id)
            ->active()
            ->inRandomOrder()
            ->take(3)
            ->get();
    }

    public function render()
    {
        return view('livewire.service-detail-page');
    }
}
