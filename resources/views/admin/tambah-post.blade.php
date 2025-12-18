<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambahkan Pos Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Tambahkan ID pada form untuk memudahkan validasi JS --}}
            <form id="postForm" method="POST" action="{{ route('artikel.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- Kolom Utama (Isi Post) --}}
                    <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">
                        {{-- Judul --}}
                        <x-input-label for="title" :value="__('Judul Artikel')" />
                        <x-text-input id="title" name="title" type="text" class="w-full text-2xl font-bold" placeholder="Tambahkan judul" :value="old('title')" required />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />

                        {{-- Bagian SLUG --}}
                        <div class="flex items-center space-x-2 mb-4">
                            <input type="text" id="slug" name="slug" 
                                class="flex-1 text-sm text-gray-700 dark:text-gray-300 border-none p-0 focus:ring-0 bg-transparent"
                                placeholder="slug-akan-muncul-disini" readonly />
                        </div>

                        {{-- Editor Konten --}}
                        <div class="mt-4 border border-gray-200 dark:border-gray-700 rounded-md">
                            <textarea id="editor" name="content" placeholder="Tulis isi pos di sini..." rows="20" required
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>
                    </div>

                    {{-- Sidebar Kanan --}}
                    <div class="lg:col-span-1 space-y-6">

                        {{-- Panel Terbitkan --}}
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Terbitkan</h3>
                            <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Terbitkan
                            </button>
                        </div>

                        {{-- Panel Gambar Unggulan --}}
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Gambar Unggulan</h3>

                            <input type="file" id="featured_image" name="featured_image" class="hidden" accept="image/*">

                            <button type="button" id="upload_button"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Unggah Gambar
                            </button>

                            {{-- PESAN ERROR JIKA BELUM UPLOAD --}}
                            <p id="js_error_image" class="mt-2 text-sm text-red-600 font-medium hidden">
                                ⚠️ Anda wajib mengunggah gambar sebelum menerbitkan artikel.
                            </p>

                            <x-input-error :messages="$errors->get('featured_image')" class="mt-2" />

                            <div id="image_preview_container" class="hidden mt-4">
                                <img id="image_preview" src="" alt="Image Preview"
                                    class="w-full rounded-lg border border-gray-300 dark:border-gray-600">
                                <button type="button" id="remove_image_button"
                                    class="w-full text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 mt-2 text-center">
                                    Hapus Gambar
                                </button>
                            </div>
                        </div>

                        {{-- Panel Caption Gambar --}}
                        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-4">
                            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">Caption Gambar</h3>
                            <textarea name="image_caption" rows="3" placeholder="Tulis caption untuk gambar unggulan..." required
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500">{{ old('image_caption') }}</textarea>
                            <x-input-error :messages="$errors->get('image_caption')" class="mt-2" />
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- SCRIPTS --}}
    <script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Inisialisasi CKEditor
            CKEDITOR.replace('editor', { height: 600 });

            // 2. Variabel Elemen
            const postForm = document.getElementById('postForm');
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            const fileInput = document.getElementById('featured_image');
            const uploadButton = document.getElementById('upload_button');
            const previewContainer = document.getElementById('image_preview_container');
            const imagePreview = document.getElementById('image_preview');
            const removeButton = document.getElementById('remove_image_button');
            const jsError = document.getElementById('js_error_image');

            // 3. Logika SLUG
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

            // 4. Logika Preview Gambar
            uploadButton.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.setAttribute('src', event.target.result);
                        previewContainer.classList.remove('hidden');
                        uploadButton.classList.add('hidden');
                        jsError.classList.add('hidden'); // Sembunyikan error jika sudah pilih file
                    }
                    reader.readAsDataURL(file);
                }
            });

            removeButton.addEventListener('click', () => {
                fileInput.value = '';
                imagePreview.setAttribute('src', '');
                previewContainer.classList.add('hidden');
                uploadButton.classList.remove('hidden');
            });

            // 5. VALIDASI WAJIB GAMBAR SAAT SUBMIT
            postForm.addEventListener('submit', function(e) {
                if (!fileInput.files || fileInput.files.length === 0) {
                    e.preventDefault(); // Stop form
                    jsError.classList.remove('hidden'); // Munculkan pesan
                    jsError.scrollIntoView({ behavior: 'smooth', block: 'center' }); // Fokus ke area error
                }
            });
        });
    </script>
</x-app-layout>