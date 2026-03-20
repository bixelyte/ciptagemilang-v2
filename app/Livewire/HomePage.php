<?php

namespace App\Livewire;

use App\Models\Client;
use App\Models\CompanySetting;
use App\Models\CompanyStat;
use App\Models\ContactMessage;
use App\Models\HeroBanner;
use App\Models\Project;
use App\Models\Service;
use Livewire\Component;

class HomePage extends Component
{
    // Contact form fields
    public string $contactName = '';
    public string $contactEmail = '';
    public string $contactPhone = '';
    public string $contactCompany = '';
    public string $contactSubject = '';
    public string $contactMessage = '';
    public bool $contactSubmitted = false;

    protected function rules(): array
    {
        return [
            'contactName'    => 'required|min:2|max:255',
            'contactEmail'   => 'required|email|max:255',
            'contactPhone'   => 'nullable|max:20',
            'contactCompany' => 'nullable|max:255',
            'contactSubject' => 'required|min:3|max:255',
            'contactMessage' => 'required|min:10',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'contactName'    => 'name',
            'contactEmail'   => 'email',
            'contactPhone'   => 'phone',
            'contactCompany' => 'company',
            'contactSubject' => 'subject',
            'contactMessage' => 'message',
        ];
    }

    public function submitContact()
    {
        $this->validate();

        ContactMessage::create([
            'name'    => $this->contactName,
            'email'   => $this->contactEmail,
            'phone'   => $this->contactPhone,
            'company' => $this->contactCompany,
            'subject' => $this->contactSubject,
            'message' => $this->contactMessage,
        ]);

        $this->reset(['contactName', 'contactEmail', 'contactPhone', 'contactCompany', 'contactSubject', 'contactMessage']);
        $this->contactSubmitted = true;
    }

    public function render()
    {
        return view('livewire.home-page', [
            'banners'        => HeroBanner::active()->ordered()->get(),
            'stats'          => CompanyStat::active()->ordered()->get(),
            'services'       => Service::active()->ordered()->get(),
            'projects'       => Project::active()->featured()->ordered()->take(6)->get(),
            'clients'        => Client::active()->ordered()->get(),
            // About Us
            'companyName'    => CompanySetting::get('company_name', 'PT. CIPTA GEMILANG TEKNIK MANDIRI'),
            'aboutDescription' => CompanySetting::get('about_description', ''),
            'aboutMission'   => CompanySetting::get('about_mission', ''),
            'aboutVision'    => CompanySetting::get('about_vision', ''),
            // Contact
            'companyAddress' => CompanySetting::get('company_address', ''),
            'companyPhone'   => CompanySetting::get('company_phone', ''),
            'companyEmail'   => CompanySetting::get('company_email', ''),
        ])->layout('components.layouts.app', ['title' => 'CIPTA GEMILANG TEKNIK MANDIRI | Home']);
    }
}
