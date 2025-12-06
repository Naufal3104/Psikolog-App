@extends('layouts.main')

{{-- Judul halaman browser akan mengambil judul pertanyaan --}}
@section('title', $tanyaJawab->judul_pertanyaan)

@push('styles')
    {{-- Style untuk format daftar komentar (tetap diperlukan) --}}
    <style>
        .comment-item {
            display: flex;
            gap: 16px;
            padding: 16px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #6b7280;
            font-weight: 600;
        }

        .comment-content .author-name {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .comment-content .comment-text {
            font-size: 0.95rem;
            color: #374151;
            line-height: 1.6;
        }

        .comment-content .comment-meta {
            font-size: 0.8rem;
            color: #9ca3af;
            margin-top: 6px;
        }

        /* Style untuk tag 'Penanya' atau 'Psikolog' */
        .author-tag {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .tag-penanya {
            color: #004780;
            background-color: #f0f7ff;
        }

        .tag-psikolog {
            color: #10a884;
            background-color: #f0fff4;
        }

        /* Style Sederhana untuk Form Balasan */
        .form-textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-size: 0.95rem;
            background-color: white;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #004780;
            box-shadow: 0 0 0 2px rgba(0, 71, 128, 0.2);
        }

        .submit-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
            border-radius: 8px;
            background-color: #004780;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
            border: none;
            cursor: pointer;
            margin-top: 12px;
        }

        .submit-button:hover {
            background-color: #00335c;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 24px;
            border-radius: 8px;
            background-color: #6b7280;
            color: white;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.15s ease-in-out;
            border: none;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #4b5563;
        }

        .back-button svg {
            margin-right: 8px;
        }

        /* Dark Mode Styles - Menggunakan multiple selectors */
        /* FORCE OVERRIDE CARD BACKGROUND */
        .dark .animate_top,
        .eh .animate_top,
        html.dark .animate_top {
            background-color: #1f2937 !important;
            border-color: #4b5563 !important;
        }
        .dark .comment-item,
        .eh .comment-item,
        html.dark .comment-item {
            border-bottom-color: #374151 !important;
        }

        .dark .avatar-placeholder,
        .eh .avatar-placeholder,
        html.dark .avatar-placeholder {
            background-color: #374151 !important;
            color: #9ca3af !important;
        }

        .dark .comment-content .author-name,
        .eh .comment-content .author-name,
        html.dark .comment-content .author-name {
            color: #f3f4f6 !important;
        }

        .dark .comment-content .comment-text,
        .eh .comment-content .comment-text,
        html.dark .comment-content .comment-text {
            color: #d1d5db !important;
        }

        .dark .comment-content .comment-meta,
        .eh .comment-content .comment-meta,
        html.dark .comment-content .comment-meta {
            color: #6b7280 !important;
        }

        .dark .tag-penanya,
        .eh .tag-penanya,
        html.dark .tag-penanya {
            color: #60a5fa !important;
            background-color: #1e3a5f !important;
        }

        .dark .tag-psikolog,
        .eh .tag-psikolog,
        html.dark .tag-psikolog {
            color: #34d399 !important;
            background-color: #064e3b !important;
        }

        .dark .form-textarea,
        .eh .form-textarea,
        html.dark .form-textarea {
            background-color: #374151 !important;
            border-color: #4b5563 !important;
            color: #d1d5db !important;
        }

        .dark .form-textarea::placeholder,
        .eh .form-textarea::placeholder,
        html.dark .form-textarea::placeholder {
            color: #9ca3af !important;
        }

        .dark .form-textarea:focus,
        .eh .form-textarea:focus,
        html.dark .form-textarea:focus {
            border-color: #60a5fa !important;
            box-shadow: 0 0 0 2px rgba(96, 165, 250, 0.2) !important;
        }

        .dark .submit-button,
        .eh .submit-button,
        html.dark .submit-button {
            background-color: #3b82f6 !important;
        }

        .dark .submit-button:hover,
        .eh .submit-button:hover,
        html.dark .submit-button:hover {
            background-color: #2563eb !important;
        }

        .dark .back-button,
        .eh .back-button,
        html.dark .back-button {
            background-color: #4b5563 !important;
        }

        .dark .back-button:hover,
        .eh .back-button:hover,
        html.dark .back-button:hover {
            background-color: #374151 !important;
        }

        /* Dark mode untuk teks paragraf justify */
        .dark p.justify,
        .eh p.justify,
        html.dark p.justify {
            color: #d1d5db !important;
        }

        /* Dark mode untuk meta info list */
        .dark ul.tc.uf.cg li,
        .eh ul.tc.uf.cg li,
        html.dark ul.tc.uf.cg li {
            color: #d1d5db !important;
        }

        .dark ul.tc.uf.cg li span.rc,
        .eh ul.tc.uf.cg li span.rc,
        html.dark ul.tc.uf.cg li span.rc {
            color: #9ca3af !important;
        }

        /* Dark mode untuk heading */
        .dark h2.ek,
        .dark h3.ek,
        .eh h2.ek,
        .eh h3.ek,
        html.dark h2.ek,
        html.dark h3.ek {
            color: #f3f4f6 !important;
        }

        /* Dark mode untuk empty state */
        .dark .comments-list p,
        .eh .comments-list p,
        html.dark .comments-list p {
            color: #9ca3af !important;
        }

        /* Dark mode untuk label form */
        .dark label,
        .eh label,
        html.dark label {
            color: #d1d5db !important;
        }

        /* Dark mode untuk text-gray-700 dari Tailwind */
        .dark .text-gray-700,
        .eh .text-gray-700,
        html.dark .text-gray-700 {
            color: #d1d5db !important;
        }
    </style>
