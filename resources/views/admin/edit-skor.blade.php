<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- PERUBAHAN 1: Ganti Judul --}}
            {{ __('Edit Interpretasi Skor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 
              PERUBAHAN 2: 
              - Arahkan 'action' ke rute update.
              - Asumsi controller mengirimkan variabel '$skor'.
            --}}
            <form method="POST" action="{{ route('kelola-skor.update', $skor->id) }}">
                @csrf
                @method('PUT') {{-- Tambahkan method PUT untuk update --}}
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            Detail Interpretasi
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <x-input-label for="kategori_deteksi_id" :value="__('Kategori')" />
                                <select id="kategori_deteksi_id" name="kategori_deteksi_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach ($kategoriDeteksi as $kat)
                                        {{-- PERUBAHAN 3: Ganti logika 'selected' untuk mencocokkan data $skor --}}
                                        <option value="{{ $kat->id }}" 
                                            {{ old('kategori_deteksi_id', $skor->kategori_deteksi_id) == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kategori_deteksi_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="teks_interpretasi" :value="__('Hasil Teks (Cth: Stres Rendah)')" />
                                {{-- PERUBAHAN 4: Isi :value dengan data $skor --}}
                                <x-text-input id="teks_interpretasi" name="teks_interpretasi" type="text" class="mt-1 block w-full" 
                                    :value="old('teks_interpretasi', $skor->teks_interpretasi)" required />
                                <x-input-error :messages="$errors->get('teks_interpretasi')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="skor_minimal" :value="__('Skor Minimal')" />
                                {{-- PERUBAHAN 5: Isi :value dengan data $skor --}}
                                <x-text-input id="skor_minimal" name="skor_minimal" type="number" class="mt-1 block w-full" 
                                    :value="old('skor_minimal', $skor->skor_minimal)" required />
                                <x-input-error :messages="$errors->get('skor_minimal')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="skor_maksimal" :value="__('Skor Maksimal')" />
                                {{-- PERUBAHAN 6: Isi :value dengan data $skor --}}
                                <x-text-input id="skor_maksimal" name="skor_maksimal" type="number" class="mt-1 block w-full" 
                                    :value="old('skor_maksimal', $skor->skor_maksimal)" required />
                                <x-input-error :messages="$errors->get('skor_maksimal')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="deskripsi_hasil" :value="__('Deskripsi Hasil (Penjelasan untuk pengguna)')" />
                                {{-- PERUBAHAN 7: Isi textarea dengan data $skor --}}
                                <textarea id="deskripsi_hasil" name="deskripsi_hasil" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('deskripsi_hasil', $skor->deskripsi_hasil) }}</textarea>
                                <x-input-error :messages="$errors->get('deskripsi_hasil')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-end px-6 py-4 bg-gray-50 dark:bg-gray-700 text-right space-x-4">
                        <a href="{{ route('kelola-skor.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:underline">
                            Batal
                        </a>
                        <x-primary-button>
                            {{-- PERUBAHAN 8: Ganti teks tombol --}}
                            {{ __('Update Interpretasi') }}
                        </x-primary-button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>