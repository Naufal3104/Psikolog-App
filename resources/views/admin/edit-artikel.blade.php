<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Artikel') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Form diubah ke rute update dengan method PUT --}}
            <form method="POST" action="{{ route('artikel.update', $artikel->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    {{-- Kolom Utama (Isi Post) --}}
                    <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                        
                        {{-- Judul --}}
                        <x-input-label for="title" :value="__('Judul Artikel')" />
                        <x-text-input id="title" name="title" type="text" class="w-full text-2xl font-bold"
                        placeholder="Tambahkan judul" required 
                        value="{{ old('title', $artikel->judul) }}"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />

                        {{-- Bagian SLUG --}}
                        <div class="flex items-center space-x-2 mb-4">
                            <input type="text" id="slug" name="slug" {{-- 
                                  PERBAIKAN: 
                                  - 'border-b' dihapus -> 'border-none'
                                  - 'focus:border-blue-500' dihapus
                                  - 'p-0' ditambahkan agar sejajar
                                  - Warna teks disesuaikan
                                --}}
                                class="flex-1 text-sm text-gray-700 dark:text-gray-300 border-none p-0 focus:ring-0 bg-transparent"
                                placeholder="slug-akan-muncul-disini"
                                value="{{ old('slug', $artikel->slug) }}">
                        </div>

                        {{-- Editor Konten --}}
                        {{-- PERBAIKAN: Dibungkus div agar ada margin-top --}}
                        <div class="mt-4 border border-gray-200 dark:border-gray-700 rounded-md">
                            <textarea id="editor" name="content" placeholder="Tulis isi pos di sini..." rows="20"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('content', $artikel->isi) }}</textarea>
                        </div>
                    </div>

                    {{-- Sidebar Kanan (Disederhanakan) --}}
                    <div class="lg:col-span-1 space-y-6">

                        {{-- Panel Terbitkan --}}
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                             <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Perbarui</h3>
                            <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Perbarui
                            </button>
                        </div>
                        
                        {{-- Panel Gambar Unggulan --}}
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Gambar Unggulan</h3>
                            
                            <input type="file" id="featured_image" name="featured_image" class="hidden" accept="image/*">

                            {{-- Tampilkan gambar yang ada saat ini --}}
                            <div id="image_current_container" class="{{ $artikel->gambar ? '' : 'hidden' }} mb-4">
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Gambar Saat Ini:</label>
                                <img id="image_current" src="{{ $artikel->gambar ? Storage::url($artikel->gambar) : '' }}" alt="Gambar saat ini" class="w-full rounded-lg border border-gray-300 dark:border-gray-600 mt-2">
                            </div>

                            {{-- Preview untuk gambar baru --}}
                            <div id="image_preview_container" class="hidden mt-4">
                                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Pratinjau Gambar Baru:</label>
                                <img id="image_preview" src="" alt="Image Preview" class="w-full rounded-lg border border-gray-300 dark:border-gray-600">
                                <button type="button" id="remove_image_button" class="w-full text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 mt-2 text-center">
                                    Batal Ganti Gambar
                                </button>
                            </div>

                            <button type="button" id="upload_button" class="w-full inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                Ganti Gambar
                            </button>
                        </div>

                        {{-- Panel Caption Gambar --}}
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Caption Gambar</h3>
                            <textarea name="image_caption" 
                                rows="3"
                                placeholder="Tulis caption untuk gambar unggulan..."
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('keterangan_gambar', $artikel->keterangan_gambar) }}</textarea>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- BLOK SCRIPT (DIMODIFIKASI UNTUK MENANGANI GAMBAR LAMA/BARU) --}}
    <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            height: 600
        });
    </script>
    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        const slugify = (text) => {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-')
                .replace(/^-+/, '')
                .replace(/-+$/, '');
        };

        titleInput.addEventListener('keyup', (e) => {
            slugInput.value = slugify(e.target.value);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('featured_image');
            const uploadButton = document.getElementById('upload_button');
            const previewContainer = document.getElementById('image_preview_container');
            const imagePreview = document.getElementById('image_preview');
            const removeButton = document.getElementById('remove_image_button');
            const currentContainer = document.getElementById('image_current_container'); // Ambil container gambar lama

            uploadButton.addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.setAttribute('src', event.target.result);
                        previewContainer.classList.remove('hidden');
                        uploadButton.classList.add('hidden');
                        if (currentContainer) {
                             currentContainer.classList.add('hidden'); // Sembunyikan gambar lama
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });

            removeButton.addEventListener('click', () => {
                fileInput.value = null;
                imagePreview.setAttribute('src', '');
                previewContainer.classList.add('hidden');
                uploadButton.classList.remove('hidden');
                if (currentContainer) {
                    currentContainer.classList.remove('hidden'); // Tampilkan lagi gambar lama
                }
            });
        });
    </script>
</x-app-layout>