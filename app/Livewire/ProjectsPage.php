<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectsPage extends Component
{
    use WithPagination;

    public string $search = '';
    public string $yearFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingYearFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Project::active()->ordered();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%')
                  ->orWhere('scope', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->yearFilter) {
            $query->where('year', $this->yearFilter);
        }

        $years = Project::active()->distinct()->pluck('year')->sort()->reverse();

        return view('livewire.projects-page', [
            'projects' => $query->paginate(9),
            'years' => $years,
        ])->layout('components.layouts.app', ['title' => 'Projects | CIPTA GEMILANG']);
    }
}
