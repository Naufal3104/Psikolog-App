<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ isset($jadwal) ? 'Edit Jadwal Shift' : 'Tambah Jadwal Shift' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ isset($jadwal) ? route('jadwal.update', $jadwal->id) : route('jadwal.store') }}" method="POST">
                    @csrf
                    @if(isset($jadwal)) @method('PUT') @endif

                    {{-- Pilih Psikolog --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nama Psikolog</label>
                        <select name="user_id" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Pilih Psikolog --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ (old('user_id', $jadwal->user_id ?? '') == $user->id) ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->no_telp ?? 'No HP Kosong' }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Pilih Hari --}}
                    <div class="mb-6">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Hari Bertugas</label>
                        <select name="hari" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">-- Pilih Hari --</option>
                            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                <option value="{{ $hari }}" {{ (old('hari', $jadwal->hari ?? '') == $hari) ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach
                        </select>
                        @error('hari') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex items-center justify-end gap-4">
                        <a href="{{ route('jadwal.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            {{ isset($jadwal) ? 'Simpan Perubahan' : 'Simpan Jadwal' }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>