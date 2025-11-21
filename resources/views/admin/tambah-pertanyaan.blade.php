<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buat Pertanyaan Deteksi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 
              PERBAIKAN 1: Sintaks JavaScript di x-data
              Komentar '//' telah dihapus dan sintaks getter diperbaiki.
            --}}
            <form method="POST" action="{{ route('kelola-deteksi.store') }}" 
                  x-data="{ 
                      tipeJawaban: '{{ old('tipe_jawaban', 'ya_tidak') }}',
                      urutanMap: {{ $urutanMapJson }},
                      selectedKategori: '{{ old('kategori_deteksi_id', '') }}',
                      
                      get urutanBaru() {
                          if (!this.selectedKategori) {
                              return 1; // Default jika belum ada kategori dipilih
                          }
                          // Cari urutan max di map. Jika tidak ada, anggap 0.
                          const maxUrutan = this.urutanMap[this.selectedKategori] || 0;
                          
                          // Kembalikan nilai + 1
                          return maxUrutan + 1;
                      }
                  }">
                @csrf

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            Detail Pertanyaan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="kategori_deteksi_id" :value="__('Kategori')" />
                                <select id="kategori_deteksi_id" name="kategori_deteksi_id" 
                                    x-model="selectedKategori"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    @foreach ($kategoriDeteksi as $kat)
                                        <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('kategori_deteksi_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tipe_jawaban" :value="__('Tipe Jawaban')" />
                                <select id="tipe_jawaban" name="tipe_jawaban" x-model="tipeJawaban"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="ya_tidak">Ya / Tidak</option>
                                    <option value="rating_1_5">Rating 1-5</option>
                                </select>
                                <x-input-error :messages="$errors->get('tipe_jawaban')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="teks_pertanyaan" :value="__('Teks Pertanyaan')" />
                                <textarea id="teks_pertanyaan" name="teks_pertanyaan" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>{{ old('teks_pertanyaan') }}</textarea>
                                <x-input-error :messages="$errors->get('teks_pertanyaan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="urutan" :value="__('Nomor Urutan')" />
                                <x-text-input id="urutan" name="urutan" type="number" 
                                    x-bind:value="urutanBaru"
                                    class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('urutan')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            Pilihan Jawaban & Bobot Nilai
                        </h3>

                        <div x-show="tipeJawaban === 'ya_tidak'" class="space-y-4">
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <label class="font-medium text-gray-700 dark:text-gray-300">Opsi 1</label>
                                <x-text-input type="text" name="pilihan[0][teks]" value="Ya" readonly
                                    class="bg-gray-100 dark:bg-gray-700" 
                                    x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                <div>
                                    <x-text-input type="number" name="pilihan[0][bobot]" 
                                        :value="old('pilihan.0.bobot')"
                                        placeholder="Bobot (cth: 1)" class="w-full"
                                        x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                    {{-- PERBAIKAN 2: Menambahkan pesan error yg hilang --}}
                                    <x-input-error :messages="$errors->get('pilihan.0.bobot')" class="mt-1" />
                                </div>
                            </div>
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <label class="font-medium text-gray-700 dark:text-gray-300">Opsi 2</label>
                                <x-text-input type="text" name="pilihan[1][teks]" value="Tidak" readonly
                                    class="bg-gray-100 dark:bg-gray-700" 
                                    x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                <div>
                                    <x-text-input type="number" name="pilihan[1][bobot]" 
                                        :value="old('pilihan.1.bobot')"
                                        placeholder="Bobot (cth: 0)" class="w-full"
                                        x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                    {{-- PERBAIKAN 2: Menambahkan pesan error yg hilang --}}
                                    <x-input-error :messages="$errors->get('pilihan.1.bobot')" class="mt-1" />
                                </div>
                            </div>
                        </div>

                        <div x-show="tipeJawaban === 'rating_1_5'" class="space-y-4">
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <label class="font-medium text-gray-500 dark:text-gray-400 text-sm">Label</label>
                                <label class="font-medium text-gray-500 dark:text-gray-400 text-sm">Teks Jawaban</label>
                                <label class="font-medium text-gray-500 dark:text-gray-400 text-sm">Bobot Nilai</label>
                            </div>

                            @for ($i = 0; $i < 5; $i++)
                                <div class="grid grid-cols-3 gap-4">
                                    <label class="font-medium text-gray-700 dark:text-gray-300 pt-2">Opsi {{ $i + 1 }}</label>
                                    <div>
                                        <x-text-input type="text" name="pilihan[{{ $i }}][teks]"
                                            :value="old('pilihan.' . $i . '.teks')" placeholder="Teks Jawaban" class="mt-1 block w-full"
                                            x-bind:disabled="tipeJawaban !== 'rating_1_5'" />
                                        <x-input-error :messages="$errors->get('pilihan.' . $i . '.teks')" class="mt-1" />
                                    </div>
                                    <div>
                                        <x-text-input type="number" name="pilihan[{{ $i }}][bobot]"
                                            :value="old('pilihan.' . $i . '.bobot')" placeholder="Bobot (cth: {{ $i + 1 }})"
                                            class="mt-1 block w-full" x-bind:disabled="tipeJawaban !== 'rating_1_5'" />
                                        <x-input-error :messages="$errors->get('pilihan.' . $i . '.bobot')" class="mt-1" />
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-6 py-4 bg-gray-50 dark:bg-gray-700 text-right space-x-4">
                        <a href="{{ route('kelola-deteksi.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                        <x-primary-button>
                            {{ __('Simpan Pertanyaan') }}
                        </x-primary-button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>