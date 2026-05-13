<x-front-layout>
    <div class="bg-slate-900 py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="absolute -top-1/2 -right-1/4 w-full h-full bg-gradient-to-b from-sky-500/20 to-transparent rounded-full blur-3xl transform rotate-12"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl font-extrabold text-white sm:text-5xl tracking-tight">
                Pusat Bantuan (FAQ)
            </h1>
            <p class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto">
                Temukan jawaban untuk pertanyaan yang paling sering diajukan oleh pelanggan kami.
            </p>
        </div>
    </div>

    <div class="py-16 bg-slate-50" x-data="{
        search: '',
        activeTab: 'semua',
        activeAccordion: null,
        faqs: [
            // PEMESANAN
            { id: 1, category: 'pemesanan', q: 'Apa saja syarat menyewa mobil di AutoRent?', a: 'Untuk sewa lepas kunci, kami membutuhkan KTP asli, SIM A aktif, dan satu dokumen pendukung (Kartu Keluarga/ID Card Perusahaan). Untuk sewa dengan sopir, Anda cukup melampirkan foto KTP atau Paspor.' },
            { id: 5, category: 'pemesanan', q: 'Berapa jauh hari sebelumnya saya harus memesan?', a: 'Disarankan memesan minimal 3-7 hari sebelum tanggal penggunaan, terutama untuk akhir pekan atau musim liburan, guna memastikan ketersediaan armada.' },
            { id: 6, category: 'pemesanan', q: 'Apakah bisa ubah tanggal sewa setelah booking?', a: 'Bisa, maksimal perubahan (reschedule) dilakukan 48 jam sebelum jadwal awal. Perubahan tergantung pada ketersediaan armada di tanggal yang baru.' },
            { id: 7, category: 'pemesanan', q: 'Bagaimana cara membatalkan pesanan?', a: 'Anda dapat membatalkan pesanan melalui menu Pesanan Saya di dashboard akun Anda atau dengan menghubungi CS kami. Harap perhatikan kebijakan pembatalan terkait pengembalian DP.' },
            { id: 8, category: 'pemesanan', q: 'Apakah bisa pesan untuk orang lain?', a: 'Bisa, namun data identitas penyewa dan pengemudi utama yang terdaftar harus diserahkan saat serah terima kendaraan.' },
            { id: 9, category: 'pemesanan', q: 'Apakah ada minimum hari sewa?', a: 'Minimum sewa adalah 1 hari (24 jam untuk lepas kunci, atau 12 jam untuk dengan sopir).' },
            { id: 10, category: 'pemesanan', q: 'Mobil bisa diantarkan ke alamat saya?', a: 'Ya, kami melayani antar-jemput kendaraan ke bandara, hotel, atau alamat rumah dalam area jangkauan kami (mungkin dikenakan biaya tambahan).' },
            
            // HARGA & PEMBAYARAN
            { id: 2, category: 'pembayaran', q: 'Apakah harga sewa sudah termasuk bahan bakar?', a: 'Harga dasar sewa mobil belum termasuk bahan bakar, biaya tol, dan parkir. Mobil akan diserahkan dengan bahan bakar penuh (Full Tank) dan harap dikembalikan dalam kondisi penuh juga.' },
            { id: 11, category: 'pembayaran', q: 'Berapa besarnya uang muka (DP)?', a: 'Uang muka (DP) biasanya bervariasi tergantung tipe mobil dan durasi sewa, umumnya mulai dari 20% hingga 50% dari total biaya sewa.' },
            { id: 12, category: 'pembayaran', q: 'Apa saja metode pembayaran yang diterima?', a: 'Kami menerima pembayaran non-tunai via Midtrans (Transfer Bank, QRIS, E-Wallet, Kartu Kredit), serta pembayaran Tunai (Cash) yang bisa diserahkan langsung di kantor kami atau dititipkan melalui driver/sopir saat penyerahan kendaraan.' },
            { id: 13, category: 'pembayaran', q: 'Apakah DP bisa dikembalikan jika saya batal?', a: 'DP hangus jika pembatalan dilakukan kurang dari 24 jam atau pada hari H. Pembatalan sebelumnya bisa mendapatkan refund sesuai syarat dan ketentuan.' },
            { id: 14, category: 'pembayaran', q: 'Kapan sisa pembayaran harus dilunasi?', a: 'Sisa pembayaran (pelunasan) wajib dibayarkan paling lambat saat serah terima kendaraan, baik secara non-tunai maupun bayar tunai (cash) ke driver atau kantor.' },
            { id: 15, category: 'pembayaran', q: 'Apakah ada deposit/jaminan selain DP?', a: 'Untuk lepas kunci, kami tidak menahan dana deposit uang, namun kami menahan dokumen fisik pendukung (seperti kendaraan motor, STNK motor, atau dokumen lain yang disepakati).' },
            { id: 16, category: 'pembayaran', q: 'Apakah ada promo atau diskon untuk sewa jangka panjang?', a: 'Ya! Kami memberikan harga spesial untuk sewa mingguan atau bulanan. Hubungi admin kami untuk penawaran terbaik.' },

            // DOKUMEN & SYARAT
            { id: 17, category: 'dokumen', q: 'SIM apa yang diperlukan untuk sewa lepas kunci?', a: 'Penyewa diwajibkan memiliki Surat Izin Mengemudi (SIM A) yang masih berlaku untuk mengemudikan mobil pribadi di Indonesia.' },
            { id: 18, category: 'dokumen', q: 'Apakah WNA (Warga Negara Asing) bisa menyewa?', a: 'Bisa, WNA wajib melampirkan Paspor asli, KITAS (jika ada), dan SIM Internasional yang valid di Indonesia.' },
            { id: 19, category: 'dokumen', q: 'Bolehkah orang lain mengemudikan mobil sewaan?', a: 'Boleh, selama pengemudi cadangan juga memiliki SIM A yang valid dan datanya dilaporkan kepada kami saat pemesanan.' },

            // SELAMA BERKENDARA
            { id: 3, category: 'berkendara', q: 'Bagaimana sistem perhitungan waktu sewa harian?', a: 'Perhitungan sewa harian (1 hari) adalah 24 jam penuh. Keterlambatan pengembalian akan dikenakan biaya overtime sebesar 10% dari harga sewa harian per jamnya.' },
            { id: 20, category: 'berkendara', q: 'Apakah boleh membawa mobil keluar kota/provinsi?', a: 'Boleh, namun mohon diinformasikan rute atau kota tujuan kepada kami saat pemesanan agar dapat dicatat.' },
            { id: 21, category: 'berkendara', q: 'Apakah saya boleh menggunakan kartu e-toll milik sendiri?', a: 'Tentu. Anda diizinkan menggunakan kartu e-toll pribadi baik untuk sewa lepas kunci maupun dengan sopir. Biaya tol sepenuhnya menjadi tanggung jawab penyewa.' },
            { id: 22, category: 'berkendara', q: 'Biaya apa saja yang TIDAK termasuk dalam harga sewa?', a: 'Biaya tol, tiket parkir, tiket masuk wisata, penyeberangan (feri), dan uang makan sopir (jika dengan sopir) tidak termasuk dalam harga sewa.' },
            { id: 23, category: 'berkendara', q: 'Apa yang harus dilakukan jika mogok di jalan?', a: 'Segera pinggirkan kendaraan di tempat aman dan hubungi layanan darurat/CS AutoRent 24 jam. Jangan memperbaiki sendiri atau memanggil bengkel luar tanpa seizin kami.' },

            // KECELAKAAN & KERUSAKAN
            { id: 4, category: 'kecelakaan', q: 'Apakah mobil dilindungi asuransi?', a: 'Tentu. Seluruh armada kami dilindungi oleh Asuransi All-Risk. Jika terjadi kerusakan, penyewa dikenakan biaya klaim asuransi (Own Risk) sebesar Rp 300.000 per kejadian.' },
            { id: 24, category: 'kecelakaan', q: 'Apa yang harus dilakukan jika terjadi kecelakaan?', a: 'Pastikan keselamatan Anda terlebih dahulu. Jangan pindahkan mobil, lapor polisi untuk buat BAP darurat, ambil foto, lalu hubungi tim AutoRent.' },
            { id: 26, category: 'kecelakaan', q: 'Kerusakan apa saja yang tidak ditanggung asuransi?', a: 'Kerusakan akibat kesengajaan, mabuk saat mengemudi, melanggar rambu lalu lintas secara fatal, balapan liar, dan kerusakan ban yang tidak diikuti kerusakan body kendaraan.' },

            // LAIN-LAIN
            { id: 27, category: 'lainnya', q: 'Bagaimana cara memberikan ulasan/rating?', a: 'Setelah masa sewa berakhir dan pesanan berstatus Selesai, Anda bisa masuk ke menu Pesanan Saya dan klik tombol Beri Ulasan.' },
            { id: 28, category: 'lainnya', q: 'Apakah ada program loyalitas atau poin reward?', a: 'Saat ini belum ada sistem poin reward otomatis, namun pelanggan setia yang sering menyewa seringkali kami berikan upgrade gratis atau potongan harga langsung.' }
        ],
        get filteredFaqs() {
            return this.faqs.filter(faq => {
                const matchesSearch = faq.q.toLowerCase().includes(this.search.toLowerCase()) || faq.a.toLowerCase().includes(this.search.toLowerCase());
                const matchesTab = this.activeTab === 'semua' || faq.category === this.activeTab;
                return matchesSearch && matchesTab;
            });
        }
    }">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Search & Filters -->
            <div class="mb-12">
                <div class="max-w-2xl mx-auto mb-8 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input x-model="search" type="text" class="block w-full pl-12 pr-4 py-4 rounded-2xl border-slate-200 shadow-sm focus:ring-sky-500 focus:border-sky-500 sm:text-md text-slate-700 bg-white" placeholder="Cari pertanyaan Anda di sini...">
                </div>

                <!-- Tabs -->
                <div class="flex flex-wrap justify-center gap-2">
                    <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all">Semua</button>
                    <button @click="activeTab = 'pemesanan'" :class="activeTab === 'pemesanan' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all flex items-center gap-2"><span>🚗</span> Pemesanan</button>
                    <button @click="activeTab = 'pembayaran'" :class="activeTab === 'pembayaran' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all flex items-center gap-2"><span>💰</span> Harga & Bayar</button>
                    <button @click="activeTab = 'dokumen'" :class="activeTab === 'dokumen' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all flex items-center gap-2"><span>📄</span> Syarat</button>
                    <button @click="activeTab = 'berkendara'" :class="activeTab === 'berkendara' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all flex items-center gap-2"><span>🛣️</span> Berkendara</button>
                    <button @click="activeTab = 'kecelakaan'" :class="activeTab === 'kecelakaan' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all flex items-center gap-2"><span>🔧</span> Kendala</button>
                    <button @click="activeTab = 'lainnya'" :class="activeTab === 'lainnya' ? 'bg-sky-600 text-white shadow-md' : 'bg-white text-slate-600 hover:bg-sky-50 border border-slate-200'" class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all flex items-center gap-2"><span>⭐</span> Lainnya</button>
                </div>
            </div>

            <!-- FAQ List -->
            <div class="space-y-4 max-w-3xl mx-auto">
                <template x-if="filteredFaqs.length === 0">
                    <div class="text-center py-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 text-slate-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1">Pertanyaan tidak ditemukan</h3>
                        <p class="text-slate-500">Coba gunakan kata kunci lain atau hubungi dukungan kami.</p>
                    </div>
                </template>

                <template x-for="faq in filteredFaqs" :key="faq.id">
                    <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:border-sky-200 transition-colors">
                        <button @click="activeAccordion = activeAccordion === faq.id ? null : faq.id" class="w-full flex items-start sm:items-center justify-between p-5 sm:p-6 text-left focus:outline-none hover:bg-slate-50 transition-colors group">
                            <span class="text-base sm:text-lg font-bold text-slate-900 group-hover:text-sky-600 transition-colors pr-4" x-text="faq.q"></span>
                            <div class="shrink-0 mt-1 sm:mt-0 w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 group-hover:bg-sky-100 group-hover:text-sky-600 transition-colors">
                                <svg class="w-5 h-5 transform transition-transform duration-300" :class="{ 'rotate-180': activeAccordion === faq.id }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div x-show="activeAccordion === faq.id" x-collapse>
                            <div class="p-5 sm:p-6 pt-0 text-slate-600 text-sm sm:text-base leading-relaxed border-t border-slate-100 bg-slate-50" x-text="faq.a">
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Contact CTA -->
            <div class="mt-16 text-center p-8 bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl border border-slate-800 shadow-xl max-w-3xl mx-auto relative overflow-hidden">
                <div class="absolute inset-0 bg-white opacity-5" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white mb-6 shadow-inner border border-white/20">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Masih punya pertanyaan lain?</h3>
                    <p class="text-slate-300 mb-8 max-w-md">Tim dukungan kami siap membantu Anda 24/7. Hubungi kami melalui WhatsApp atau Email untuk bantuan lebih lanjut.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-8 py-4 bg-sky-500 hover:bg-sky-400 text-white font-bold rounded-xl transition-all shadow-lg shadow-sky-500/30 hover:-translate-y-1">
                        Hubungi Kami Sekarang
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</x-front-layout>
