<section
    x-data="profileConfirm({
        name: '{{ $user->name }}',
        email: '{{ $user->email }}'
    })"
>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form
        method="post"
        action="{{ route('profile.update') }}"
        class="mt-6 space-y-6"
        @submit.prevent="openConfirm"
    >
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full"
                required
                autofocus
                autocomplete="name"
            />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full"
                required
                autocomplete="username"
            />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}
                    <button
                        form="send-verification"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900"
                    >
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>
                {{ __('Save') }}
            </x-primary-button>
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
                Konfirmasi Perubahan
            </h3>

            <ul class="mt-4 text-sm text-gray-700 dark:text-gray-300 list-disc list-inside">
                <template x-for="item in changes" :key="item">
                    <li x-text="item"></li>
                </template>
            </ul>

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
        function profileConfirm(original) {
            return {
                showModal: false,
                changes: [],
                original,

                openConfirm(e) {
                    this.changes = [];

                    const name = document.getElementById('name').value;
                    const email = document.getElementById('email').value;

                    if (name !== this.original.name) {
                        this.changes.push(`Nama: "${this.original.name}" → "${name}"`);
                    }

                    if (email !== this.original.email) {
                        this.changes.push(`Email: "${this.original.email}" → "${email}"`);
                    }

                    if (this.changes.length === 0) {
                        e.target.submit();
                    } else {
                        this.showModal = true;
                    }
                },

                submitForm() {
                    this.showModal = false;
                    document.querySelector('form[method="post"][action*="profile.update"]').submit();
                }
            }
        }
    </script>
</section>