@endpush

@section('content')
    {{-- Wrapper section dari isiartikel.blade.php --}}
    <section class="ri qp gr hj rp hr" style="padding-top: 6rem !important;">
        <div class="bb ze ki xn 2xl:ud-px-0">

            {{-- REVISI 1: Ganti layout grid 2-kolom dengan 1-kolom terpusat --}}
            {{-- Saya ganti `tc sf yo zf kq` dengan container Tailwind standar --}}
            <div class="max-w-4xl mx-auto">

                {{-- KOLOM KONTEN UTAMA (sekarang full-width) --}}
                <div class="w-full">

                    {{-- KARTU 1: POSTINGAN PERTANYAAN --}}
                    {{-- REVISI 3: Jarak margin bawah dikurangi dari mb-10 menjadi mb-6 --}}
                    <div
                        class="animate_top rounded-md shadow-solid-13 bg-white dark:bg-blacksection border border-stroke dark:border-strokedark p-7.5 md:p-10 mb-6">

                        {{-- Judul Pertanyaan --}}
                        <h2 class="ek vj 2xl:ud-text-title-lg kk wm nb gb">
                            {{ $tanyaJawab->judul_pertanyaan }}
                        </h2>

                        {{-- Meta Info: Penanya, Tanggal, Status --}}
                        <ul class="tc uf cg 2xl:ud-gap-15 fb">
                            <li>
                                <span class="rc kk wm">Penanya: </span>
                                {{ $tanyaJawab->user->name ?? 'Anonim' }}
                            </li>
                            <li>
                                <span class="rc kk wm">Tanggal: </span>
                                {{ $tanyaJawab->created_at->format('d F Y, H:i') }}
                            </li>
                            <li>
                                <span class="rc kk wm">Status: </span>
                                <span
                                    style="text-transform: capitalize; font-weight: 600; color: {{ $tanyaJawab->status == 'sudah dijawab' ? '#10a884' : '#f59e0b' }};">
                                    {{ $tanyaJawab->status }}
                                </span>
                            </li>
                        </ul>

                        {{-- Isi Pertanyaan --}}
                        <p class="justify" style="font-size: 1.1rem; line-height: 1.7;">
                            {!! nl2br(e($tanyaJawab->pertanyaan)) !!}
                        </p>

                        {{-- Tombol Share (diambil dari isiartikel) --}}
                        <ul class="tc wf bg sb">
                            <li>
                                <p class="sj kk wm tb">Bagikan di:</p>
                            </li>
                            <li>
                                <a href="#!" class="tc wf xf yd ad rg ml il ih wk">
                                    {{-- SVG Facebook --}}
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_47_28)">
                                            <path
                                                d="M11.6663 11.25H13.7497L14.583 7.91663H11.6663V6.24996C11.6663 5.39163 11.6663 4.58329 13.333 4.58329H14.583V1.78329C14.3113 1.74746 13.2855 1.66663 12.2022 1.66663C9.93967 1.66663 8.33301 3.04746 8.33301 5.58329V7.91663H5.83301V11.25H8.33301V18.3333H11.6663V11.25Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_28">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="tc wf xf yd ad rg ml il jh wk">
                                    {{-- SVG Twitter --}}
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_47_47)">
                                            <path
                                                d="M18.4683 4.71327C17.8321 4.99468 17.1574 5.1795 16.4666 5.26161C17.1947 4.82613 17.7397 4.14078 17.9999 3.33327C17.3166 3.73994 16.5674 4.02494 15.7866 4.17911C15.2621 3.61792 14.5669 3.24574 13.809 3.12043C13.0512 2.99511 12.2732 3.12368 11.596 3.48615C10.9187 3.84862 10.3802 4.42468 10.0642 5.12477C9.74812 5.82486 9.67221 6.60976 9.84825 7.35744C8.46251 7.28798 7.10686 6.92788 5.86933 6.30049C4.63179 5.67311 3.54003 4.79248 2.66492 3.71577C2.35516 4.24781 2.19238 4.85263 2.19326 5.46827C2.19326 6.67661 2.80826 7.74411 3.74326 8.36911C3.18993 8.35169 2.64878 8.20226 2.16492 7.93327V7.97661C2.16509 8.78136 2.44356 9.56129 2.95313 10.1842C3.46269 10.807 4.17199 11.2345 4.96075 11.3941C4.4471 11.5333 3.90851 11.5538 3.38576 11.4541C3.60814 12.1468 4.04159 12.7526 4.62541 13.1867C5.20924 13.6208 5.9142 13.8614 6.64159 13.8749C5.91866 14.4427 5.0909 14.8624 4.20566 15.1101C3.32041 15.3577 2.39503 15.4285 1.48242 15.3183C3.0755 16.3428 4.93 16.8867 6.82409 16.8849C13.2349 16.8849 16.7408 11.5741 16.7408 6.96827C16.7408 6.81827 16.7366 6.66661 16.7299 6.51827C17.4123 6.02508 18.0013 5.41412 18.4691 4.71411L18.4683 4.71327Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_47_47">
                                                <rect width="20" height="20" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            </li>
                        </ul>

                        {{-- Tombol Kembali --}}
                        <div style="margin-top: 1.5rem;">
                            <a href="{{ url()->previous() }}" class="back-button">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5 15L7.5 10L12.5 5" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Kembali
                            </a>
                        </div>
                    </div>

                    {{-- REVISI 2: Urutan ditukar --}}
                    {{-- KARTU 2: DAFTAR BALASAN/KOMENTAR --}}
                    {{-- REVISI 3: Jarak margin bawah dikurangi menjadi mb-6 --}}
                    <div
                        class="animate_top rounded-md shadow-solid-13 bg-white dark:bg-blacksection border border-stroke dark:border-strokedark p-7.5 md:p-10 mb-6">
                        <h3 class="ek vj kk wm nb gb mb-6">
                            Semua Balasan ({{ $tanyaJawab->balasan->count() }})
                        </h3>

                        <div class="comments-list">
                            @forelse ($tanyaJawab->balasan as $balasan)
                                <div class="comment-item">
                                    <div class="avatar-placeholder">
                                        {{ $balasan->user ? strtoupper(substr($balasan->user->name, 0, 1)) : 'A' }}
                                    </div>
                                    <div class="comment-content" style="width: 100%;">
                                        <div class="author-name">
                                            <span>{{ $balasan->user->name ?? 'Anonim' }}</span>

                                            @if ($balasan->user_id == $tanyaJawab->user_id)
                                                <span class="author-tag tag-penanya">Penanya</span>
                                            @elseif ($balasan->user && $balasan->user->hasRole('psikolog'))
                                                <span class="author-tag tag-psikolog">Psikolog Terverifikasi</span>
                                            @endif

                                            {{-- @if ($balasan->user->role == 'psikolog')
                                                <span class="author-tag tag-psikolog">Psikolog</span>
                                            @endif --}}
                                        </div>
                                        <div class="comment-text">
                                            {!! nl2br(e($balasan->isi_balasan)) !!}
                                        </div>
                                        <div class="comment-meta">
                                            {{ $balasan->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p style="text-align: center; color: #6b7280; padding: 20px 0;">
                                    Belum ada balasan untuk pertanyaan ini. Jadilah yang pertama!
                                </p>
                            @endforelse
                        </div>
                    </div>

                    {{-- REVISI 2: Urutan ditukar --}}
                    {{-- KARTU 3: FORM BUAT BALASAN/KOMENTAR --}}
                    <div
                        class="animate_top rounded-md shadow-solid-13 bg-white dark:bg-blacksection border border-stroke dark:border-strokedark p-7.5 md:p-10">
                        <h3 class="ek vj kk wm nb gb">Beri Balasan</h3>

                        {{-- 
                            CATATAN: Anda perlu membuat route dan method controller untuk ini.
                            Contoh: Route::post('/tanya/{id}/balas', [BalasanController::class, 'store'])->name('tanya.balas.store');
                        --}}
                        <form action="{{ route('tanya.balas.store', $tanyaJawab->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="isi_balasan"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 sr-only">Balasan
                                    Anda:</label>
                                <textarea name="isi_balasan" id="isi_balasan" rows="4" class="form-textarea"
                                    placeholder="Tulis balasan Anda di sini..."></textarea>
                            </div>
                            <div>
                                <button type="submit" class="submit-button">
                                    Kirim Balasan
                                </button>
                            </div>
                        </form>
                    </div>

                </div> {{-- Akhir Kolom Konten Utama --}}

                {{-- REVISI 1: KOLOM SIDEBAR DIHAPUS --}}

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- Pastikan feather icons di-load jika belum ada di layout utama --}}
    <script>
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
@endpush