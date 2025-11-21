<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jawab Pertanyaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700 p-6">

                <div class="mb-6">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100">Pertanyaan:</h3>
                    <p class="mt-2 text-gray-700 dark:text-gray-300">{{ $tanyaJawab->pertanyaan }}</p>
                </div>

                <form action="{{ route('psikolog.jawab.submit', $tanyaJawab->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <x-input-label for="jawaban" :value="__('Jawaban Anda')" />
                        <textarea id="jawaban" name="jawaban" rows="8"
                            class="mt-2 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Tuliskan jawaban Anda di sini..." required>{{ old('jawaban', $tanyaJawab->jawaban) }}</textarea>
                        <x-input-error :messages="$errors->get('jawaban')" class="mt-2" />
                    </div>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Kirim Jawaban
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>