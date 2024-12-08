@extends('components.layout-industri')

@section('title', 'Kehadiran Siswa')

@section('content')

<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Kelola Kehadiran</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama atau sekolah" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="flex items-center w-full sm:w-auto sm:ml-auto">
                        <label class="mr-2" for="date">Pilih Tanggal:</label>
                        <input 
                            type="date" 
                            class="border rounded p-2 w-full sm:w-auto" 
                            id="date" 
                            onchange="filterByDate()"
                        />
                    </div>                    
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="attendanceTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                            {{-- <th class="py-2 px-4 border-b text-left">Sekolah</th> --}}
                            <th class="py-2 px-4 border-b text-center">Tanggal</th>
                            <th class="py-2 px-4 border-b text-center">Waktu Masuk</th>
                            <th class="py-2 px-4 border-b text-center">Waktu Keluar</th> 
                            <th class="py-2 px-4 border-b text-center">Foto Masuk</th> 
                            <th class="py-2 px-4 border-b text-center">Foto Keluar</th> 
                            <th class="py-2 px-4 border-b text-center">Foto Izin</th>
                            <th class="py-2 px-4 border-b text-center">Status</th> 
                            <th class="py-2 px-4 border-b text-center">Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kehadiran as $item)
                            <tr>
                                <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->user->name }}</td>
                                {{-- <td class="py-2 px-4 border-b text-left">{{ $item->user->sekolah }}</td> --}}
                                <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i:s') : '-' }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item->waktu_keluar ? \Carbon\Carbon::parse($item->waktu_keluar)->format('H:i:s') : '-' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($item->foto_masuk)
                                    <img src="{{ asset('storage/' . $item->foto_masuk) }}" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('{{ asset('storage/' . $item->foto_masuk) }}')">
                                    @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($item->foto_keluar)
                                    <img src="{{ asset('storage/' . $item->foto_keluar) }}" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('{{ asset('storage/' . $item->foto_keluar) }}')">
                                    @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($item->foto_izin)
                                    <img src="{{ asset('storage/' . $item->foto_izin) }}" alt="Foto Izin" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('{{ asset('storage/' . $item->foto_izin) }}')">
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">{{ $item->status }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('kehadiran.edit', $item->id) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                    </div>
                                </td>
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

    <!-- Modal for showing photo -->
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="modal" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96" onclick="event.stopPropagation();">
            <h2 class="text-xl font-bold mb-4 flex justify-between items-center">
                Foto Absensi
                <span class="cursor-pointer text-black" onclick="closeModal()">×</span>
            </h2>
            <div class="mt-4" id="modalImage">
                <img alt="Foto Absensi" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105"/>
            </div>
        </div>
    </div>

</div>

<script>
// Open the modal and set the content based on the student data
function openModal(imageUrl) {
    const modal = document.getElementById("modal");
    const modalImage = document.getElementById("modalImage").querySelector("img");
    modalImage.src = imageUrl;
    modal.classList.remove("hidden");
}

// Close the modal
function closeModal() {
    const modal = document.getElementById("modal");
    modal.classList.add("hidden");
}

// Pagination Logic
let currentPage = 1;

function nextPage() {
    currentPage++;
    updatePage();
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        updatePage();
    }
}

function updatePage() {
    // You can add logic to update the table contents for the current page
    document.getElementById('pageNumber').textContent = `Halaman ${currentPage}`;
}

// Filter by Date
function filterByDate() {
    // Add filter logic here
    console.log('Filtering by date...');
}

function searchTable() {
    // Add search logic here
    console.log('Searching for students...');
}
</script>

@endsection
