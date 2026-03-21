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
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@ciptagemilang.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
            ]
        );

        // Hero Banners
        HeroBanner::truncate();

        HeroBanner::create([
            'title' => ['id' => 'KAMI MEMBUAT SEGALANYA', 'en' => 'WE MAKE EVERYTHING'],
            'highlight_text' => ['id' => 'LEBIH MUDAH', 'en' => 'EASIER'],
            'description' => ['id' => 'Solusi konstruksi terintegrasi dari perencanaan teknik konseptual hingga pemeliharaan teknis khusus. Kinerja presisi untuk setiap skala proyek.', 'en' => 'Integrated construction solutions from conceptual engineering to specialized technical maintenance. Precision performance for every project scale.'],
            'image' => 'banners/hero-banner.png',
            'badge_text' => ['id' => 'Layanan Lengkap', 'en' => 'All in One Services'],
            'cta_primary_text' => ['id' => 'Mulai Proyek Anda', 'en' => 'Start Your Project'],
            'cta_primary_url' => '/contact',
            'cta_secondary_text' => ['id' => 'Lihat Portofolio', 'en' => 'View Portfolio'],
            'cta_secondary_url' => '/projects',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HeroBanner::create([
            'title' => ['id' => 'DESAIN REKAYASA', 'en' => 'PRECISION ENGINEERING'],
            'highlight_text' => ['id' => 'PRESISI', 'en' => 'DESIGN'],
            'description' => ['id' => 'Perencanaan teknis lanjutan dan blueprint untuk infrastruktur komersial dan industri. Dari konsep hingga penyelesaian, tim engineering kami menghadirkan solusi inovatif.', 'en' => 'Advanced technical planning and blueprints for commercial and industrial infrastructures. From concept to completion, our engineering team delivers innovative solutions.'],
            'image' => 'banners/hero-engineering.png',
            'badge_text' => ['id' => 'Keunggulan Engineering', 'en' => 'Engineering Excellence'],
            'cta_primary_text' => ['id' => 'Layanan Kami', 'en' => 'Our Services'],
            'cta_primary_url' => '/services',
            'cta_secondary_text' => ['id' => 'Lihat Proyek', 'en' => 'View Projects'],
            'cta_secondary_url' => '/projects',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        HeroBanner::create([
            'title' => ['id' => 'MENDUKUNG', 'en' => 'POWERING YOUR'],
            'highlight_text' => ['id' => 'INFRASTRUKTUR ANDA', 'en' => 'INFRASTRUCTURE'],
            'description' => ['id' => 'Instalasi elektrikal komprehensif dan sistem HVAC efisiensi tinggi untuk ruang komersial. Spesialisasi dalam distribusi daya, video tron, dan solusi kontrol iklim.', 'en' => 'Comprehensive electrical installations and high-efficiency HVAC systems for commercial spaces. Specialized in power distribution, video tron, and climate control solutions.'],
            'image' => 'banners/hero-electrical.png',
            'badge_text' => ['id' => 'Solusi Elektrikal & HVAC', 'en' => 'Electrical & HVAC Solutions'],
            'cta_primary_text' => ['id' => 'Minta Penawaran', 'en' => 'Get a Quote'],
            'cta_primary_url' => '/contact',
            'cta_secondary_text' => ['id' => 'Selengkapnya', 'en' => 'Learn More'],
            'cta_secondary_url' => '/services',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        HeroBanner::create([
            'title' => ['id' => 'MEMBANGUN', 'en' => 'BUILDING QUALITY'],
            'highlight_text' => ['id' => 'INTERIOR BERKUALITAS', 'en' => 'INTERIORS'],
            'description' => ['id' => 'Renovasi struktural dan finishing premium untuk interior dan fasad komersial kelas atas. Pekerjaan mekanikal umum dan pemeliharaan sistem industri khusus.', 'en' => 'Structural renovations and premium finishing for high-end commercial interiors and facades. General mechanical works and specialized industrial systems maintenance.'],
            'image' => 'banners/hero-civil.png',
            'badge_text' => ['id' => 'Sipil & Mekanikal', 'en' => 'Civil & Mechanical'],
            'cta_primary_text' => ['id' => 'Mulai Proyek Anda', 'en' => 'Start Your Project'],
            'cta_primary_url' => '/contact',
            'cta_secondary_text' => ['id' => 'Klien Kami', 'en' => 'Our Clients'],
            'cta_secondary_url' => '/clients',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // Company Stats
        CompanyStat::truncate();
        $stats = [
            ['icon' => 'workspace_premium', 'value' => '20+', 'label' => ['id' => 'TAHUN PENGALAMAN', 'en' => 'YEARS EXPERIENCE'], 'sort_order' => 1],
            ['icon' => 'location_city', 'value' => '900+', 'label' => ['id' => 'PROYEK SELESAI', 'en' => 'PROJECTS COMPLETED'], 'sort_order' => 2],
            ['icon' => 'handyman', 'value' => 'End-to-End', 'label' => ['id' => 'LAYANAN PENUH', 'en' => 'FULL SERVICE'], 'sort_order' => 3],
            ['icon' => 'verified', 'value' => 'Certified', 'label' => ['id' => 'TIM PROFESIONAL', 'en' => 'PROFESSIONAL TEAM'], 'sort_order' => 4],
        ];
        foreach ($stats as $stat) {
            CompanyStat::create($stat + ['is_active' => true]);
        }

        // Attachments
        \App\Models\Attachment::truncate();

        // Services
        Service::truncate();
        $services = [
            [
                'title' => ['id' => 'Desain Engineering', 'en' => 'Engineering Design'], 
                'icon' => 'engineering', 
                'short_description' => ['id' => 'Perencanaan teknis lanjutan dan blueprint untuk infrastruktur komersial dan industri.', 'en' => 'Advanced technical planning and blueprints for commercial and industrial infrastructures.'], 
                'description' => [
                    'en' => "Our Engineering Design service provides the blueprint for success. We combine decades of technical expertise with state-of-the-art modeling software to deliver precision-engineered solutions. Our comprehensive design process covers every aspect of commercial and industrial infrastructure, ensuring structural integrity, regulatory compliance, and optimal spatial efficiency. <br><br><strong>Key Deliverables:</strong><ul><li>Detailed Architectural and Structural Blueprints</li><li>3D Spatial Modeling and BIM Integration</li><li>Feasibility and Structural Integrity Analysis</li><li>Load Calculations and Material Specification</li></ul>",
                    'id' => "Layanan Desain Engineering kami menyediakan cetak biru untuk kesuksesan. Kami memadukan puluhan tahun pengalaman teknis dengan perangkat lunak pemodelan mutakhir untuk memberikan solusi komprehensif. Proses desain kami mencakup setiap aspek infrastruktur komersial dan industri, memastikan integritas struktural, kepatuhan regulasi, dan efisiensi ruang yang optimal. <br><br><strong>Hasil Utama:</strong><ul><li>Cetak Biru Arsitektur dan Struktural Terperinci</li><li>Pemodelan Ruang 3D dan Integrasi BIM</li><li>Analisis Kelayakan dan Integritas Struktural</li><li>Perhitungan Beban dan Spesifikasi Material</li></ul>"
                ],
                'sort_order' => 1
            ],
            [
                'title' => ['id' => 'Sistem Elektrikal', 'en' => 'Electrical Systems'], 
                'icon' => 'bolt', 
                'short_description' => ['id' => 'Instalasi elektrikal komprehensif, termasuk video tron dan distribusi daya khusus.', 'en' => 'Comprehensive electrical installations, including specialized video tron and power distribution.'], 
                'description' => [
                    'en' => "We deliver comprehensive and scalable electrical installations tailored for high-demand commercial environments. From initial grid planning to final fixture installation, our certified electricians ensure maximum safety, reliability, and energy efficiency. We specialize in intricate power distribution networks, intelligent lighting solutions, and large-scale video tron integrations. <br><br><strong>Our Expertise:</strong><ul><li>High and Low Voltage Power Distribution</li><li>Custom Video Tron and Digital Signage Installation</li><li>Smart Lighting and Automation Systems</li><li>Emergency Backup and Generator Integration</li></ul>",
                    'id' => "Kami memberikan instalasi elektrikal yang komprehensif dan terukur, disesuaikan untuk lingkungan komersial bernilai tinggi. Mulai dari perencanaan jaringan awal hingga instalasi akhir, teknisi bersertifikat kami memastikan keamanan, keandalan, dan efisiensi energi yang optimal. Kami berspesialisasi dalam jaringan distribusi daya yang rumit, solusi pencahayaan cerdas, dan integrasi video tron skala besar. <br><br><strong>Keahlian Kami:</strong><ul><li>Distribusi Daya Tegangan Tinggi dan Rendah</li><li>Instalasi Video Tron dan Papan Reklame Digital Khusus</li><li>Sistem Pencahayaan Pintar dan Otomatisasi</li><li>Cadangan Darurat dan Integrasi Generator</li></ul>"
                ],
                'sort_order' => 2
            ],
            [
                'title' => ['id' => 'Sistem HVAC', 'en' => 'HVAC Systems'], 
                'icon' => 'ac_unit', 
                'short_description' => ['id' => 'Solusi ventilasi mekanik dan AC efisiensi tinggi untuk ruang komersial.', 'en' => 'High-efficiency mechanical ventilation and air conditioning solutions for commercial spaces.'], 
                'description' => [
                    'en' => "Our HVAC solutions guarantee superior indoor air quality and precise climate control for complex structural environments. We design, install, and maintain high-efficiency mechanical ventilation and air conditioning systems that strictly adhere to international environmental standards. Our focus is on maximizing energy efficiency while minimizing operational noise and maintenance overhead. <br><br><strong>System Capabilities:</strong><ul><li>Centralized Chiller and VRV/VRF Installations</li><li>Precision Exhaust and Mechanical Ventilation</li><li>Cleanroom and Specialized Air Filtration</li><li>Automated Climate Monitoring and Control</li></ul>",
                    'id' => "Solusi HVAC kami menjamin sirkulasi udara dalam ruangan yang dikontrol dengan presisi untuk lingkungan struktural yang kompleks. Kami merancang, memasang, dan memelihara sistem ventilasi mekanik dan pendingin udara berefisiensi tinggi yang secara ketat mematuhi standar lingkungan internasional. Fokus kami adalah memaksimalkan efisiensi energi sambil meminimalkan kebisingan operasional dan biaya pemeliharaan. <br><br><strong>Kemampuan Sistem:</strong><ul><li>Instalasi Chiller Terpusat dan VRV/VRF</li><li>Pembuangan Presisi dan Ventilasi Mekanik</li><li>Ruang Bersih dan Penyaringan Udara Khusus</li><li>Pemantauan dan Kontrol Iklim Otomatis</li></ul>"
                ],
                'sort_order' => 3
            ],
            [
                'title' => ['id' => 'Interior & Eksterior Sipil', 'en' => 'Civil Interior & Exterior'], 
                'icon' => 'foundation', 
                'short_description' => ['id' => 'Renovasi struktural dan finishing untuk interior dan fasad komersial kelas atas.', 'en' => 'Structural renovations and finishing for high-end commercial interiors and facades.'], 
                'description' => [
                    'en' => "Transforming concepts into tangible landmarks, our Civil Interior & Exterior services handle high-end commercial renovations with unmatched craftsmanship. We execute complex structural modifications, premium facade installations, and luxury interior finishing. Our team manages the entire lifecycle of the build, guaranteeing premium execution and exact adherence to architectural directives. <br><br><strong>Construction Prowess:</strong><ul><li>Luxury Commercial Interior Fit-Outs</li><li>Modern Facade Glass and ACP Installations</li><li>Structural Reinforcement and Modification</li><li>Premium Custom Millwork and Flooring</li></ul>",
                    'id' => "Mengubah konsep bangunan abstrak menjadi nyata, layanan Interior & Eksterior Sipil kami menangani renovasi komersial kelas atas dengan pengerjaan yang tak tertandingi. Kami melaksanakan modifikasi struktural yang kompleks, pemasangan fasad premium, dan penyelesaian interior mewah. Tim kami mengelola seluruh siklus pembangunan, menjamin eksekusi premium dan kepatuhan yang tepat terhadap arahan arsitektur. <br><br><strong>Keunggulan Konstruksi:</strong><ul><li>Fit-Out Interior Komersial Mewah</li><li>Pemasangan Kaca Fasad dan ACP Modern</li><li>Penguatan dan Modifikasi Struktural</li><li>Pembuatan Profil, Kusen, dan Lantai Khusus Premium</li></ul>"
                ],
                'sort_order' => 4
            ],
            [
                'title' => ['id' => 'Layanan Mekanikal', 'en' => 'Mechanical Services'], 
                'icon' => 'settings_suggest', 
                'short_description' => ['id' => 'Pekerjaan mekanikal umum dan pemeliharaan sistem industri khusus.', 'en' => 'General mechanical works and specialized industrial systems maintenance.'], 
                'description' => [
                    'en' => "Our Mechanical Services division is dedicated to the robust lifecycle management of intricate industrial and commercial machinery. We provide holistic mechanical interventions, encompassing routine proactive maintenance, emergency physical repairs, and complete system overhauls. We ensure your core operational mechanisms function seamlessly around the clock. <br><br><strong>Mechanical Offerings:</strong><ul><li>Heavy Machinery Installation and Calibration</li><li>Preventative Plumbing and Piping Maintenance</li><li>Industrial Conveyor and Esculator Servicing</li><li>Fire Protection and Sprinkler Systems</li></ul>",
                    'id' => "Divisi Layanan Mekanikal kami berdedikasi pada manajemen siklus hidup yang kuat dari mesin industri dan komersial yang rumit. Kami menyediakan intervensi mekanis holistik, mencakup pemeliharaan proaktif rutin, perbaikan fisik darurat, dan perbaikan sistem secara keseluruhan. Kami memastikan mekanisme operasional utama Anda berfungsi dengan mulus sepanjang waktu. <br><br><strong>Penawaran Mekanikal:</strong><ul><li>Pemasangan dan Kalibrasi Mesin Berat</li><li>Pemeliharaan Plambing dan Perpipaan Preventif</li><li>Servis Konveyor Industri dan Eskalator</li><li>Sistem Perlindungan Kebakaran dan Penyiram Air</li></ul>"
                ],
                'sort_order' => 5
            ],
            [
                'title' => ['id' => 'Pengadaan', 'en' => 'Procurement'], 
                'icon' => 'shopping_cart', 
                'short_description' => ['id' => 'Pengadaan strategis material industri dan peralatan teknis untuk proyek skala besar.', 'en' => 'Strategic sourcing of industrial materials and technical equipment for large scale projects.'], 
                'description' => [
                    'en' => "Streamline your supply chain with our elite Procurement services. Specializing in the strategic sourcing of high-grade industrial materials and specialized technical equipment, we mitigate logistical bottlenecks for large-scale developments. Our extensive global network of certified vendors ensures you receive the highest quality components at optimal cost-efficiencies, delivered rigorously on schedule. <br><br><strong>Procurement Advantages:</strong><ul><li>Global Sourcing of Specialized Technical Components</li><li>Rigorous Vendor Vetting and Quality Assurance</li><li>Logistics Management and Just-In-Time Delivery</li><li>Bulk Material Cost Negotiation and Auditing</li></ul>",
                    'id' => "Rampingkan rantai pasokan Anda dengan layanan Pengadaan elit kami. Mengkhususkan diri dalam pencarian strategis material industri bermutu tinggi dan peralatan teknis khusus, kami memitigasi hambatan logistik untuk pengembangan skala besar. Jaringan vendor bersertifikat global kami yang luas memastikan Anda menerima komponen kualitas tertinggi dengan efisiensi biaya yang optimal, dikirim dengan jadwal yang sangat ketat. <br><br><strong>Keuntungan Pengadaan:</strong><ul><li>Pengadaan Global Komponen Teknis Khusus</li><li>Pemeriksaan Vendor yang Ketat dan Penjaminan Mutu</li><li>Manajemen Logistik dan Pengiriman Tepat Waktu</li><li>Negosiasi Biaya Material Massal dan Audit</li></ul>"
                ],
                'sort_order' => 6
            ],
        ];
        foreach ($services as $serviceData) {
            $service = Service::create($serviceData + ['is_active' => true]);

            // Attach 3 random images
            $images = collect(range(1, 10))->random(3);
            $order = 1;
            foreach ($images as $imgId) {
                $service->attachments()->create([
                    'title' => 'Galeri ' . $order,
                    'file_path' => "attachments/{$imgId}.jpg",
                    'type' => 'image',
                    'sort_order' => $order++,
                ]);
            }

            // Attach 3 random videos
            $videos = collect(range(1, 10))->random(3);
            foreach ($videos as $vidId) {
                $service->attachments()->create([
                    'title' => 'Video ' . $order,
                    'file_path' => "attachments/{$vidId}.mp4",
                    'type' => 'video',
                    'sort_order' => $order++,
                ]);
            }
        }

        // Clients
        Client::truncate();
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
            Client::create($client + ['is_active' => true]);
        }

        // Projects
        Project::truncate();
        $projects = [
            [
                'title' => ['id' => 'TIMEZONE', 'en' => 'TIMEZONE'],
                'location' => ['id' => 'Summarecon Mall, Bandung', 'en' => 'Summarecon Mall, Bandung'],
                'year' => '2024',
                'scope' => ['id' => 'Renovasi Sipil, Layanan Mekanikal', 'en' => 'Civil Renovation, Mechanical Services'],
                'is_featured' => true, 'sort_order' => 1,
                'image' => 'projects/timezone.png',
                'client_name' => 'Timezone',
            ],
            [
                'title' => ['id' => 'STARBUCKS', 'en' => 'STARBUCKS'],
                'location' => ['id' => 'Pengosekan Ubud Bali', 'en' => 'Pengosekan Ubud Bali'],
                'year' => '2025',
                'scope' => ['id' => 'Mekanikal Elektrikal, HVAC', 'en' => 'Mechanical Electrical, HVAC'],
                'is_featured' => true, 'sort_order' => 2,
                'image' => 'projects/starbucks.png',
                'client_name' => 'Starbucks',
            ],
            [
                'title' => ['id' => 'KOPI KENANGAN', 'en' => 'KOPI KENANGAN'],
                'location' => ['id' => 'Merr Rungkut Surabaya', 'en' => 'Merr Rungkut Surabaya'],
                'year' => '2025',
                'scope' => ['id' => 'Mekanikal Elektrikal, HVAC', 'en' => 'Mechanical Electrical, HVAC'],
                'is_featured' => true, 'sort_order' => 3,
                'image' => 'projects/kopikenangan.png',
                'client_name' => 'Kopi Kenangan',
            ],
            [
                'title' => ['id' => 'PIZZA HUT', 'en' => 'PIZZA HUT'],
                'location' => ['id' => 'Galaxy Mall, Surabaya', 'en' => 'Galaxy Mall, Surabaya'],
                'year' => '2024',
                'scope' => ['id' => 'Pekerjaan Sipil & ME', 'en' => 'Civil & ME Works'],
                'is_featured' => true, 'sort_order' => 4,
                'image' => 'projects/pizzahut.png',
                'client_name' => 'Pizza Hut',
            ],
            [
                'title' => ['id' => 'BURGER KING', 'en' => 'BURGER KING'],
                'location' => ['id' => 'Senayan City, Jakarta', 'en' => 'Senayan City, Jakarta'],
                'year' => '2023',
                'scope' => ['id' => 'Interior Fit-out & HVAC', 'en' => 'Interior Fit-out & HVAC'],
                'is_featured' => true, 'sort_order' => 5,
                'image' => 'projects/burgerking.png',
                'client_name' => 'Burger King',
            ],
            [
                'title' => ['id' => 'SUBWAY', 'en' => 'SUBWAY'],
                'location' => ['id' => 'Pakuwon Mall, Surabaya', 'en' => 'Pakuwon Mall, Surabaya'],
                'year' => '2024',
                'scope' => ['id' => 'Elektrikal & Plumbing', 'en' => 'Electrical & Plumbing'],
                'is_featured' => true, 'sort_order' => 6,
                'image' => 'projects/subway.png',
                'client_name' => 'Subway',
            ],
        ];
        foreach ($projects as $project) {
            $clientName = $project['client_name'];
            unset($project['client_name']);
            $client = Client::where('name', $clientName)->first();
            Project::create($project + [
                'client_id' => $client?->id,
                'is_active' => true,
            ]);
        }

        // Company Settings
        CompanySetting::truncate();
        $settings = [
            'company_name' => ['id' => 'PT. CIPTA GEMILANG TEKNIK MANDIRI', 'en' => 'PT. CIPTA GEMILANG TEKNIK MANDIRI'],
            'company_short_name' => ['id' => 'CIPTA GEMILANG', 'en' => 'CIPTA GEMILANG'],
            'company_tagline' => ['id' => 'TEKNIK MANDIRI', 'en' => 'TEKNIK MANDIRI'],
            'company_description' => ['id' => 'Menetapkan standar dalam konstruksi industri mewah dan solusi teknik kelas atas di seluruh Indonesia. Berkomitmen pada keunggulan sejak 2004.', 'en' => 'Setting the benchmark in luxury industrial construction and high-end engineering solutions across Indonesia. Committed to excellence since 2004.'],
            'company_address' => ['id' => 'Kantor Jakarta, Jakarta Barat, Indonesia', 'en' => 'Jakarta Office, West Jakarta, Indonesia'],
            'company_phone' => ['id' => '+62 21 0000 0000', 'en' => '+62 21 0000 0000'],
            'company_email' => ['id' => 'info@ciptagemilang.com', 'en' => 'info@ciptagemilang.com'],
            'about_title' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
            'about_description' => ['id' => 'PT. Cipta Gemilang Teknik Mandiri adalah perusahaan konstruksi dan teknik terkemuka di Indonesia, yang berspesialisasi dalam solusi terintegrasi dari perencanaan teknik konseptual hingga pemeliharaan teknis khusus. Dengan pengalaman lebih dari 20 tahun dan 900+ proyek selesai, kami memberikan kinerja presisi untuk setiap skala proyek.', 'en' => 'PT. Cipta Gemilang Teknik Mandiri is a leading construction and engineering company in Indonesia, specializing in integrated solutions from conceptual engineering to specialized technical maintenance. With over 20 years of experience and 900+ completed projects, we deliver precision performance for every project scale.'],
            'about_mission' => ['id' => 'Menyediakan solusi konstruksi dan teknik terintegrasi berkualitas tinggi yang melebihi harapan klien melalui inovasi, keahlian, dan komitmen tanpa henti terhadap keunggulan.', 'en' => 'To provide integrated, high-quality construction and engineering solutions that exceed client expectations through innovation, expertise, and unwavering commitment to excellence.'],
            'about_vision' => ['id' => 'Menjadi mitra konstruksi dan teknik paling tepercaya dan inovatif di Indonesia, menetapkan standar kualitas dan keandalan dalam setiap proyek yang kami kerjakan.', 'en' => 'To be Indonesia\'s most trusted and innovative construction and engineering partner, setting the benchmark for quality and reliability in every project we undertake.'],
        ];
        foreach ($settings as $key => $value) {
            CompanySetting::create(['key' => $key, 'value' => $value]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
