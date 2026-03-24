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
            ['email' => 'admin@ciptagemilang.net'],
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
            'description' => [
                'id' => 'Instalasi elektrikal, mekanikal, dan sistem HVAC berefisiensi tinggi untuk ruang komersial. Fokus pada distribusi daya optimal dan kontrol iklim yang cerdas.',
                'en' => 'High-efficiency electrical, mechanical, and HVAC systems for commercial spaces. Focused on optimal power distribution and intelligent climate control.'
            ],
            'image' => 'banners/hero-electrical.png',
            'badge_text' => ['id' => 'Solusi Elektrikal, Mekanikal & HVAC', 'en' => 'Electrical, Mechanical & HVAC Solutions'],
            'cta_primary_text' => ['id' => 'Minta Penawaran', 'en' => 'Get a Quote'],
            'cta_primary_url' => '/contact',
            'cta_secondary_text' => ['id' => 'Selengkapnya', 'en' => 'Learn More'],
            'cta_secondary_url' => '/services',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        HeroBanner::create([
            'title' => ['id' => 'SIPIL INTERIOR', 'en' => 'CIVIL INTERIOR'],
            'highlight_text' => ['id' => 'DAN EKSTERIOR', 'en' => 'AND EXTERIOR'],
            'description' => ['id' => 'Renovasi struktural dan pengerjaan interior maupun eksterior kelas atas untuk fasilitas komersial dan publik dengan standar kualitas terbaik dan estetika yang fungsional.', 'en' => 'Structural renovations and high-end interior and exterior works for commercial and public facilities with the highest quality standards and functional aesthetics.'],
            'image' => 'banners/hero-interior.png',
            'badge_text' => ['id' => 'Sipil Interior & Exterior', 'en' => 'Civil Interior & Exterior'],
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
                'title' => ['id' => 'Konstruksi', 'en' => 'Construction'], 
                'icon' => 'foundation', 
                'short_description' => [
                    'id' => 'Layanan konstruksi komprehensif dari tahap fondasi hingga penyelesaian untuk fasilitas komersial dan industri.',
                    'en' => 'Comprehensive construction services from foundation to completion for commercial and industrial facilities.'
                ], 
                'description' => [
                    'en' => "We provide end-to-end construction services tailored to meet the rigorous demands of commercial and industrial developments. Our scope encompasses everything from foundational site works and structural erection to architectural finishing. With a steadfast commitment to safety, quality, and strict adherence to project timelines, our certified project managers and skilled builders bring architectural blueprints to life with uncompromising precision. <br><br><strong>Our Expertise:</strong><ul><li>Structural Foundation and Earthworks</li><li>Core Shell and Structural Erection</li><li>Architectural Finishing and Fit-outs</li><li>Comprehensive Site Management and Safety Compliance</li></ul>",
                    'id' => "Kami menyediakan layanan konstruksi end-to-end yang disesuaikan untuk memenuhi standar ketat fasilitas komersial dan industri. Lingkup kerja kami mencakup segala hal, mulai dari pekerjaan sipil dan fondasi, pendirian struktur utama, hingga penyelesaian arsitektural. Dengan komitmen teguh terhadap keselamatan kerja, kualitas material, dan ketepatan waktu, tenaga ahli kami mewujudkan rancangan arsitektur menjadi struktur fisik dengan presisi tinggi. <br><br><strong>Keahlian Kami:</strong><ul><li>Pekerjaan Tanah dan Fondasi Struktural (Sipil)</li><li>Pendirian Struktur Utama Bangunan</li><li>Pekerjaan Finishing dan Fasad Arsitektural</li><li>Manajemen Proyek dan Kepatuhan K3 (Kesehatan dan Keselamatan Kerja)</li></ul>"
                ],
                'sort_order' => 2
            ],
            [
                'title' => ['id' => 'Mekanikal & Elektrikal', 'en' => 'Mechanical & Electrical'], 
                'icon' => 'bolt', 
                'short_description' => [
                    'id' => 'Pengerjaan mekanikal dan elektrikal untuk bangunan komersial dan industri.',
                    'en' => 'Mechanical and electrical works for commercial and industrial buildings.'
                ], 
                'description' => [
                    'en' => "We deliver comprehensive and scalable mechanical and electrical installations tailored for high-demand commercial environments. From initial grid planning to final fixture installation, our certified electricians ensure maximum safety, reliability, and energy efficiency. We specialize in intricate power distribution networks, intelligent lighting solutions, and robust technical systems. <br><br><strong>Our Expertise:</strong><ul><li>High and Low Voltage Power Distribution</li><li>Custom Digital Signage and Automation Integration</li><li>Smart Lighting and Automation Systems</li><li>Emergency Backup and Generator Integration</li></ul>",
                    'id' => "Kami memberikan instalasi mekanikal dan elektrikal yang komprehensif dan terukur, disesuaikan untuk lingkungan komersial bernilai tinggi. Mulai dari perencanaan jaringan awal hingga instalasi akhir, teknisi bersertifikat kami memastikan keamanan, keandalan, dan efisiensi energi yang optimal. Kami berspesialisasi dalam jaringan distribusi daya yang rumit, solusi pencahayaan cerdas, dan sistem teknis yang tangguh. <br><br><strong>Keahlian Kami:</strong><ul><li>Distribusi Daya Tegangan Tinggi dan Rendah</li><li>Integrasi Papan Reklame Digital dan Otomatisasi Khusus</li><li>Sistem Pencahayaan Pintar dan Otomatisasi</li><li>Cadangan Darurat dan Integrasi Generator</li></ul>"
                ],
                'sort_order' => 3
            ],
            [
                'title' => ['id' => 'HVAC', 'en' => 'HVAC'], 
                'icon' => 'ac_unit', 
                'short_description' => ['id' => 'Solusi ventilasi mekanik dan AC efisiensi tinggi untuk ruang komersial.', 'en' => 'High-efficiency mechanical ventilation and air conditioning solutions for commercial spaces.'], 
                'description' => [
                    'en' => "Our HVAC solutions guarantee superior indoor air quality and precise climate control for complex structural environments. We design, install, and maintain high-efficiency mechanical ventilation and air conditioning systems that strictly adhere to international environmental standards. Our focus is on maximizing energy efficiency while minimizing operational noise and maintenance overhead. <br><br><strong>System Capabilities:</strong><ul><li>Centralized Chiller and VRV/VRF Installations</li><li>Precision Exhaust and Mechanical Ventilation</li><li>Cleanroom and Specialized Air Filtration</li><li>Automated Climate Monitoring and Control</li></ul>",
                    'id' => "Solusi HVAC kami menjamin sirkulasi udara dalam ruangan yang dikontrol dengan presisi untuk lingkungan struktural yang kompleks. Kami merancang, memasang, dan memelihara sistem ventilasi mekanik dan pendingin udara berefisiensi tinggi yang secara ketat mematuhi standar lingkungan internasional. Fokus kami adalah memaksimalkan efisiensi energi sambil meminimalkan kebisingan operasional dan biaya pemeliharaan. <br><br><strong>Kemampuan Sistem:</strong><ul><li>Instalasi Chiller Terpusat dan VRV/VRF</li><li>Pembuangan Presisi dan Ventilasi Mekanik</li><li>Ruang Bersih dan Penyaringan Udara Khusus</li><li>Pemantauan dan Kontrol Iklim Otomatis</li></ul>"
                ],
                'sort_order' => 4
            ],
            [
                'title' => ['id' => 'Interior & Eksterior Sipil', 'en' => 'Civil Interior & Exterior'], 
                'icon' => 'foundation', 
                'short_description' => ['id' => 'Renovasi struktural dan finishing untuk interior dan fasad komersial kelas atas.', 'en' => 'Structural renovations and finishing for high-end commercial interiors and facades.'], 
                'description' => [
                    'en' => "Transforming concepts into tangible landmarks, our Civil Interior & Exterior services handle high-end commercial renovations with unmatched craftsmanship. We execute complex structural modifications, premium facade installations, and luxury interior finishing. Our team manages the entire lifecycle of the build, guaranteeing premium execution and exact adherence to architectural directives. <br><br><strong>Construction Prowess:</strong><ul><li>Luxury Commercial Interior Fit-Outs</li><li>Modern Facade Glass and ACP Installations</li><li>Structural Reinforcement and Modification</li><li>Premium Custom Millwork and Flooring</li></ul>",
                    'id' => "Mengubah konsep bangunan abstrak menjadi nyata, layanan Interior & Eksterior Sipil kami menangani renovasi komersial kelas atas dengan pengerjaan yang tak tertandingi. Kami melaksanakan modifikasi struktural yang kompleks, pemasangan fasad premium, dan penyelesaian interior mewah. Tim kami mengelola seluruh siklus pembangunan, menjamin eksekusi premium dan kepatuhan yang tepat terhadap arahan arsitektur. <br><br><strong>Keunggulan Konstruksi:</strong><ul><li>Fit-Out Interior Komersial Mewah</li><li>Pemasangan Kaca Fasad dan ACP Modern</li><li>Penguatan dan Modifikasi Struktural</li><li>Pembuatan Profil, Kusen, dan Lantai Khusus Premium</li></ul>"
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
            [
                'name' => 'Timezone',        
                'logo' => 'clients/timezone.svg',    
                'website' => 'https://www.timezone.co.id/',      
                'sort_order' => 1,
            ],
            [
                'name' => 'Starbucks',       
                'logo' => 'clients/starbucks.svg',          
                'website' => 'https://www.starbucks.co.id/',
                'sort_order' => 2
            ],
            [
                'name' => 'Kopi Kenangan',   
                'logo' => 'clients/kopi-kenangan.svg',
                'website' => 'https://www.kopikenangan.com/',
                'sort_order' => 3
            ],
            [
                'name' => 'Pizza Hut',       
                'logo' => 'clients/pizza-hut.svg',          
                'website' => 'https://www.pizzahut.co.id/',
                'sort_order' => 4
            ],
            [
                'name' => 'Burger King',     
                'logo' => 'clients/burger-king.svg',        
                'website' => 'https://bkdelivery.co.id/',
                'sort_order' => 5
            ],
            [
                'name' => 'Subway',          
                'logo' => 'clients/subway.svg',             
                'website' => 'https://www.subway.co.id/',
                'sort_order' => 6
            ],
            [
                'name' => 'KFC',             
                'logo' => 'clients/kfc.svg',                
                'website' => 'https://kfcku.com/',
                'sort_order' => 7
            ],
            [
                'name' => 'Chagee',          
                'logo' => 'clients/chagee.svg',     
                'website' => 'https://global.chagee.com/id/ind',        
                'sort_order' => 8
            ],
            [
                'name' => 'Matahari',        
                'logo' => 'clients/matahari.svg',
                'website' => 'https://www.matahari.com/',
                'sort_order' => 9
            ],
            [
                'name' => 'Play N Learn',    
                'logo' => 'clients/play-n-learn.svg',       
                'website' => 'https://www.instagram.com/playnlearn_id/',
                'sort_order' => 10
            ],
            [
                'name' => 'HokBen',          
                'logo' => 'clients/hokben.png',             
                'website' => 'https://www.hokben.co.id/',
                'sort_order' => 11
            ],
            [
                'name' => 'Ha-Yo',           
                'logo' => 'clients/ha-yo.jpg',              
                'website' => 'https://www.instagram.com/hayo.froyo/',
                'sort_order' => 12
            ],
            [
                'name' => 'Kitchenette',     
                'logo' => 'clients/kitchenette.png',        
                'website' => 'https://www.ismaya.com/brands/kitchenette',
                'sort_order' => 13
            ],
            [
                'name' => 'Ta Wan',          
                'logo' => 'clients/ta-wan.png',             
                'website' => 'https://www.tawanrestaurant.com/',
                'sort_order' => 14
            ],
            [
                'name' => 'The People Cafe', 
                'logo' => 'clients/the-people-cafe.png',    
                'website' => 'https://www.ismaya.com/brands/the-peoples-cafe',
                'sort_order' => 15
            ],
        ];
        foreach ($clients as $client) {
            Client::create($client + ['is_active' => true]);
        }

        // Projects
        Project::truncate();
        $projects = [
            [
                'location' => 'Pantai Indah Kapuk, Jakarta',
                'year' => '2025',
                'type' => 'Civil, Electrical, Fixtures, Laser Tag',
                'scope' => 'Construction',
                'is_featured' => true, 
                'sort_order' => 1,
                'image' => 'projects/images/timezone.png',
                'video' => 'projects/videos/timezone.mp4',
                'client_name' => 'Timezone',
            ],
            [
                'location' => 'Mega Mall, Batam',
                'year' => '2025',
                'type' => 'Mechanical, Electrical, HVAC',
                'scope' => 'Construction',
                'is_featured' => true, 
                'sort_order' => 2,
                'image' => 'projects/images/pizzahut.png',
                'video' => null,
                'client_name' => 'Pizza Hut',
            ],
            [
                'location' => 'Mahakam, Jakarta Selatan',
                'year' => '2025',
                'type' => 'Mechanical, Electrical',
                'scope' => 'Construction',
                'is_featured' => true, 
                'sort_order' => 3,
                'image' => 'projects/images/starbucks.png',
                'video' => null,
                'client_name' => 'Starbucks',
            ],
            [
                'location' => 'Paskal, Bandung',
                'year' => '2025',
                'type' => 'Mechanical, Electrical, HVAC',
                'scope' => 'Construction',
                'is_featured' => true, 
                'sort_order' => 4,
                'image' => 'projects/images/burgerking.png',
                'video' => null,
                'client_name' => 'Burger King',
            ],
            [
                'location' => 'Mall Ciputra, Cibubur',
                'year' => '2025',
                'type' => 'Civil, Mechanical, Electrical, HVAC',
                'scope' => 'Construction',
                'is_featured' => true, 
                'sort_order' => 5,
                'image' => 'projects/images/playnlearn.png',
                'video' => null,
                'client_name' => 'Play N Learn',
            ],
            [
                'location' => 'Pakuwon Mall, Surabaya',
                'year' => '2024',
                'type' => 'Electrical, Plumbing',
                'scope' => 'Construction',
                'is_featured' => true, 
                'sort_order' => 6,
                'image' => 'projects/images/subway.png',
                'video' => null,
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
            'company_description' => ['id' => 'Mitra tepercaya dalam Engineering Design, Procurement, dan Construction (EPC) sejak 2006. Berdedikasi menghadirkan solusi mekanikal, elektrikal, dan sipil interior terbaik untuk berbagai fasilitas komersial di seluruh Indonesia.', 'en' => 'Your trusted partner in Engineering Design, Procurement, and Construction (EPC) since 2006. Dedicated to delivering premier mechanical, electrical, and civil interior solutions for commercial facilities across Indonesia.'],
            'company_address' => ['id' => 'JL. Cendrawasih VI No. 1 Rt.06 Rw.06, Cengkareng Barat, Cengkareng, Jakarta Barat 11730', 'en' => 'JL. Cendrawasih VI No. 1 Rt.06 Rw.06, Cengkareng Barat, Cengkareng, Jakarta Barat 11730'],
            'company_phone' => ['id' => '+62 21 5435 3637', 'en' => '+62 21 5435 3637'],
            'company_fax' => ['id' => '+62 21 5435 3637', 'en' => '+62 21 5435 3637'],
            'company_email' => ['id' => 'cgtm@ciptagemilang.net', 'en' => 'cgtm@ciptagemilang.net'],
            'about_title' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
            'about_description' => ['id' => 'Berdiri pada 22 Februari 2006, PT. Cipta Gemilang Teknik Mandiri (CGTM) adalah mitra EPC terpercaya yang berspesialisasi pada Sistem Mekanikal Elektrikal dan Civil Interior untuk berbagai fasilitas komersial dan publik.

Berbekal kepercayaan pelanggan dalam setiap siklus layanan—dari desain teknis hingga konstruksi menyeluruh—kami terus berkembang dengan senantiasa meningkatkan kualitas sumber daya manusia serta infrastruktur demi menetapkan standar pelayanan yang konsisten melebihi ekspektasi.', 'en' => 'Established on February 22, 2006, PT. Cipta Gemilang Teknik Mandiri (CGTM) is a trusted EPC partner specializing in high-end Mechanical, Electrical, and Civil Interior systems for various commercial and public facilities.

Empowered by the enduring trust of our valued clients across all service lifecycles—from advanced engineering design to complete construction—we continue to grow by consistently elevating our human capital and infrastructure to deliver service standards that exceed expectations.'],
            'about_mission' => ['id' => 'Terus mengembangkan kapasitas perusahaan dalam ranah rekayasa (engineering) dan konstruksi dengan menetapkan kebijakan progresif terkait sumber daya manusia dan fasilitas teknis demi memberikan solusi optimal yang selaras dengan misi pembangunan nasional.', 'en' => 'To continuously expand corporate capabilities in the engineering and construction sector by establishing progressive policies involving human capital and technical facilities, ultimately delivering optimal solutions aligned with the national development mission.'],
            'about_vision' => ['id' => 'Menjadi mitra pengembang dan perancang (EPC) terdepan di Indonesia yang dipercaya sepenuh hati oleh pelanggan berkat keunggulan tata kelola, inovasi terencana, serta kontribusi berkelanjutannya di setiap proyek yang kami tangani.', 'en' => 'To be the foremost leading and wholeheartedly trusted EPC partner in Indonesia, recognized by our clients for governance excellence, deliberate innovation, and sustainable contribution in every project we handle.'],
        ];
        foreach ($settings as $key => $value) {
            CompanySetting::create(['key' => $key, 'value' => $value]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
