<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Pertanyaan Deteksi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('kelola-deteksi.update', $pertanyaan->id) }}" x-data="{ tipeJawaban: '{{ old('tipe_jawaban', $pertanyaan->tipe_jawaban) }}' }">
                @csrf
                @method('PUT')

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">
                            Detail Pertanyaan
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="kategori_deteksi_id" :value="__('Kategori')" />
                                <select id="kategori_deteksi_id" name="kategori_deteksi_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach ($kategoriDeteksi as $kat)
                                        <option value="{{ $kat->id }}"
                                            {{ old('kategori_deteksi_id', $pertanyaan->kategori_deteksi_id) == $kat->id ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- TAMBAHKAN PESAN ERROR --}}
                                <x-input-error :messages="$errors->get('kategori_deteksi_id')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="tipe_jawaban" :value="__('Tipe Jawaban')" />
                                <select id="tipe_jawaban" name="tipe_jawaban" x-model="tipeJawaban"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required>
                                    <option value="ya_tidak"
                                        {{ old('tipe_jawaban', $pertanyaan->tipe_jawaban) == 'ya_tidak' ? 'selected' : '' }}>
                                        Ya / Tidak</option>
                                    <option value="rating_1_5"
                                        {{ old('tipe_jawaban', $pertanyaan->tipe_jawaban) == 'rating_1_5' ? 'selected' : '' }}>
                                        Rating 1-5</option>
                                </select>
                                {{-- TAMBAHKAN PESAN ERROR --}}
                                <x-input-error :messages="$errors->get('tipe_jawaban')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="teks_pertanyaan" :value="__('Teks Pertanyaan')" />
                                <textarea id="teks_pertanyaan" name="teks_pertanyaan" rows="3"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('teks_pertanyaan', $pertanyaan->teks_pertanyaan) }}</textarea>
                                {{-- TAMBAHKAN PESAN ERROR --}}
                                <x-input-error :messages="$errors->get('teks_pertanyaan')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="urutan" :value="__('Nomor Urutan')" />
                                <x-text-input id="urutan" name="urutan" type="number" :value="old('urutan', $pertanyaan->urutan)"
                                    class="mt-1 block w-full" required />
                                {{-- TAMBAHKAN PESAN ERROR --}}
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

                        @php
                            $pilihanYa =
                                $pertanyaan->pilihanJawaban->firstWhere('teks_jawaban', 'Ya') ??
                                new \App\Models\PilihanJawaban();
                            $pilihanTidak =
                                $pertanyaan->pilihanJawaban->firstWhere('teks_jawaban', 'Tidak') ??
                                new \App\Models\PilihanJawaban();
                        @endphp

                        <div x-show="tipeJawaban === 'ya_tidak'" class="space-y-4">
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <label class="font-medium text-gray-700 dark:text-gray-300">Opsi 1</label>
                                {{-- TIDAK PERLU HIDDEN ID --}}
                                <x-text-input type="text" name="pilihan[0][teks]" value="Ya" readonly
                                    class="bg-gray-100 dark:bg-gray-700" x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                <x-text-input type="number" name="pilihan[0][bobot]" :value="old('pilihan.0.bobot', $pilihanYa->bobot_nilai)"
                                    placeholder="Bobot (cth: 1)" class="w-full" x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                <x-input-error :messages="$errors->get('pilihan.0.bobot')" class="mt-1" />
                            </div>
                            <div class="grid grid-cols-3 gap-4 items-center">
                                <label class="font-medium text-gray-700 dark:text-gray-300">Opsi 2</label>
                                {{-- TIDAK PERLU HIDDEN ID --}}
                                <x-text-input type="text" name="pilihan[1][teks]" value="Tidak" readonly
                                    class="bg-gray-100 dark:bg-gray-700" x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                <x-text-input type="number" name="pilihan[1][bobot]" :value="old('pilihan.1.bobot', $pilihanTidak->bobot_nilai)"
                                    placeholder="Bobot (cth: 0)" class="w-full" x-bind:disabled="tipeJawaban !== 'ya_tidak'" />
                                <x-input-error :messages="$errors->get('pilihan.1.bobot')" class="mt-1" />
                            </div>
                        </div>

                        <div x-show="tipeJawaban === 'rating_1_5'" class="space-y-4">
                            {{-- ... header label ... --}}

                            @for ($i = 0; $i < 5; $i++)
                                @php
                                    $pilihan = $pertanyaan->pilihanJawaban->get($i) ?? new \App\Models\PilihanJawaban();
                                @endphp
                                <div class="grid grid-cols-3 gap-4">
                                    <label class="font-medium text-gray-700 dark:text-gray-300 pt-2">Opsi
                                        {{ $i + 1 }}</label>
                                    <div>
                                        {{-- TIDAK PERLU HIDDEN ID --}}
                                        <x-text-input type="text" name="pilihan[{{ $i }}][teks]"
                                            :value="old('pilihan.' . $i . '.teks', $pilihan->teks_jawaban)" placeholder="Teks Jawaban" class="mt-1 block w-full"
                                            x-bind:disabled="tipeJawaban !== 'rating_1_5'" />
                                        <x-input-error :messages="$errors->get('pilihan.' . $i . '.teks')" class="mt-1" />
                                    </div>
                                    <div>
                                        <x-text-input type="number" name="pilihan[{{ $i }}][bobot]"
                                            :value="old('pilihan.' . $i . '.bobot', $pilihan->bobot_nilai)" placeholder="Bobot (cth: {{ $i + 1 }})"
                                            class="mt-1 block w-full" x-bind:disabled="tipeJawaban !== 'rating_1_5'" />
                                        <x-input-error :messages="$errors->get('pilihan.' . $i . '.bobot')" class="mt-1" />
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end px-6 py-4 bg-gray-50 dark:bg-gray-700 text-right space-x-4">
                        <a href="{{ route('kelola-deteksi.index') }}"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:underline">Batal</a>
                        <x-primary-button>
                            {{ __('Update Pertanyaan') }}
                        </x-primary-button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
