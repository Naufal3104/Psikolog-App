<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Data Psikolog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('verifikasi.update', $psikolog->id) }}">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">Data Akun</h3>
                        
                        {{-- Nama --}}
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nama Lengkap')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $psikolog->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $psikolog->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- NIK --}}
                        <div class="mb-4">
                            <x-input-label for="NIK" :value="__('NIK')" />
                            <x-text-input id="NIK" class="block mt-1 w-full" type="text" name="NIK" :value="old('NIK', $psikolog->NIK)" required />
                            <x-input-error :messages="$errors->get('NIK')" class="mt-2" />
                        </div>

                        {{-- No HP --}}
                        <div class="mb-4">
                            <x-input-label for="no_telp" :value="__('No WhatsApp')" />
                            <x-text-input id="no_telp" class="block mt-1 w-full" type="text" name="no_telp" :value="old('no_telp', $psikolog->no_telp)" required />
                            <x-input-error :messages="$errors->get('no_telp')" class="mt-2" />
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-6">
                            <x-input-label for="alamat" :value="__('Alamat')" />
                            <textarea id="alamat" name="alamat" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" rows="3">{{ old('alamat', $psikolog->alamat) }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4 border-b pb-2">Data Profesi</h3>

                        {{-- NIP --}}
                        <div class="mb-4">
                            <x-input-label for="NIP" :value="__('NIP')" />
                            <x-text-input id="NIP" class="block mt-1 w-full" type="text" name="NIP" :value="old('NIP', $psikolog->psikologProfile->NIP ?? '')" required />
                            <x-input-error :messages="$errors->get('NIP')" class="mt-2" />
                        </div>

                        {{-- Spesialisasi --}}
                        <div class="mb-4">
                            <x-input-label for="spesialisasi" :value="__('Spesialisasi')" />
                            <x-text-input id="spesialisasi" class="block mt-1 w-full" type="text" name="spesialisasi" :value="old('spesialisasi', $psikolog->psikologProfile->spesialisasi ?? '')" required />
                            <x-input-error :messages="$errors->get('spesialisasi')" class="mt-2" />
                        </div>

                        {{-- Status (Admin bisa manual ubah status lewat edit) --}}
                        <div class="mb-6">
                            <x-input-label for="status" :value="__('Status Akun')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="pending" {{ $psikolog->psikologProfile->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $psikolog->psikologProfile->status == 'approved' ? 'selected' : '' }}>Approved (Aktif)</option>
                                <option value="rejected" {{ $psikolog->psikologProfile->status == 'rejected' ? 'selected' : '' }}>Rejected (Ditolak)</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4 gap-2">
                            <a href="{{ route('verifikasi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:bg-gray-500 active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>