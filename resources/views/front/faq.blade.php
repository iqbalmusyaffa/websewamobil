<x-front-layout>
    <div class="bg-slate-900 pt-32 pb-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-sky-600/10 mix-blend-multiply"></div>
        <div class="absolute -top-1/2 -right-1/4 w-full h-full bg-gradient-to-b from-sky-500/20 to-transparent rounded-full blur-3xl transform rotate-12"></div>
        <div class="absolute bottom-0 w-full h-px bg-gradient-to-r from-transparent via-sky-500/50 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight mb-6">
                Pusat <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-400 to-blue-500">Bantuan (FAQ)</span>
            </h1>
            <p class="mt-4 text-lg md:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Temukan jawaban untuk pertanyaan yang paling sering diajukan pelanggan kami. Kami siap membantu perjalanan Anda.
            </p>
        </div>
    </div>

    <div class="py-16 md:py-24 bg-slate-50 relative" x-data="faqData()">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#0ea5e9 1px, transparent 1px); background-size: 32px 32px;"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Search -->
            <div class="max-w-2xl mx-auto mb-10 transform -translate-y-24">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-sky-400 to-blue-500 rounded-3xl blur opacity-25 group-hover:opacity-40 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-white rounded-2xl shadow-xl flex items-center overflow-hidden">
                        <div class="pl-6 text-sky-500">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input x-model="search" type="text" class="w-full pl-4 pr-6 py-5 outline-none border-transparent focus:border-transparent focus:ring-0 text-slate-700 sm:text-lg placeholder-slate-400 font-medium" placeholder="Ketik kata kunci (contoh: bagasi, bensin, dll)...">
                        <button x-show="search.length > 0" @click="search = ''" class="pr-6 text-slate-400 hover:text-red-500 transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tabs (Responsive Horizontal Scroll on Mobile) -->
            <div class="mb-12 -mt-10">
                <div class="flex overflow-x-auto hide-scrollbar pb-6 gap-3 snap-x px-2 md:justify-center md:flex-wrap">
                    <button @click="activeTab = 'semua'" :class="activeTab === 'semua' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300">Semua Kategori</button>
                    <button @click="activeTab = 'pemesanan'" :class="activeTab === 'pemesanan' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 flex items-center gap-2"><span>🚗</span> Pemesanan</button>
                    <button @click="activeTab = 'pembayaran'" :class="activeTab === 'pembayaran' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 flex items-center gap-2"><span>💳</span> Harga & Bayar</button>
                    <button @click="activeTab = 'dokumen'" :class="activeTab === 'dokumen' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 flex items-center gap-2"><span>📄</span> Syarat</button>
                    <button @click="activeTab = 'berkendara'" :class="activeTab === 'berkendara' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 flex items-center gap-2"><span>🛣️</span> Berkendara</button>
                    <button @click="activeTab = 'layanan'" :class="activeTab === 'layanan' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 flex items-center gap-2"><span>🚐</span> Layanan Khusus</button>
                    <button @click="activeTab = 'kecelakaan'" :class="activeTab === 'kecelakaan' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 flex items-center gap-2"><span>🔧</span> Kendala</button>
                    <button @click="activeTab = 'member'" :class="activeTab === 'member' ? 'bg-sky-600 text-white shadow-lg shadow-sky-500/30 scale-105' : 'bg-white text-slate-600 hover:bg-slate-100 border border-slate-200'" class="snap-center whitespace-nowrap px-6 py-3 rounded-full text-sm font-bold transition-all duration-300 flex items-center gap-2"><span>👑</span> Membership</button>
                </div>
            </div>

            <!-- FAQ List -->
            <div class="space-y-4 max-w-3xl mx-auto">
                <template x-if="filteredFaqs.length === 0">
                    <div class="text-center py-16 bg-white rounded-3xl border border-slate-200 shadow-sm">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-sky-50 text-sky-500 mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Pertanyaan tidak ditemukan</h3>
                        <p class="text-slate-500">Coba gunakan kata kunci lain atau hubungi dukungan kami jika Anda butuh bantuan segera.</p>
                    </div>
                </template>

                <template x-for="faq in filteredFaqs" :key="faq.id">
                    <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-all duration-300 transform" :class="{'ring-2 ring-sky-500 ring-offset-2': activeAccordion === faq.id}">
                        <button @click="activeAccordion = activeAccordion === faq.id ? null : faq.id" class="w-full flex items-start sm:items-center justify-between p-5 sm:p-6 text-left focus:outline-none transition-colors group">
                            <span class="text-base sm:text-lg font-bold text-slate-800 group-hover:text-sky-600 transition-colors pr-4" x-text="faq.q"></span>
                            <div class="shrink-0 mt-1 sm:mt-0 w-8 h-8 rounded-full flex items-center justify-center transition-colors duration-300" :class="activeAccordion === faq.id ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-400 group-hover:bg-sky-100 group-hover:text-sky-600'">
                                <svg class="w-5 h-5 transform transition-transform duration-300" :class="{ 'rotate-180': activeAccordion === faq.id }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </button>
                        <div x-show="activeAccordion === faq.id" x-collapse>
                            <div class="p-5 sm:p-6 pt-0 text-slate-600 text-sm sm:text-base leading-relaxed border-t border-slate-100 bg-slate-50/50">
                                <p x-text="faq.a" class="animate-fade-in-up"></p>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- Contact CTA -->
            <div class="mt-20 relative overflow-hidden rounded-3xl shadow-2xl">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-slate-800 to-sky-900"></div>
                <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
                
                <div class="relative z-10 p-8 md:p-12 text-center flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="text-center md:text-left">
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/20 text-sky-300 text-sm font-semibold mb-4">
                            <span class="relative flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
                            </span>
                            Customer Service 24/7
                        </div>
                        <h3 class="text-3xl font-extrabold text-white mb-3">Masih punya pertanyaan?</h3>
                        <p class="text-slate-300 max-w-lg mx-auto md:mx-0">
                            Jangan ragu untuk menghubungi kami. Tim kami selalu siap sedia membantu menyukseskan perjalanan Anda.
                        </p>
                    </div>
                    <div class="shrink-0 flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                        <a href="https://wa.me/628123456789" target="_blank" class="flex-1 md:flex-none inline-flex justify-center items-center gap-2 px-8 py-4 bg-emerald-500 hover:bg-emerald-400 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-500/30 hover:-translate-y-1">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                            WhatsApp
                        </a>
                        <a href="{{ route('contact') }}" class="flex-1 md:flex-none inline-flex justify-center items-center px-8 py-4 bg-white/10 hover:bg-white/20 text-white border border-white/20 font-bold rounded-xl transition-all hover:-translate-y-1">
                            Email Kami
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- Alpine.js Component Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('faqData', () => ({
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
                    { id: 42, category: 'pemesanan', q: 'Apakah melayani pemesanan mendadak (di hari H)?', a: 'Kami melayani pemesanan di hari yang sama (last-minute booking) tergantung ketersediaan armada. Namun, kami sangat menyarankan untuk memesan sekurang-kurangnya H-1.' },
                    
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
                    { id: 41, category: 'dokumen', q: 'Bolehkah menyewa lepas kunci dengan KTP luar kota atau mahasiswa?', a: 'Sangat bisa! Namun, untuk pengguna KTP luar daerah atau mahasiswa, kami mungkin memerlukan dokumen tambahan untuk verifikasi keamanan, seperti tiket pesawat/kereta pulang-pergi, KTM (Kartu Tanda Mahasiswa), atau ID Card tempat bekerja.' },

                    // SELAMA BERKENDARA
                    { id: 3, category: 'berkendara', q: 'Bagaimana sistem perhitungan waktu sewa harian?', a: 'Perhitungan sewa harian (1 hari) adalah 24 jam penuh. Keterlambatan pengembalian akan dikenakan biaya overtime sebesar 10% dari harga sewa harian per jamnya.' },
                    { id: 20, category: 'berkendara', q: 'Apakah boleh membawa mobil keluar kota/provinsi?', a: 'Boleh, namun mohon diinformasikan rute atau kota tujuan kepada kami saat pemesanan agar dapat dicatat.' },
                    { id: 21, category: 'berkendara', q: 'Apakah saya boleh menggunakan kartu e-toll milik sendiri?', a: 'Tentu. Anda diizinkan menggunakan kartu e-toll pribadi baik untuk sewa lepas kunci maupun dengan sopir. Biaya tol sepenuhnya menjadi tanggung jawab penyewa.' },
                    { id: 22, category: 'berkendara', q: 'Biaya apa saja yang TIDAK termasuk dalam harga sewa?', a: 'Biaya tol, tiket parkir, tiket masuk wisata, penyeberangan (feri), dan uang makan sopir (jika dengan sopir) tidak termasuk dalam harga sewa.' },
                    { id: 23, category: 'berkendara', q: 'Apa yang harus dilakukan jika mogok di jalan?', a: 'Segera pinggirkan kendaraan di tempat aman dan hubungi layanan darurat/CS AutoRent 24 jam. Jangan memperbaiki sendiri atau memanggil bengkel luar tanpa seizin kami.' },
                    { id: 39, category: 'berkendara', q: 'Apakah ada batas maksimal jarak tempuh (mileage limit)?', a: 'Untuk sewa harian lepas kunci, kami memberlakukan batas pemakaian wajar (fair use policy) maksimal 250km/hari. Kelebihan jarak tempuh akan dikenakan charge over-mileage. Untuk sewa dengan sopir, tidak ada batas kilometer selama masih di dalam zona rute harian yang disepakati.' },
                    { id: 40, category: 'berkendara', q: 'Apakah diperbolehkan merokok di dalam mobil?', a: 'Demi kenyamanan bersama, kami memberlakukan kebijakan BEBAS ASAP ROKOK (No Smoking) di dalam seluruh armada kami. Pelanggaran terhadap aturan ini akan dikenakan denda biaya salon mobil (cleaning fee) sebesar Rp 500.000.' },
                    { id: 43, category: 'berkendara', q: 'Apakah diperbolehkan membawa hewan peliharaan (pets)?', a: 'Membawa hewan peliharaan umumnya tidak diperbolehkan untuk menjaga kebersihan kabin dan mencegah alergi penumpang lain. Jika sangat mendesak, mohon komunikasikan dengan CS kami terlebih dahulu, mungkin ada syarat khusus penggunaan pet carrier/diaper dan potensi biaya pembersihan.' },

                    // KECELAKAAN & KERUSAKAN
                    { id: 4, category: 'kecelakaan', q: 'Apakah mobil dilindungi asuransi?', a: 'Tentu. Seluruh armada kami dilindungi oleh Asuransi All-Risk. Jika terjadi kerusakan, penyewa dikenakan biaya klaim asuransi (Own Risk) sebesar Rp 300.000 per kejadian.' },
                    { id: 24, category: 'kecelakaan', q: 'Apa yang harus dilakukan jika terjadi kecelakaan?', a: 'Pastikan keselamatan Anda terlebih dahulu. Jangan pindahkan mobil, lapor polisi untuk buat BAP darurat, ambil foto, lalu hubungi tim AutoRent.' },
                    { id: 26, category: 'kecelakaan', q: 'Kerusakan apa saja yang tidak ditanggung asuransi?', a: 'Kerusakan akibat kesengajaan, mabuk saat mengemudi, melanggar rambu lalu lintas secara fatal, balapan liar, dan kerusakan ban yang tidak diikuti kerusakan body kendaraan.' },

                    // LAYANAN SHUTTLE & TRANSFER
                    { id: 29, category: 'layanan', q: 'Apa perbedaan layanan Antar Jemput Bandara dengan Travel Shuttle?', a: 'Antar Jemput Bandara adalah layanan private khusus untuk Anda dari/ke bandara dengan waktu yang menyesuaikan jadwal terbang Anda. Sedangkan Travel Shuttle adalah layanan transportasi antar wilayah/kota yang bisa bersifat reguler (jadwal tetap & shared) atau private drop-off.' },
                    { id: 30, category: 'layanan', q: 'Apakah harga layanan Shuttle & Antar Jemput Bandara sudah all-in?', a: 'Ya, seluruh tarif layanan Shuttle dan Airport Transfer kami bersifat flat dan sudah all-in, mencakup biaya bahan bakar (bensin), tol, parkir, dan jasa sopir profesional.' },
                    { id: 31, category: 'layanan', q: 'Bagaimana jika pesawat saya mengalami delay (keterlambatan)?', a: 'Untuk penjemputan bandara, sopir kami akan memantau jadwal penerbangan Anda. Kami memberikan toleransi waktu tunggu secara gratis untuk keterlambatan pesawat.' },
                    { id: 32, category: 'layanan', q: 'Bagaimana jika saya terlambat untuk jadwal Travel Shuttle?', a: 'Untuk Travel Shuttle reguler (shared), tiket bisa hangus jika Anda terlambat dari jadwal keberangkatan. Untuk Private Shuttle, jadwal bisa sedikit lebih fleksibel jika Anda menginformasikan sebelumnya.' },
                    { id: 33, category: 'layanan', q: 'Bagaimana jika perjalanan atau penerbangan dibatalkan mendadak?', a: 'Jika batal, mohon informasikan secepatnya (minimal 6-12 jam sebelumnya). Anda dapat menjadwalkan ulang (reschedule) tanpa biaya tambahan, atau membatalkan sesuai kebijakan refund kami.' },
                    { id: 34, category: 'layanan', q: 'Bagaimana saya akan bertemu dengan sopir?', a: 'Untuk di bandara, sopir menunggu di area kedatangan dengan membawa papan nama. Untuk Travel Shuttle, keberangkatan dilakukan di titik kumpul (Pool) atau penjemputan langsung di alamat Anda (sistem Door-to-door).' },
                    { id: 35, category: 'layanan', q: 'Apakah layanan penjemputan bandara & shuttle beroperasi 24 jam?', a: 'Ya, layanan kami tersedia 24 jam. Khusus untuk penjemputan larut malam atau dini hari, kami sangat menyarankan Anda untuk memesan setidaknya 12-24 jam sebelumnya.' },
                    { id: 36, category: 'layanan', q: 'Berapa banyak bagasi yang bisa saya bawa?', a: 'Pada Airport Transfer / Private Shuttle, kapasitas menyesuaikan tipe mobil. Untuk Shared Travel Shuttle reguler, umumnya dibatasi 1 koper dan 1 tas kabin. Namun, khusus untuk Travel Shuttle armada Hiace, Medium Bus, dan Big Bus, setiap penumpang diperbolehkan membawa maksimal 2 koper atau 2 tas ukuran sedang.' },
                    { id: 37, category: 'layanan', q: 'Apakah bisa mampir ke lokasi lain (multi-stop)?', a: 'Layanan Shuttle/Airport Transfer adalah perjalanan langsung (point-to-point). Jika ingin mampir ke lokasi lain, akan dikenakan biaya tambahan (extra stop) atau Anda disarankan menggunakan layanan sewa mobil harian.' },
                    { id: 38, category: 'layanan', q: 'Apakah layanan ini tersedia untuk rombongan besar?', a: 'Tentu. Selain MPV dan Minibus, kami juga menyediakan layanan Shuttle menggunakan armada Medium Bus dan Big Bus yang ideal untuk membawa rombongan besar.' },
                    { id: 44, category: 'layanan', q: 'Apa saja fasilitas yang didapatkan pada Travel Shuttle Antar Kota?', a: 'Untuk Travel Shuttle rute reguler antarkota, armada kami dilengkapi AC sentral, kursi reclining, musik, dan gratis 1x air mineral botol. Untuk rute jauh, kami juga menjadwalkan 1x pemberhentian di rest area untuk peregangan/makan.' },

                    // MEMBERSHIP & REWARD
                    { id: 45, category: 'member', q: 'Apakah AutoRent memiliki Program Kartu Member?', a: 'Ya, tentu saja! Kami menyediakan program Kartu Member Eksklusif yang dapat dinikmati oleh seluruh pelanggan kami untuk meningkatkan pengalaman penyewaan Anda ke level VIP.' },
                    { id: 46, category: 'member', q: 'Apakah Kartu Member ini berlaku untuk semua layanan?', a: 'Betul sekali! Kartu Member Anda terintegrasi secara penuh dan berlaku untuk SEMUA layanan serta fitur kami. Mulai dari Sewa Mobil Lepas Kunci, Sewa dengan Sopir, Travel Shuttle Antarkota, hingga Antar Jemput Bandara.' },
                    { id: 47, category: 'member', q: 'Apa saja keuntungan dari program Kartu Member?', a: 'Keuntungannya sangat banyak: Diskon spesial di setiap transaksi, pengumpulan Poin Reward yang bisa ditukar dengan potongan harga atau sewa gratis, prioritas ketersediaan armada di musim liburan (High Season), hingga fasilitas gratis upgrade tipe mobil (syarat & ketentuan berlaku).' },
                    { id: 48, category: 'member', q: 'Bagaimana cara mendaftar untuk mendapatkan Kartu Member?', a: 'Anda dapat melakukan pendaftaran dengan mudah melalui website/aplikasi kami, atau menghubungi langsung Customer Service. Setelah mendaftar, Kartu Member digital Anda akan langsung aktif dan terhubung dengan akun Anda.' },

                    // LAIN-LAIN
                    { id: 27, category: 'lainnya', q: 'Bagaimana cara memberikan ulasan/rating?', a: 'Setelah masa sewa berakhir dan pesanan berstatus Selesai, Anda bisa masuk ke menu Pesanan Saya dan klik tombol Beri Ulasan.' }
                ],
                get filteredFaqs() {
                    return this.faqs.filter(faq => {
                        const matchesSearch = faq.q.toLowerCase().includes(this.search.toLowerCase()) || faq.a.toLowerCase().includes(this.search.toLowerCase());
                        const matchesTab = this.activeTab === 'semua' || faq.category === this.activeTab;
                        return matchesSearch && matchesTab;
                    });
                }
            }));
        });
    </script>
    
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .hide-scrollbar {
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.3s ease-out forwards;
        }
    </style>
</x-front-layout>
