{{-- resources/views/fitur/video.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tanya Psikologis - RSUD Jombang</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('styles')
</head>

<body
    x-data="{ darkMode: true, scrollTop: false }"
    x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode') ?? 'true');
        $watch('darkMode', v => localStorage.setItem('darkMode', JSON.stringify(v)))
    "
    x-on:scroll.window="scrollTop = (window.pageYOffset > 300)"
    :class="{ 'b eh': darkMode }"
>
    <x-layout.navbar />
    <main>
        <section class="i pg fh rm ki xn vq gj qp gr hj rp hr">
            <div class="animate_top bb af i va sg hh sm vk xm yi _n jp hi ao kp">

                {{-- Header --}}
                <div class="rj">
                    <h2 class="ek ck kk wm xb">Tanya Psikolog</h2>
                    <p class="sj hk xj mt-1">Ajukan pertanyaan seputar psikologi dan kesehatan mental kepada para ahli kami.</p>
                </div>

                {{-- ========= MODE KATEGORI ========= --}}
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 mt-6">
                    @forelse (($questions ?? collect()) as $question)
                        <a href="{{ url()->current() . '?kategori=' . urlencode($question->kategori) }}"
                           class="flex flex-col gap-4 p-4 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-md hover:shadow-lg transition-all">
                            {{-- Ganti sesuai asetmu; atau pakai fontawesome folder --}}
                            <div class="aspect-w-16 aspect-h-9">
                                <img src="{{ $question->image_url }}" 
                                     alt="{{ $question->title }}" 
                                     class="w-full h-full object-cover rounded-lg" />
                            </div>
                            <div>
                                <div class="kk wm vb">{{ $question->title }}</div>
                                <div class="sj hk xj">{{ $question->description }}</div>
                            </div>
                        </a>
                    @empty
                        <p class="sj hk xj">
                            Tidak ada pertanyaan tersedia.
                        </p>
                    @endforelse
                </div>
            </div>
        </section>
    <x-layout.footer />

    <script defer src="{{ asset('bundle.js') }}"></script>
    @stack('scripts')
</body>
</html>