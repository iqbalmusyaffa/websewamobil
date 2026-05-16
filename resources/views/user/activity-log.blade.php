<x-front-layout>
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-slate-900 sm:text-3xl sm:truncate">
                    Log Aktivitas
                </h2>
                <p class="mt-1 text-sm text-slate-500">
                    Riwayat aktivitas akun Anda.
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4 gap-3">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transition-colors">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden">
            @if($activities->isEmpty())
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-slate-900">Belum ada aktivitas</h3>
                    <p class="mt-1 text-sm text-slate-500">Aktivitas akun Anda akan ditampilkan di sini.</p>
                </div>
            @else
                <ul class="divide-y divide-slate-100">
                    @foreach($activities as $activity)
                        <li class="p-6 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-bold text-slate-900">
                                            {{ $activity->description }}
                                        </p>
                                        <span class="text-xs text-slate-500 whitespace-nowrap">
                                            {{ $activity->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-1">
                                        Tipe: <span class="font-medium text-slate-700">{{ $activity->log_name }}</span>
                                        @if($activity->subject_type)
                                        | Terkait: <span class="font-medium text-slate-700">{{ class_basename($activity->subject_type) }} #{{ $activity->subject_id }}</span>
                                        @endif
                                    </p>
                                    @if($activity->properties->count() > 0)
                                        <div class="mt-2 p-3 bg-slate-50 rounded-lg text-xs overflow-x-auto border border-slate-100">
                                            <pre class="text-slate-600 font-mono">{{ json_encode($activity->properties, JSON_PRETTY_PRINT) }}</pre>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                @if($activities->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $activities->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>
</x-front-layout>
