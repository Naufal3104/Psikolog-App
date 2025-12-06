@extends('layouts.main')
@section('title', 'Edit Profil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/styles/style.css') }}" />
    <link href="{{ asset('fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .centered-content {
            display: flex;
            flex-direction: column; /* Mengubah arah menjadi kolom agar kartu bertumpuk */
            justify-content: flex-start;
            align-items: center;
            min-height: calc(100vh - 200px);
            padding: 120px 20px 60px 20px;
            width: 100%;
            gap: 2rem; /* Jarak antar kartu */
        }

        @media (max-width: 768px) {
            .centered-content {
                padding: 100px 20px 40px 20px;
            }
        }

        .consultation-card {
            max-width: 600px; /* Sedikit diperlebar agar form muat */
            width: 90%;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.2),
                        0 8px 10px -4px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .consultation-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -5px rgba(0, 0, 0, 0.25),
                        0 10px 15px -4px rgba(0, 0, 0, 0.1);
        }

        .eh .consultation-card {
            background-color: #1f2937 !important;
            border-color: #4b5563 !important;
        }

        .card-header {
            background-color: #004780 !important;
            color: white;
            padding: 1.5rem;
            text-align: center;
            border-top-left-radius: 23px;
            border-top-right-radius: 23px;
        }

        /* Styling Form Elements agar sesuai tema */
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .eh .form-label {
            color: #d1d5db;
        }

        .form-input {
            width: 100%;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            padding: 0.625rem;
            background-color: #f9fafb;
            color: #111827;
        }

        .eh .form-input {
            background-color: #374151;
            border-color: #4b5563;
            color: white;
        }

        .btn-primary-custom {
            background-color: #004780 !important;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .btn-primary-custom:hover {
            background-color: #003366 !important;
        }

        .btn-danger-custom {
            background-color: #ef4444 !important;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')

<x-layout.navbar />

<div class="centered-content">

    <div class="consultation-card">
        <div class="card-header">
            <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Informasi Profil</h2>
        </div>
        <div style="padding: 32px 24px;">
            <form method="post" action="{{ route('user.profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')

                <div class="form-group">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input id="name" name="name" type="text" class="form-input" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-input" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn-primary-custom">Simpan Perubahan</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                            {{ __('Tersimpan.') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="consultation-card">
        <div class="card-header" style="background-color: #0d9488 !important;"> <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Ganti Password</h2>
        </div>
        <div style="padding: 32px 24px;">
            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="current_password" class="form-label">Password Saat Ini</label>
                    <input id="current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password Baru</label>
                    <input id="password" name="password" type="password" class="form-input" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="btn-primary-custom" style="background-color: #0d9488 !important;">Update Password</button>
                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">
                            {{ __('Tersimpan.') }}
                        </p>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="consultation-card" style="border-color: #fee2e2;">
        <div class="card-header" style="background-color: #dc2626 !important;">
            <h2 style="margin: 0; font-size: 1.25rem; font-weight: bold;">Hapus Akun</h2>
        </div>
        <div style="padding: 32px 24px;">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
            </p>

            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="w-full justify-center">
                {{ __('Hapus Akun Saya') }}
            </x-danger-button>

            <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('user.profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
                    </p>

                    <div class="mt-6">
                        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />
                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-secondary-button>

                        <x-danger-button class="ms-3">
                            {{ __('Hapus Akun') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script>
        feather.replace();
    </script>
@endpush