@extends('components.layout-user')

@section('title', 'Riwayat Kehadiran')

@section('content')
<!-- Main Content -->
<main class="bg-gray-100 p-8">
    <div class="container mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Riwayat Kehadiran</h1>
        <!-- Tombol Upload Foto Izin -->
        <div class="mt-4 sm:mt-0 mb-4 flex absensis-center space-x-4">
            <form action="{{ route('uploadFotoIzin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="uploadIzin" class="bg-blue-500 text-white text-xs px-6 py-3 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out cursor-pointer flex absensis-center w-auto">
                    <i class="fas fa-upload mr-2"></i> Upload Foto Izin
                </label>
                <input type="file" id="uploadIzin" name="foto_izin" class="hidden" accept="image/jpeg, image/png" required>
                <button type="submit" class="hidden">Submit</button>
            </form>    

            <!-- Tombol Unduh Rekap Kehadiran -->
            <a class="bg-green-500 text-white text-xs px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out flex absensis-center space-x-2 w-auto" 
               href="{{ asset('path/to/certificate.pdf') }}" 
               download="Sertifikat_PKL_{{ Auth::user()->name }}">
                <i class="fas fa-download"></i>
                <span>Rekap Kehadiran</span>
            </a>
        </div>

        <!-- Tabel Riwayat Kehadiran -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-200">
                    <tr class="text-gray-600 text-sm">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">No</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Nama Lengkap</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Tanggal</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Status Kehadiran</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Masuk</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Keluar</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Masuk</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Keluar</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($kehadiran as $absensi)
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">{{ $loop->iteration }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">{{ $absensi->name }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $absensi->status_kehadiran }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($absensi->waktu_masuk)->format('H:i') }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ \Carbon\Carbon::parse($absensi->waktu_keluar)->format('H:i') }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            @if($absensi->foto_masuk)
                            <img class="w-16 h-16 object-cover rounded-full mx-auto" src="{{ asset('storage/foto_kehadiran/' . $absensi->foto_masuk) }}" alt="Foto Masuk">
                            @else
                            Tidak ada foto
                            @endif
                        </td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            @if($absensi->foto_keluar)
                            <img class="w-16 h-16 object-cover rounded-full mx-auto" src="{{ asset('storage/foto_kehadiran/' . $absensi->foto_keluar) }}" alt="Foto Keluar">
                            @else
                            Tidak ada foto
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-end absensis-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman 1</span>
            <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</main>
@endsection
