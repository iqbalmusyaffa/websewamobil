<x-front-layout>
<div class="bg-slate-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <a href="{{ route('dashboard') }}" class="text-sky-600 hover:text-sky-700">← Kembali</a>
            </div>
            <h2 class="text-3xl font-bold text-slate-900 mb-2">Unggah Dokumen</h2>
            <p class="text-slate-600">Upload KTP dan SIM Anda untuk verifikasi identitas</p>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-800 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                <p class="text-red-800 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Dokumen Saat Ini -->
        @if($document)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
                <h3 class="text-xl font-bold text-slate-900 mb-4">Status Dokumen Anda</h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Status Badge -->
                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-lg">
                        <div class="flex-shrink-0">
                            @if($document->status === 'disetujui')
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-green-100">
                                    <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            @elseif($document->status === 'ditolak')
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            @else
                                <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-yellow-100">
                                    <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Status Dokumen</p>
                            <p class="text-lg font-bold text-slate-900 capitalize">{{ $document->status }}</p>
                        </div>
                    </div>

                    <!-- KTP Status -->
                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-lg">
                        <div class="flex-shrink-0">
                            @if($document->ktp_path)
                                <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="h-6 w-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">KTP</p>
                            <p class="text-sm font-medium text-slate-900">{{ $document->ktp_path ? '✓ Terupload' : '✗ Belum upload' }}</p>
                        </div>
                    </div>

                    <!-- SIM Status -->
                    <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-lg">
                        <div class="flex-shrink-0">
                            @if($document->sim_path)
                                <svg class="h-6 w-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="h-6 w-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">SIM</p>
                            <p class="text-sm font-medium text-slate-900">{{ $document->sim_path ? '✓ Terupload' : '✗ Belum upload' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form Upload -->
        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- KTP Upload -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="h-5 w-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2H4a1 1 0 110-2V4zm3 5a1 1 0 100 2h6a1 1 0 100-2H7z" />
                        </svg>
                        KTP (Kartu Tanda Penduduk)
                    </h3>

                    <!-- Tabs -->
                    <div class="flex gap-2 mb-4 border-b border-slate-200">
                        <button type="button" class="ktp-tab-btn active px-4 py-2 text-sm font-medium text-sky-600 border-b-2 border-sky-600" data-tab="ktp-upload">
                            Upload File
                        </button>
                        <button type="button" class="ktp-tab-btn px-4 py-2 text-sm font-medium text-slate-600 border-b-2 border-transparent hover:text-slate-900" data-tab="ktp-link">
                            Link / URL
                        </button>
                    </div>

                    <!-- Upload File Tab -->
                    <div id="ktp-upload-tab" class="ktp-tab-content">
                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-slate-400 hover:bg-slate-50 transition">
                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="mt-2 text-sm text-slate-600">
                                <label class="text-sky-600 font-medium hover:text-sky-700 cursor-pointer">
                                    Klik untuk upload
                                    <input type="file" name="ktp_file" accept="image/*,.pdf" class="hidden" id="ktp-file">
                                </label>
                                atau drag & drop
                            </p>
                            <p class="text-xs text-slate-500 mt-1">JPG, PNG, atau PDF (max 5MB)</p>
                        </div>
                        <p id="ktp-file-name" class="mt-2 text-sm text-slate-600"></p>
                    </div>

                    <!-- Link Tab -->
                    <div id="ktp-link-tab" class="ktp-tab-content hidden">
                        <input type="url" name="ktp_url" placeholder="https://drive.google.com/file/d/..."
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                            @if($document && $document->ktp_path && str_starts_with($document->ktp_path, 'http')) value="{{ $document->ktp_path }}" @endif>
                        <p class="text-xs text-slate-600 mt-2">Paste link sharing dari Google Drive atau sumber lain</p>
                    </div>
                </div>

                <!-- SIM Upload -->
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                        <svg class="h-5 w-5 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2H4a1 1 0 110-2V4zm3 5a1 1 0 100 2h6a1 1 0 100-2H7z" />
                        </svg>
                        SIM (Surat Izin Mengemudi)
                    </h3>

                    <!-- Tabs -->
                    <div class="flex gap-2 mb-4 border-b border-slate-200">
                        <button type="button" class="sim-tab-btn active px-4 py-2 text-sm font-medium text-sky-600 border-b-2 border-sky-600" data-tab="sim-upload">
                            Upload File
                        </button>
                        <button type="button" class="sim-tab-btn px-4 py-2 text-sm font-medium text-slate-600 border-b-2 border-transparent hover:text-slate-900" data-tab="sim-link">
                            Link / URL
                        </button>
                    </div>

                    <!-- Upload File Tab -->
                    <div id="sim-upload-tab" class="sim-tab-content">
                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-slate-400 hover:bg-slate-50 transition">
                            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <p class="mt-2 text-sm text-slate-600">
                                <label class="text-sky-600 font-medium hover:text-sky-700 cursor-pointer">
                                    Klik untuk upload
                                    <input type="file" name="sim_file" accept="image/*,.pdf" class="hidden" id="sim-file">
                                </label>
                                atau drag & drop
                            </p>
                            <p class="text-xs text-slate-500 mt-1">JPG, PNG, atau PDF (max 5MB)</p>
                        </div>
                        <p id="sim-file-name" class="mt-2 text-sm text-slate-600"></p>
                    </div>

                    <!-- Link Tab -->
                    <div id="sim-link-tab" class="sim-tab-content hidden">
                        <input type="url" name="sim_url" placeholder="https://drive.google.com/file/d/..."
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-transparent"
                            @if($document && $document->sim_path && str_starts_with($document->sim_path, 'http')) value="{{ $document->sim_path }}" @endif>
                        <p class="text-xs text-slate-600 mt-2">Paste link sharing dari Google Drive atau sumber lain</p>
                    </div>
                </div>

            </div>

            <!-- Buttons -->
            <div class="mt-8 flex gap-4">
                <button type="submit" class="flex-1 px-6 py-3 bg-sky-600 text-white font-semibold rounded-lg hover:bg-sky-700 transition-colors">
                    💾 Simpan Dokumen
                </button>
                <a href="{{ route('dashboard') }}" class="px-6 py-3 border border-slate-300 text-slate-700 font-semibold rounded-lg hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>

    </div>
</div>

<script>
    // KTP Tabs
    document.querySelectorAll('.ktp-tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.ktp-tab-btn').forEach(b => {
                b.classList.remove('active', 'text-sky-600', 'border-sky-600');
                b.classList.add('text-slate-600', 'border-transparent');
            });
            btn.classList.add('active', 'text-sky-600', 'border-sky-600');
            btn.classList.remove('text-slate-600', 'border-transparent');

            const tabName = btn.dataset.tab;
            document.querySelectorAll('.ktp-tab-content').forEach(tab => tab.classList.add('hidden'));
            document.getElementById(tabName + '-tab').classList.remove('hidden');
        });
    });

    // SIM Tabs
    document.querySelectorAll('.sim-tab-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.sim-tab-btn').forEach(b => {
                b.classList.remove('active', 'text-sky-600', 'border-sky-600');
                b.classList.add('text-slate-600', 'border-transparent');
            });
            btn.classList.add('active', 'text-sky-600', 'border-sky-600');
            btn.classList.remove('text-slate-600', 'border-transparent');

            const tabName = btn.dataset.tab;
            document.querySelectorAll('.sim-tab-content').forEach(tab => tab.classList.add('hidden'));
            document.getElementById(tabName + '-tab').classList.remove('hidden');
        });
    });

    // File input names
    document.getElementById('ktp-file').addEventListener('change', (e) => {
        document.getElementById('ktp-file-name').textContent = e.target.files[0]?.name || '';
    });

    document.getElementById('sim-file').addEventListener('change', (e) => {
        document.getElementById('sim-file-name').textContent = e.target.files[0]?.name || '';
    });

    // Drag & drop
    ['ktp-file', 'sim-file'].forEach(id => {
        const input = document.getElementById(id);
        const parent = input.closest('div').closest('div');

        parent.addEventListener('dragover', (e) => {
            e.preventDefault();
            parent.classList.add('bg-sky-50', 'border-sky-500');
        });

        parent.addEventListener('dragleave', () => {
            parent.classList.remove('bg-sky-50', 'border-sky-500');
        });

        parent.addEventListener('drop', (e) => {
            e.preventDefault();
            input.files = e.dataTransfer.files;
            parent.classList.remove('bg-sky-50', 'border-sky-500');
            input.dispatchEvent(new Event('change'));
        });
    });
</script>
</x-front-layout>
