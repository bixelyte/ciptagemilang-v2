<?php

namespace App\Livewire;

use App\Models\CompanySetting;
use App\Models\ContactMessage;
use Livewire\Component;

class ContactPage extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $company = '';
    public string $subject = '';
    public string $message = '';

    public bool $submitted = false;

    protected $rules = [
        'name' => 'required|min:2|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|max:20',
        'company' => 'nullable|max:255',
        'subject' => 'required|min:3|max:255',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company' => $this->company,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'phone', 'company', 'subject', 'message']);
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.contact-page', [
            'companyAddress' => CompanySetting::get('company_address', ''),
            'companyPhone' => CompanySetting::get('company_phone', ''),
            'companyEmail' => CompanySetting::get('company_email', ''),
        ])->layout('components.layouts.app', ['title' => 'Contact Us | CIPTA GEMILANG']);
    }
}
