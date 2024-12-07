@extends('components.layout-admin')

@section('title', 'Jurnal Siswa')

@section('content')
<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Jurnal Siswa</h1>
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative w-full sm:w-auto">
                    <input class="border rounded-l p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama atau Sekolah" type="text" oninput="filterTable()">
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
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh data statis -->
                    @foreach ($siswa as $item)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->name }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('jurnal-admin.detail', $item->id) }}" 
                                    class="bg-blue-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
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

<!-- Modal untuk menampilkan laporan PKL -->
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="modal-laporan" onclick="closeLaporanModal()">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full sm:w-3/4 lg:w-1/2" onclick="event.stopPropagation();">
        <h2 class="text-xl font-bold mb-4 flex justify-between items-center">
            Laporan PKL Siswa
            <span class="cursor-pointer text-black" onclick="closeLaporanModal()">×</span>
        </h2>
        <iframe id="laporanContent" src="" class="w-full h-96 rounded-lg border"></iframe>
    </div>
</div>

<script>
    function openLaporanModal(fileUrl) {
        const modal = document.getElementById('modal-laporan');
        const iframe = document.getElementById('laporanContent');
        iframe.src = fileUrl;
        modal.classList.remove('hidden');
    }

    function closeLaporanModal() {
        const modal = document.getElementById('modal-laporan');
        const iframe = document.getElementById('laporanContent');
        iframe.src = ""; // Reset iframe untuk menghindari masalah caching
        modal.classList.add('hidden');
    }

    function filterTable() {
        let searchValue = document.getElementById('search').value.toLowerCase();
        let rows = document.querySelectorAll('#pengajuanTable tbody tr');
        rows.forEach(row => {
            let cells = row.querySelectorAll('td');
            let name = cells[1].textContent.toLowerCase();
            if (name.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Pagination functions (placeholder)
    let currentPage = 1;
    const rowsPerPage = 5;
    const totalRows = document.querySelectorAll('#pengajuanTable tbody tr').length;

    function updateTable() {
        const rows = document.querySelectorAll('#pengajuanTable tbody tr');
        rows.forEach((row, index) => {
            if (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('pageNumber').textContent = `Halaman ${currentPage}`;
    }

    function nextPage() {
        if (currentPage * rowsPerPage < totalRows) {
            currentPage++;
            updateTable();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    }

    updateTable();
</script>
@endsection
