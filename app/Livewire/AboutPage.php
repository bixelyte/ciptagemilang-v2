<?php

namespace App\Livewire;

use App\Models\CompanySetting;
use App\Models\CompanyStat;
use Livewire\Component;

class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.about-page', [
            'stats' => CompanyStat::active()->ordered()->get(),
            'aboutDescription' => CompanySetting::get('about_description', ''),
            'aboutMission' => CompanySetting::get('about_mission', ''),
            'aboutVision' => CompanySetting::get('about_vision', ''),
            'companyName' => CompanySetting::get('company_name', 'PT. CIPTA GEMILANG TEKNIK MANDIRI'),
        ])->layout('components.layouts.app', ['title' => 'About Us | CIPTA GEMILANG']);
    }
}
