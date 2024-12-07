@extends('components.layout-industri')

@section('title', 'Jurnal Siswa')

@section('content')
  
<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Laporan Siswa</h1>
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative w-full sm:w-auto">
                    <input class="border rounded-l p-2 pl-10 w-full sm:w-64" id="search" name="search" placeholder="Cari Nama atau sekolah" type="text" value="{{ request()->search }}" oninput="this.form.submit()">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border" id="pengajuanTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                        <th class="py-2 px-4 border-b text-left">Sekolah</th>
                        <th class="py-2 px-4 border-b text-center">Laporan PKL</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurnal as $item)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $item->name }}</td> <!-- Menampilkan Nama Siswa -->
                        <td class="py-2 px-4 border-b text-left">{{ $item->profile->sekolah->nama }}</td> <!-- Menampilkan Nama Sekolah -->
                        <td class="py-2 px-4 border-b text-center">
                            <button onclick="openLaporanModal('awdwd')"
                                    class="bg-green-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out">
                                <i class="fas fa-file-pdf mr-1"></i> Unduh
                            </button>
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('jurnal-industri.detail', $item->id) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out" onclick="showActivityImage('assets/coding.png')">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>

        <!-- Pagination Section -->
        {{-- <div class="flex justify-end items-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman {{ $jurnal->currentPage() }}</span>
            {{ $jurnal->links() }}
        </div> --}}
    </div>
</main>
@endsection
