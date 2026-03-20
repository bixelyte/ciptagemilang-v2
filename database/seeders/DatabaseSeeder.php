<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\CompanySetting;
use App\Models\CompanyStat;
use App\Models\HeroBanner;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@ciptagemilang.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // Hero Banners
        HeroBanner::updateOrCreate(['title' => 'WE MAKE EVERYTHING'], [
            'highlight_text' => 'EASIER',
            'description' => 'Integrated construction solutions from conceptual engineering to specialized technical maintenance. Precision performance for every project scale.',
            'image' => 'banners/hero-banner.png',
            'badge_text' => 'All in One Services',
            'cta_primary_text' => 'Start Your Project',
            'cta_primary_url' => '/contact',
            'cta_secondary_text' => 'View Portfolio',
            'cta_secondary_url' => '/projects',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HeroBanner::updateOrCreate(['title' => 'PRECISION ENGINEERING'], [
            'highlight_text' => 'DESIGN',
            'description' => 'Advanced technical planning and blueprints for commercial and industrial infrastructures. From concept to completion, our engineering team delivers innovative solutions.',
            'image' => 'banners/hero-engineering.png',
            'badge_text' => 'Engineering Excellence',
            'cta_primary_text' => 'Our Services',
            'cta_primary_url' => '/services',
            'cta_secondary_text' => 'View Projects',
            'cta_secondary_url' => '/projects',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        HeroBanner::updateOrCreate(['title' => 'POWERING YOUR'], [
            'highlight_text' => 'INFRASTRUCTURE',
            'description' => 'Comprehensive electrical installations and high-efficiency HVAC systems for commercial spaces. Specialized in power distribution, video tron, and climate control solutions.',
            'image' => 'banners/hero-electrical.png',
            'badge_text' => 'Electrical & HVAC Solutions',
            'cta_primary_text' => 'Get a Quote',
            'cta_primary_url' => '/contact',
            'cta_secondary_text' => 'Learn More',
            'cta_secondary_url' => '/services',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        HeroBanner::updateOrCreate(['title' => 'BUILDING QUALITY'], [
            'highlight_text' => 'INTERIORS',
            'description' => 'Structural renovations and premium finishing for high-end commercial interiors and facades. General mechanical works and specialized industrial systems maintenance.',
            'image' => 'banners/hero-civil.png',
            'badge_text' => 'Civil & Mechanical',
            'cta_primary_text' => 'Start Your Project',
            'cta_primary_url' => '/contact',
            'cta_secondary_text' => 'Our Clients',
            'cta_secondary_url' => '/clients',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // Company Stats
        $stats = [
            ['icon' => 'workspace_premium', 'value' => '20+', 'label' => 'YEARS EXPERIENCE', 'sort_order' => 1],
            ['icon' => 'location_city', 'value' => '900+', 'label' => 'PROJECTS COMPLETED', 'sort_order' => 2],
            ['icon' => 'handyman', 'value' => 'End-to-End', 'label' => 'FULL SERVICE', 'sort_order' => 3],
            ['icon' => 'verified', 'value' => 'Certified', 'label' => 'PROFESSIONAL TEAM', 'sort_order' => 4],
        ];
        foreach ($stats as $stat) {
            CompanyStat::updateOrCreate(['label' => $stat['label']], $stat);
        }

        // Services
        $services = [
            ['title' => 'Engineering Design', 'icon' => 'engineering', 'short_description' => 'Advanced technical planning and blueprints for commercial and industrial infrastructures.', 'sort_order' => 1],
            ['title' => 'Electrical Systems', 'icon' => 'bolt', 'short_description' => 'Comprehensive electrical installations, including specialized video tron and power distribution.', 'sort_order' => 2],
            ['title' => 'HVAC Systems', 'icon' => 'ac_unit', 'short_description' => 'High-efficiency mechanical ventilation and air conditioning solutions for commercial spaces.', 'sort_order' => 3],
            ['title' => 'Civil Interior & Exterior', 'icon' => 'foundation', 'short_description' => 'Structural renovations and finishing for high-end commercial interiors and facades.', 'sort_order' => 4],
            ['title' => 'Mechanical Services', 'icon' => 'settings_suggest', 'short_description' => 'General mechanical works and specialized industrial systems maintenance.', 'sort_order' => 5],
            ['title' => 'Procurement', 'icon' => 'shopping_cart', 'short_description' => 'Strategic sourcing of industrial materials and technical equipment for large scale projects.', 'sort_order' => 6],
        ];
        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service + ['is_active' => true]);
        }

        // Clients
        $clients = [
            ['name' => 'Timezone',        'logo' => 'clients/timezone.svg',          'sort_order' => 1],
            ['name' => 'Starbucks',       'logo' => 'clients/starbucks.svg',          'sort_order' => 2],
            ['name' => 'Kopi Kenangan',   'logo' => 'clients/kopi-kenangan.svg',      'sort_order' => 3],
            ['name' => 'Pizza Hut',       'logo' => 'clients/pizza-hut.svg',          'sort_order' => 4],
            ['name' => 'Burger King',     'logo' => 'clients/burger-king.svg',        'sort_order' => 5],
            ['name' => 'Subway',          'logo' => 'clients/subway.svg',             'sort_order' => 6],
            ['name' => 'KFC',             'logo' => 'clients/kfc.svg',                'sort_order' => 7],
            ['name' => 'Chagee',          'logo' => 'clients/chagee.svg',             'sort_order' => 8],
            ['name' => 'Matahari',        'logo' => 'clients/matahari.svg',           'sort_order' => 9],
            ['name' => 'Play N Learn',    'logo' => 'clients/play-n-learn.svg',       'sort_order' => 10],
            ['name' => 'HokBen',          'logo' => 'clients/hokben.png',             'sort_order' => 11],
            ['name' => 'Ha-Yo',           'logo' => 'clients/ha-yo.jpg',              'sort_order' => 12],
            ['name' => 'Kitchenette',     'logo' => 'clients/kitchenette.png',        'sort_order' => 13],
            ['name' => 'Ta Wan',          'logo' => 'clients/ta-wan.png',             'sort_order' => 14],
            ['name' => 'The People Cafe', 'logo' => 'clients/the-people-cafe.png',    'sort_order' => 15],
        ];
        foreach ($clients as $client) {
            Client::updateOrCreate(['name' => $client['name']], $client + ['is_active' => true]);
        }

        // Projects
        $projects = [
            ['title' => 'TIMEZONE', 'location' => 'Summarecon Mall, Bandung', 'year' => '2024', 'scope' => 'Civil Renovation, Mechanical Services', 'is_featured' => true, 'sort_order' => 1, 'image' => 'projects/timezone.png', 'client_name' => 'Timezone'],
            ['title' => 'STARBUCKS', 'location' => 'Pengosekan Ubud Bali', 'year' => '2025', 'scope' => 'Mechanical Electrical, HVAC', 'is_featured' => true, 'sort_order' => 2, 'image' => 'projects/starbucks.png', 'client_name' => 'Starbucks'],
            ['title' => 'KOPI KENANGAN', 'location' => 'Merr Rungkut Surabaya', 'year' => '2025', 'scope' => 'Mechanical Electrical, HVAC', 'is_featured' => true, 'sort_order' => 3, 'image' => 'projects/kopikenangan.png', 'client_name' => 'Kopi Kenangan'],
            ['title' => 'PIZZA HUT', 'location' => 'Galaxy Mall, Surabaya', 'year' => '2024', 'scope' => 'Civil & ME Works', 'is_featured' => true, 'sort_order' => 4, 'image' => 'projects/pizzahut.png', 'client_name' => 'Pizza Hut'],
            ['title' => 'BURGER KING', 'location' => 'Senayan City, Jakarta', 'year' => '2023', 'scope' => 'Interior Fit-out & HVAC', 'is_featured' => true, 'sort_order' => 5, 'image' => 'projects/burgerking.png', 'client_name' => 'Burger King'],
            ['title' => 'SUBWAY', 'location' => 'Pakuwon Mall, Surabaya', 'year' => '2024', 'scope' => 'Electrical & Plumbing', 'is_featured' => true, 'sort_order' => 6, 'image' => 'projects/subway.png', 'client_name' => 'Subway'],
        ];
        foreach ($projects as $project) {
            $clientName = $project['client_name'];
            unset($project['client_name']);
            $client = Client::where('name', $clientName)->first();
            Project::updateOrCreate(['title' => $project['title'], 'year' => $project['year']], $project + [
                'client_id' => $client?->id,
                'is_active' => true,
            ]);
        }

        // Company Settings
        $settings = [
            'company_name' => 'PT. CIPTA GEMILANG TEKNIK MANDIRI',
            'company_short_name' => 'CIPTA GEMILANG',
            'company_tagline' => 'TEKNIK MANDIRI',
            'company_description' => 'Setting the benchmark in luxury industrial construction and high-end engineering solutions across Indonesia. Committed to excellence since 2004.',
            'company_address' => 'Jakarta Office, West Jakarta, Indonesia',
            'company_phone' => '+62 21 0000 0000',
            'company_email' => 'info@ciptagemilang.com',
            'about_title' => 'About Us',
            'about_description' => 'PT. Cipta Gemilang Teknik Mandiri is a leading construction and engineering company in Indonesia, specializing in integrated solutions from conceptual engineering to specialized technical maintenance. With over 20 years of experience and 900+ completed projects, we deliver precision performance for every project scale.',
            'about_mission' => 'To provide integrated, high-quality construction and engineering solutions that exceed client expectations through innovation, expertise, and unwavering commitment to excellence.',
            'about_vision' => 'To be Indonesia\'s most trusted and innovative construction and engineering partner, setting the benchmark for quality and reliability in every project we undertake.',
        ];
        foreach ($settings as $key => $value) {
            CompanySetting::set($key, $value);
        }
    }
}
