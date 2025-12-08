<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($video) ? 'Edit Video' : 'Tambah Video Baru' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ isset($video) ? route('admin.video.update', $video->id) : route('admin.video.store') }}" method="POST">
                    @csrf
                    @if(isset($video)) @method('PUT') @endif

                    {{-- Input Judul --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Judul Video</label>
                        <input type="text" name="judul" value="{{ old('judul', $video->judul ?? '') }}" 
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        @error('judul') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Input URL --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">URL YouTube</label>
                        <input type="url" name="url" value="{{ old('url', $video->url ?? '') }}" 
                            placeholder="https://www.youtube.com/watch?v=..."
                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                        <p class="text-xs text-gray-500 mt-1">Pastikan link valid dari YouTube.</p>
                        @error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Input Kategori --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Kategori</label>
                        <select name="kategori" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="Edukasi" {{ (old('kategori', $video->kategori ?? '') == 'Edukasi') ? 'selected' : '' }}>Edukasi</option>
                            <option value="Terapi" {{ (old('kategori', $video->kategori ?? '') == 'Terapi') ? 'selected' : '' }}>Terapi</option>
                            <option value="Relaksasi" {{ (old('kategori', $video->kategori ?? '') == 'Relaksasi') ? 'selected' : '' }}>Relaksasi</option>
                            <option value="Umum" {{ (old('kategori', $video->kategori ?? '') == 'Umum') ? 'selected' : '' }}>Umum</option>
                        </select>
                        @error('kategori') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('admin.video.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            {{ isset($video) ? 'Simpan Perubahan' : 'Simpan Video' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>