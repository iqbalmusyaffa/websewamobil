<section class="space-y-6">
    <div class="p-4 bg-red-100 border border-red-300 rounded-lg flex items-start gap-3">
        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path></svg>
        <div>
            <p class="text-sm font-bold text-red-900">
                ⚠️ Peringatan
            </p>
            <p class="text-sm text-red-800 mt-1">
                Menghapus akun Anda adalah tindakan permanen. Semua data, riwayat, dan informasi akun akan dihapus selamanya dan tidak dapat dipulihkan.
            </p>
        </div>
    </div>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable class="bg-white">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <div class="flex items-start gap-4 mb-6">
                <div class="p-3 bg-red-100 rounded-lg flex-shrink-0">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-red-900">
                        Hapus Akun Anda?
                    </h2>
                    <p class="text-sm text-slate-600 mt-2">
                        Tindakan ini tidak dapat dibatalkan. Pastikan Anda sudah mengunduh semua data penting sebelum melanjutkan.
                    </p>
                </div>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-red-900 font-medium mb-2">Apa yang akan dihapus:</p>
                <ul class="text-sm text-red-800 space-y-1">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                        Semua informasi profil
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                        Riwayat transaksi dan pesanan
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"></path></svg>
                        Wishlist dan preferensi
                    </li>
                </ul>
            </div>

            <div class="space-y-4 mb-6">
                <div class="space-y-2">
                    <x-input-label for="password" value="{{ __('Konfirmasi dengan Kata Sandi Anda') }}" class="text-slate-700 font-medium" />
                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="block w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors"
                        placeholder="{{ __('Masukkan kata sandi Anda') }}"
                    />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-600 text-sm" />
                </div>
                <p class="text-xs text-slate-500">
                    Masukkan kata sandi Anda untuk memastikan ini adalah permintaan Anda
                </p>
            </div>

            <div class="flex gap-3 justify-end">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-6 py-2.5 bg-slate-200 text-slate-900 font-medium rounded-lg hover:bg-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all duration-200"
                >
                    Batal
                </button>
                <button
                    type="submit"
                    class="px-6 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-sm hover:shadow-md"
                >
                    Ya, Hapus Akun Saya
                </button>
            </div>
        </form>
    </x-modal>
</section>
