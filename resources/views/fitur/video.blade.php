{{-- resources/views/fitur/video.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Video - Psikolog - RSUD Jombang</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        .video-section {
            padding: 120px 20px 60px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .video-section {
                padding: 100px 20px 40px 20px;
            }
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .eh .section-title h1 {
            color: white;
        }

        .section-title p {
            font-size: 1.125rem;
            color: #6b7280;
        }

        .eh .section-title p {
            color: #d1d5db;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 2rem;
        }

        @media (max-width: 640px) {
            .video-grid {
                grid-template-columns: 1fr;
            }
        }

        .video-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .video-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .eh .video-card {
            background: #1f2937;
            border: 1px solid #374151;
        }

        .video-thumbnail {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%; /* 16:9 aspect ratio */
            background: #000;
            overflow: hidden;
        }

        .video-thumbnail iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .video-content {
            padding: 1.25rem;
        }

        .video-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .eh .video-title {
            color: white;
        }

        .video-description {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.5;
        }

        .eh .video-description {
            color: #d1d5db;
        }

        .video-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e5e7eb;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .eh .video-meta {
            border-top-color: #374151;
            color: #9ca3af;
        }

        .video-meta-item {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .video-meta-item svg {
            width: 16px;
            height: 16px;
        }
    </style>
    @stack('styles')
</head>
<body
  x-data="{
      page: 'home',
      darkMode: true,
      stickyMenu: false,
      navigationOpen: false,
      scrollTop: false,
      sidebarOpen: false
  }"
  x-init="
      darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
      $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))
  "
  :class="{ 'b eh': darkMode === true }"
  x-cloak
>
    <x-layout.navbar />
    
    <main class="video-section">
        <!-- Section Header -->
        <div class="section-title">
            <h1>Video Edukasi Psikologi</h1>
            <p>Pelajari lebih lanjut tentang kesehatan mental melalui video edukatif</p>
        </div>

        <!-- Video Grid -->
        <div class="video-grid">
            <!-- Video 1 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        src="https://www.youtube.com/embed/3QIfkeA6HBY" 
                        title="Mengenal Kesehatan Mental"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Mengenal Kesehatan Mental</h3>
                    <p class="video-description">
                        Memahami pentingnya kesehatan mental dan cara menjaganya dalam kehidupan sehari-hari.
                    </p>
                    <div class="video-meta">
                        <div class="video-meta-item">
                            <i data-feather="clock"></i>
                            <span>8 menit</span>
                        </div>
                        <div class="video-meta-item">
                            <i data-feather="play-circle"></i>
                            <span>Edukasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 2 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        src="https://www.youtube.com/embed/bSbpCYRJ9_Q" 
                        title="Mengatasi Stress dan Kecemasan"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Mengatasi Stress dan Kecemasan</h3>
                    <p class="video-description">
                        Tips praktis untuk mengelola stress dan mengurangi kecemasan dalam kehidupan sehari-hari.
                    </p>
                    <div class="video-meta">
                        <div class="video-meta-item">
                            <i data-feather="clock"></i>
                            <span>10 menit</span>
                        </div>
                        <div class="video-meta-item">
                            <i data-feather="play-circle"></i>
                            <span>Tips</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 3 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        src="https://www.youtube.com/embed/NOAgplgTxfc" 
                        title="Memahami Depresi"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Memahami Depresi</h3>
                    <p class="video-description">
                        Mengenal gejala depresi dan langkah-langkah yang dapat diambil untuk mendapatkan bantuan.
                    </p>
                    <div class="video-meta">
                        <div class="video-meta-item">
                            <i data-feather="clock"></i>
                            <span>12 menit</span>
                        </div>
                        <div class="video-meta-item">
                            <i data-feather="play-circle"></i>
                            <span>Informasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 4 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        src="https://www.youtube.com/embed/vVEZl0B6N-k" 
                        title="Self Care untuk Kesehatan Mental"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Self Care untuk Kesehatan Mental</h3>
                    <p class="video-description">
                        Pentingnya merawat diri sendiri dan strategi self care yang efektif untuk kesehatan mental.
                    </p>
                    <div class="video-meta">
                        <div class="video-meta-item">
                            <i data-feather="clock"></i>
                            <span>9 menit</span>
                        </div>
                        <div class="video-meta-item">
                            <i data-feather="play-circle"></i>
                            <span>Tips</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 5 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        src="https://www.youtube.com/embed/BWnJlHH3_Q4" 
                        title="Komunikasi Efektif dalam Hubungan"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Komunikasi Efektif dalam Hubungan</h3>
                    <p class="video-description">
                        Cara berkomunikasi dengan baik untuk menjaga hubungan yang sehat dengan orang lain.
                    </p>
                    <div class="video-meta">
                        <div class="video-meta-item">
                            <i data-feather="clock"></i>
                            <span>11 menit</span>
                        </div>
                        <div class="video-meta-item">
                            <i data-feather="play-circle"></i>
                            <span>Edukasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video 6 -->
            <div class="video-card">
                <div class="video-thumbnail">
                    <iframe 
                        src="https://www.youtube.com/embed/rkZl2gsLUp4" 
                        title="Mindfulness dan Meditasi"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="video-content">
                    <h3 class="video-title">Mindfulness dan Meditasi</h3>
                    <p class="video-description">
                        Teknik mindfulness dan meditasi sederhana untuk ketenangan pikiran dan mengurangi stress.
                    </p>
                    <div class="video-meta">
                        <div class="video-meta-item">
                            <i data-feather="clock"></i>
                            <span>15 menit</span>
                        </div>
                        <div class="video-meta-item">
                            <i data-feather="play-circle"></i>
                            <span>Praktik</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <x-layout.footer />
    
    <script defer src="{{ asset('bundle.js') }}"></script>
    <script>
        // Initialize Feather Icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
    @stack('scripts')
</body>
</html>