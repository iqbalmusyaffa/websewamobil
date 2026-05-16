<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-white tracking-tight">Reset Password</h2>
        <p class="text-slate-400 mt-2 text-sm">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-300 font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full bg-slate-900/50 border-slate-700/50 text-white focus:bg-slate-900 focus:border-indigo-500 focus:ring-indigo-500 transition-colors duration-200 placeholder:text-slate-500" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-500/20 text-sm font-bold text-white bg-gradient-to-r from-indigo-500 to-indigo-600 hover:from-indigo-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-slate-900 focus:ring-indigo-500 transition-all duration-200 transform hover:-translate-y-0.5">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-slate-400 font-medium">
                Remember your password? 
                <a href="{{ route('login') }}" class="font-bold text-indigo-400 hover:text-indigo-300 transition-colors">Sign in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
