<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambahkan Video Baru') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
    <div class="w-full mx-auto sm:px-6 lg:px-8 min-h-screen py-12">
        
        {{-- PERBAIKAN DI SINI: --}}
        {{-- 1. Hapus grid pembungkus luar yang lama. --}}
        {{-- 2. Gunakan max-w-5xl (atau 6xl) dan mx-auto agar konten berada di tengah layar. --}}
        <div class="max-w-6xl mx-auto">
            @if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4 rounded-lg">
        <strong>Gagal Menyimpan!</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            {{-- 3. Pindahkan class Grid ke dalam tag FORM --}}
            {{-- Menggunakan grid-cols-3 agar rasionya lebih bagus (2/3 untuk konten, 1/3 untuk sidebar) --}}
            <form method="POST" action="{{ route('video.store') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                @csrf

                {{-- Kolom Utama (Mengambil 2 bagian dari 3 kolom) --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">

                    {{-- JUDUL --}}
                    <input type="text"
                        name="judul"
                        id="judul"
                        placeholder="Tambahkan judul video"
                        class="w-full text-2xl font-bold border-none focus:ring-0 bg-transparent text-black dark:text-black mb-4">

                    {{-- URL VIDEO --}}
                    <label for="url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                        URL Video (YouTube, Vimeo, atau lainnya)
                    </label>
                    <input type="url"
                        name="url"
                        id="url"
                        placeholder="https://youtube.com/watch?v=..."
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500 mb-6">

                    {{-- KATEGORI --}}
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                        Kategori
                    </label>
                    <input type="text"
                        name="kategori"
                        id="kategori"
                        placeholder="Contoh: Edukasi, Motivasi, Psikologi"
                        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500 mb-6">

                    {{-- PENULIS --}}
                    <label for="penulis_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                        Penulis
                    </label>
                    <select name="penulis_id"
                            id="penulis_id"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500 mb-6">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>

                    {{-- PREVIEW VIDEO --}}
                    <div class="mt-8">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Pratinjau Video</h3>
                        <div id="video_preview" class="aspect-video bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-300 rounded-lg">
                            Tempelkan URL untuk melihat pratinjau
                        </div>
                    </div>
                </div>

                {{-- SIDEBAR (Mengambil 1 bagian sisa secara otomatis) --}}
                <div class="space-y-6">
                    {{-- PANEL TERBITKAN --}}
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
                            Terbitkan Video
                        </button>
                    </div>

                    {{-- PANEL INFORMASI TAMBAHAN --}}
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Informasi</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Pastikan URL video berasal dari sumber terpercaya seperti YouTube atau Vimeo.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPT PREVIEW VIDEO --}}
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const urlInput = document.getElementById('url');
        const preview = document.getElementById('video_preview');

        // Fungsi untuk mengambil ID YouTube dari berbagai format URL
        function getYouTubeId(url) {
            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }

        urlInput.addEventListener('input', () => {
            const url = urlInput.value.trim();
            let embedUrl = '';

            // 1. Cek YouTube
            const youtubeId = getYouTubeId(url);
            if (youtubeId) {
                embedUrl = `https://www.youtube.com/embed/${youtubeId}`;
                preview.innerHTML = `<iframe width="100%" height="100%" src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
            } 
            // 2. Cek Vimeo
            else if (url.includes('vimeo.com/')) {
                // Mengambil ID Vimeo (angka di belakang slash terakhir)
                const vimeoId = url.replace(/[^0-9]/g, ''); 
                if (vimeoId) {
                    embedUrl = `https://player.vimeo.com/video/${vimeoId}`;
                    preview.innerHTML = `<iframe width="100%" height="100%" src="${embedUrl}" frameborder="0" allowfullscreen></iframe>`;
                }
            } 
            // 3. Tidak dikenali
            else {
                // Jangan hapus preview jika input kosong/sedang diketik tapi belum valid
                if(url.length > 0) {
                     preview.innerHTML = '<p class="text-gray-500 dark:text-gray-300 text-center">URL belum valid atau tidak dikenali.</p>';
                }
            }
        });
    });
</script>
</x-app-layout>