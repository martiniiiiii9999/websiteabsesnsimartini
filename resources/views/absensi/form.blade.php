<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Form Absensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if ($errors->any())
                        <div class="mb-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 px-4 py-3 rounded-lg flex items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                            <div>
                                <strong class="font-bold block">Terjadi Kesalahan!</strong>
                                <ul class="list-disc list-inside text-sm mt-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('absensi.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div>
                                <x-input-label for="nama" :value="__('Nama Lengkap')" />
                                <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" :value="old('nama')" required autofocus placeholder="Masukkan nama lengkap" />
                            </div>

                            <!-- NIP/NIM -->
                            <div>
                                <x-input-label for="nip" :value="__('NIP / NIM (Opsional)')" />
                                <x-text-input id="nip" class="block mt-1 w-full" type="text" name="nip" :value="old('nip')" placeholder="Masukkan NIP atau NIM" />
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <x-input-label for="tanggal" :value="__('Tanggal')" />
                                <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal" :value="old('tanggal', date('Y-m-d'))" required />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Status Kehadiran')" />
                                <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="hadir" {{ old('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="izin" {{ old('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="sakit" {{ old('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="alfa" {{ old('status') == 'alfa' ? 'selected' : '' }}>Alfa</option>
                                </select>
                            </div>

                            <!-- Waktu Masuk -->
                            <div>
                                <x-input-label for="waktu_masuk" :value="__('Waktu Masuk')" />
                                <x-text-input id="waktu_masuk" class="block mt-1 w-full" type="time" name="waktu_masuk" :value="old('waktu_masuk')" />
                            </div>

                            <!-- Waktu Keluar -->
                            <div>
                                <x-input-label for="waktu_keluar" :value="__('Waktu Keluar')" />
                                <x-text-input id="waktu_keluar" class="block mt-1 w-full" type="time" name="waktu_keluar" :value="old('waktu_keluar')" />
                            </div>

                            <!-- Keterangan -->
                            <div class="md:col-span-2">
                                <x-input-label for="keterangan" :value="__('Keterangan (Opsional)')" />
                                <textarea id="keterangan" name="keterangan" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Tambahkan keterangan jika perlu">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-primary-button class="ml-3">
                                {{ __('Simpan Absensi') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-fill Waktu Masuk if status is 'hadir' and empty
        document.getElementById('status').addEventListener('change', function() {
            if (this.value === 'hadir') {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const timeString = `${hours}:${minutes}`;
                
                const waktuMasuk = document.getElementById('waktu_masuk');
                if (!waktuMasuk.value) {
                    waktuMasuk.value = timeString;
                }
            }
        });
    </script>
</x-app-layout>
