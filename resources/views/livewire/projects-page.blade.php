<div>
  {{-- Hero --}}
  <section class="relative px-6 pt-40 pb-24 lg:px-20 overflow-hidden">
    <div class="mx-auto max-w-[1440px]">
      <div class="mb-12 flex flex-col items-center text-center">
        <span class="mb-4 inline-block text-xs font-bold uppercase tracking-[0.4em] text-primary bg-background-dark/60 px-3 py-1.5 rounded-sm">Portfolio of Excellence</span>
        <h1 class="mt-4 text-5xl lg:text-7xl font-black uppercase tracking-tighter gold-gradient-text hero-glow-text text-glow-light inline-block">ALL PROJECTS</h1>
      </div>

      {{-- Filters --}}
      <div class="flex flex-col sm:flex-row gap-4 items-center justify-center mb-16">
        <div class="relative">
          <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search projects..." class="h-12 w-64 rounded-lg bg-white/5 border border-white/10 px-4 text-sm text-white placeholder-white/30 focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30" />
        </div>
        <select wire:model.live="yearFilter" class="h-12 rounded-lg bg-white/5 border border-white/10 px-4 text-sm text-white focus:border-primary/50 focus:outline-none focus:ring-1 focus:ring-primary/30">
          <option value="">All Years</option>
          @foreach ($years as $year)
            <option value="{{ $year }}">{{ $year }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </section>

  <x-section-separator />

  {{-- Projects Grid --}}
  <section class="relative px-6 py-20 lg:px-20">
    <div class="mx-auto max-w-[1440px]">
      <div class="grid grid-cols-1 gap-x-12 gap-y-16 md:grid-cols-2 lg:grid-cols-3">
        @forelse($projects as $project)
          <div class="group flex flex-col items-start w-full">
            <div class="relative aspect-[4/3] w-full overflow-hidden rounded-lg thin-gold-border mb-6">
              @if ($project->image)
                <img alt="{{ $project->title }}" class="h-full w-full object-cover project-filter" src="{{ Storage::url($project->image) }}" />
              @else
                <div class="h-full w-full bg-white/5 flex items-center justify-center">
                  <span class="material-symbols-outlined text-6xl text-white/20">construction</span>
                </div>
              @endif
            </div>
            <div class="flex flex-col items-start w-full">
              <div class="flex items-center justify-between w-full mb-3">
                <h4 class="text-primary text-2xl font-extrabold uppercase tracking-wider">{{ $project->title }}</h4>
                <span class="px-3 py-1 bg-primary text-background-dark rounded-sm text-[10px] font-black tracking-widest">{{ $project->year }}</span>
              </div>
              <p class="text-white text-sm font-medium mb-1.5">{{ $project->location }}</p>
              <p class="text-white/40 text-[10px] font-bold uppercase tracking-[0.2em]">{{ $project->scope }}</p>
            </div>
          </div>
        @empty
          <div class="col-span-full text-center py-20">
            <span class="material-symbols-outlined text-6xl text-white/20 mb-4">search_off</span>
            <p class="text-white/40 text-lg">No projects found matching your criteria.</p>
          </div>
        @endforelse
      </div>

      <div class="mt-16">
        {{ $projects->links() }}
      </div>
    </div>
  </section>
</div>
