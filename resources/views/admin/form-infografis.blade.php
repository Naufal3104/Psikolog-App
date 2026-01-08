<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($infografis) ? 'Edit Infografis' : 'Tambah Infografis Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ isset($infografis) ? route('admin.infografis.update', $infografis->id) : route('admin.infografis.store') }}" method="POST">
                    @csrf
                    @if(isset($infografis)) @method('PUT') @endif

                    {{-- Input Judul --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Judul Infografis</label>
                        <input type="text" name="judul" value="{{ old('judul', $infografis->judul ?? '') }}" 
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        @error('judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Input URL Gambar --}}
<div class="mb-4">
    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Link Gambar (URL Google Drive)</label>
    
    {{-- Input field --}}
    <input type="url" name="gambar" value="{{ old('gambar', $infografis->gambar ?? '') }}" 
        placeholder="https://drive.google.com/file/d/...../view"
        class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        
    {{-- Helper text --}}
    <p class="text-xs text-gray-500 mt-1">
        Cukup Copy-Paste link lengkap dari Google Drive (Pastikan akses sudah "Anyone with the link"). <br>
        Sistem akan otomatis mengubahnya agar gambar bisa tampil.
    </p>
    
    @error('gambar') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
</div>
                    {{-- Input Caption --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Caption / Deskripsi Singkat</label>
                        <textarea name="caption" rows="3"
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('caption', $infografis->caption ?? '') }}</textarea>
                        @error('caption') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.infografis.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            {{ isset($infografis) ? 'Simpan Perubahan' : 'Simpan Infografis' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>