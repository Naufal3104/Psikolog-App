<section x-data="passwordConfirm()">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form
        method="post"
        action="{{ route('password.update') }}"
        class="mt-6 space-y-6"
        @submit.prevent="openConfirm"
    >
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />

            <div class="relative mt-1">
                <x-text-input
                    id="current_password"
                    name="current_password"
                    type="password"
                    class="block w-full pr-12"
                    autocomplete="current-password"
                />

                <button
                    type="button"
                    onclick="togglePassword('current_password','eyeCurrent')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <svg id="eyeCurrent" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 
                            4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" />

            <div class="relative mt-1">
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full pr-12"
                    autocomplete="new-password"
                />

                <button
                    type="button"
                    onclick="togglePassword('password','eyeNew')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <svg id="eyeNew" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 
                            4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <div class="relative mt-1">
                <x-text-input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="block w-full pr-12"
                    autocomplete="new-password"
                />

                <button
                    type="button"
                    onclick="togglePassword('password_confirmation','eyeConfirm')"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700"
                >
                    <svg id="eyeConfirm" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 
                            4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>

    <!-- MODAL KONFIRMASI -->
    <div
        x-show="showModal"
        x-transition
        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
    >
        <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-md p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                Konfirmasi Perubahan Password
            </h3>

            <p class="mt-4 text-sm text-gray-700 dark:text-gray-300">
                Apakah Anda yakin ingin mengubah password akun?
            </p>

            <div class="mt-6 flex justify-end gap-3">
                <button
                    type="button"
                    @click="showModal = false"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                >
                    Batalkan
                </button>

                <button
                    type="button"
                    @click="submitForm"
                    class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700"
                >
                    Ubah
                </button>
            </div>
        </div>
    </div>

    <script>
        function passwordConfirm() {
            return {
                showModal: false,
                openConfirm() {
                    this.showModal = true;
                },
                submitForm() {
                    document.querySelector('form').submit();
                }
            }
        }

        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('stroke', '#000');
            } else {
                input.type = 'password';
                icon.setAttribute('stroke', 'currentColor');
            }
        }
    </script>
</section>
