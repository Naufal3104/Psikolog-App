<x-app-layout>
    {{-- 1. HEADER HALAMAN --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambahkan Pos Baru') }}
        </h2>
    </x-slot>

    {{-- 2. KONTEN UTAMA HALAMAN --}}
  
        <div class="w-full mx-auto sm:px-6 lg:px-8 min-h-screen">
            
            <div class="grid grid-cols-2 lg:grid-cols-2 gap-8">
                <form method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                @csrf
                
                {{-- Kolom Utama (Isi Post) --}}
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                    
                    {{-- Judul --}}
                    <input type="text"  
                           placeholder="Tambahkan judul"  
                           class="w-full text-2xl font-bold border-none focus:ring-0 bg-transparent text-black dark:text-black mb-2"
                           name="title"
                           id="title">

                    {{-- Bagian SLUG --}}
                    <div class="flex items-center space-x-2 mb-4">
                        <input type="text"
                               id="slug"
                               name="slug"
                               class="flex-1 text-sm text-black text-black border-b border-gray-300 dark:border-gray-600 focus:ring-0 focus:border-blue-500 bg-transparent"
                               placeholder="slug-akan-muncul-disini">
                    </div>

                    {{-- Editor Konten --}}
                    <textarea id="editor" name="content" placeholder="Tulis isi pos di sini..." ></textarea>
                </div>

                {{-- Sidebar Kanan (Disederhanakan) --}}
                <div class="space-y-6">

                    {{-- REVISI: Panel Terbitkan (Dipindah ke atas) --}}
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <button class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
                            Terbitkan
                        </button>
                    </div>
                    
                    {{-- Panel Gambar Unggulan --}}
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Gambar Unggulan</h3>
                        
                        <input type="file" id="featured_image" name="featured_image" class="hidden" accept="image/*">

                        <button type="button" id="upload_button" class="w-full px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-100 rounded-lg">
                            Unggah Gambar
                        </button>

                        <div id="image_preview_container" class="hidden mt-4">
                            <img id="image_preview" src="" alt="Image Preview" class="w-full rounded-lg border border-gray-300 dark:border-gray-600">
                            <button type="button" id="remove_image_button" class="w-full text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 mt-2 text-center">
                                Hapus Gambar
                            </button>
                        </div>
                    </div>

                    {{-- Panel Caption Gambar --}}
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                        <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Caption Gambar</h3>
                        <textarea name="image_caption" 
                                  rows="3"
                                  placeholder="Tulis caption untuk gambar unggulan..."
                                  class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                </div>
                </form>
            </div>

        </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor', {
            height: 600
        });
    </script>

    {{-- Script untuk generate SLUG --}}
    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        const slugify = (text) => {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Ganti spasi dengan -
                .replace(/[^\w\-]+/g, '')       // Hapus karakter non-alfanumerik
                .replace(/\-\-+/g, '-')         // Ganti -- dengan -
                .replace(/^-+/, '')             // Hapus - di awal
                .replace(/-+$/, '');            // Hapus - di akhir
        };

        titleInput.addEventListener('keyup', (e) => {
            slugInput.value = slugify(e.target.value);
        });
    </script>
    
    {{-- Script untuk preview gambar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('featured_image');
            const uploadButton = document.getElementById('upload_button');
            const previewContainer = document.getElementById('image_preview_container');
            const imagePreview = document.getElementById('image_preview');
            const removeButton = document.getElementById('remove_image_button');

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
                    }
                    reader.readAsDataURL(file);
                }
            });

            removeButton.addEventListener('click', () => {
                fileInput.value = null;
                imagePreview.setAttribute('src', '');
                previewContainer.classList.add('hidden');
                uploadButton.classList.remove('hidden');
            });
        });
    </script>
</x-app-layout>