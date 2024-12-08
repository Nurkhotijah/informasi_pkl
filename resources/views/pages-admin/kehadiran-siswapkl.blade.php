@extends('components.layout-admin')

@section('title', 'Kehadiran Siswa')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-0">Kelola Kehadiran</h1>
        </div>
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
            <div class="relative w-full sm:w-auto">
                <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama" type="text" oninput="searchTable()">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="flex items-center">
              <label class="mr-2" for="date">Pilih Tanggal:</label>
              <input class="border rounded p-2" id="date" type="date" oninput="searchByDate()" />
          </div>
        </div>
        <div class="overflow-x-auto">
            <table id="attendanceTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-200">
                    <tr class="text-gray-600 text-sm">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">No</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Nama Lengkap</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Tanggal</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Masuk</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Keluar</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Masuk</th> <!-- Foto Masuk column -->
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Keluar</th> <!-- Foto Keluar column -->
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Izin</th> <!-- Foto Izin column -->
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Status</th> <!-- Status column moved -->
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($kehadiran as $index => $data)
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">{{ $loop->iteration }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">{{ $data->user->name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $data->waktu_masuk ? \Carbon\Carbon::parse($data->waktu_masuk)->format('H:i:s') : '-' }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $data->waktu_keluar ? \Carbon\Carbon::parse($data->waktu_keluar)->format('H:i:s') : '-' }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            @if ($data->foto_masuk)
                                <img src="{{ asset('storage/' . $data->foto_masuk) }}" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="bukaModal('{{ asset('storage/' . $data->foto_masuk) }}')">
                            @else
                                -
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            @if ($data->foto_keluar)
                                <img src="{{ asset('storage/' . $data->foto_keluar) }}" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="bukaModal('{{ asset('storage/' . $data->foto_keluar) }}')">
                            @else
                                -
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            @if ($data->foto_izin)
                                <img src="{{ asset('storage/' . $data->foto_izin) }}" alt="Foto Izin" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="bukaModal('{{ asset('storage/' . $data->foto_izin) }}')">
                            @else
                                -
                            @endif
                        </td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">{{ $data->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
                              
            </table>
        </div>
        
        <!-- Pagination Section -->
        <div class="flex justify-end items-center mt-4">
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