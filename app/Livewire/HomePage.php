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
use Livewire\WithPagination;

class HomePage extends Component
{
    use WithPagination;
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

    // Projects Datatable Properties
    public $searchProject = '';
    public $filterYear = '';
    public $filterScope = '';
    public $filterType = '';
    public $sortField = 'year';
    public $sortDirection = 'desc';

    public function updatingSearchProject() { $this->resetPage('projectsPage'); }
    public function updatingFilterYear() { $this->resetPage('projectsPage'); }
    public function updatingFilterScope() { $this->resetPage('projectsPage'); }
    public function updatingFilterType() { $this->resetPage('projectsPage'); }

    public function sortProjects($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        // Query for paginated all projects
        $allProjectsQuery = Project::active();

        if ($this->searchProject) {
            $allProjectsQuery->where(function($q) {
                $q->where('title', 'like', '%' . $this->searchProject . '%')
                  ->orWhere('location', 'like', '%' . $this->searchProject . '%');
            });
        }

        if ($this->filterYear) {
            $allProjectsQuery->where('year', $this->filterYear);
        }

        if ($this->filterScope) {
            $allProjectsQuery->where('scope', 'like', '%' . $this->filterScope . '%');
        }

        if ($this->filterType) {
            $allProjectsQuery->where('type', 'like', '%' . $this->filterType . '%');
        }

        $allProjectsQuery->orderBy($this->sortField, $this->sortDirection);
        $allProjects = $allProjectsQuery->paginate(10, ['*'], 'projectsPage');

        $availableYears = Project::active()->select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $availableTypes = Project::active()->pluck('type')
            ->flatMap(function ($typeGroup) {
                return array_map('trim', explode(',', $typeGroup ?: ''));
            })
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();

        return view('livewire.home-page', [
            'banners'        => HeroBanner::active()->ordered()->get(),
            'stats'          => CompanyStat::active()->ordered()->get(),
            'services'       => Service::active()->ordered()->get(),
            'projects'       => Project::active()->featured()->ordered()->take(6)->get(),
            'allProjects'    => $allProjects,
            'availableYears' => $availableYears,
            'availableTypes' => $availableTypes,
            'clients'        => Client::active()->ordered()->get(),
            // About Us
            'companyName'    => CompanySetting::get('company_name', 'PT. CIPTA GEMILANG TEKNIK MANDIRI'),
            'aboutDescription' => CompanySetting::get('about_description', ''),
            'aboutMission'   => CompanySetting::get('about_mission', ''),
            'aboutVision'    => CompanySetting::get('about_vision', ''),
            // Contact
            'companyAddress' => CompanySetting::get('company_address', ''),
            'companyPhone'   => CompanySetting::get('company_phone', ''),
            'companyFax'     => CompanySetting::get('company_fax', ''),
            'companyEmail'   => CompanySetting::get('company_email', ''),
        ])->layout('components.layouts.app', ['title' => 'CIPTA GEMILANG TEKNIK MANDIRI | Home']);
    }
}
