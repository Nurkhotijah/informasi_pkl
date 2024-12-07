@extends('components.layout-industri')

@section('title', 'Pengajuan Siswa')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-lg sm:text-2xl font-bold mb-2 sm:mb-4 text-center sm:text-left">Kelola Pengajuan</h1>
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4">
                <div class="relative w-full sm:w-auto">
                    <input class="border rounded-l p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama atau Sekolah" type="text" oninput="filterTable()">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <div class="flex items-center w-full sm:w-auto">
                    <label class="mr-2 text-sm sm:text-base" for="school">Pilih Sekolah:</label>
                    <select class="border rounded p-2 w-full sm:w-auto" id="school" onchange="filterBySchool()">
                        <option value="">Pilih Sekolah</option>
                        <option value="smkn_1_ciomas">SMKN 1 Ciomas</option>
                        <option value="smk_komputer_indonesia">SMK Komputer Indonesia</option>
                        <option value="smk_adi_sanggoro">SMK Adi Sanggoro</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border text-sm sm:text-base" id="pengajuanTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                        <th class="py-2 px-4 border-b text-left">Sekolah</th>
                        <th class="py-2 px-4 border-b text-center">Tanggal Pengajuan</th>
                        <th class="py-2 px-4 border-b text-center">Alasan</th>
                        <th class="py-2 px-4 border-b text-center">Keterangan</th>
                        <th class="py-2 px-4 border-b text-center">Status</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Rows -->
                    <tr>
                        <td class="py-2 px-4 border-b text-center">1</td>
                        <td class="py-2 px-4 border-b text-left">Fitri Amaliah</td>
                        <td class="py-2 px-4 border-b text-left">SMKN 1 Ciomas</td>
                        <td class="py-2 px-4 border-b text-center">2023-10-01</td>
                        <td class="py-2 px-4 border-b text-center">Sakit</td>
                        <td class="py-2 px-4 border-b text-center"><a href="#" onclick="viewPhoto(1)">Lihat Foto</a></td>
                        <td class="py-2 px-4 border-b text-center">
                            <span class="inline-block py-1 px-3 text-white bg-green-500 rounded-full">Disetujui</span>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('edit-pengajuan', 1) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <button onclick="deleteRow(this)" class="bg-red-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-600 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </div>
                            </td>
                    </tr>
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

<script>
    function deleteRow(button) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        // Menghapus baris dari tabel
        const row = button.closest('tr');
        row.remove();

        // Update nomor urut jika perlu
        updateRowNumbers();
    }
}

function updateRowNumbers() {
    const rows = document.querySelectorAll("#pengajuanTable tbody tr");
    rows.forEach((row, index) => {
        // Update nomor urut pada kolom pertama
        const numberCell = row.querySelector("td:first-child");
        numberCell.textContent = index + 1;
    });
}

    let currentPage = 1;
    const rowsPerPage = 10;

    // Function to filter the table based on the search and school dropdown
    function filterTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const selectedSchool = document.getElementById('school').value.toLowerCase();
        const rows = document.querySelectorAll('#pengajuanTable tbody tr');

        rows.forEach(row => {
            const nameCell = row.cells[1].textContent.toLowerCase();
            const schoolCell = row.cells[2].textContent.toLowerCase();

            const isSearchMatch = nameCell.includes(searchInput) || schoolCell.includes(searchInput);
            const isSchoolMatch = selectedSchool === '' || schoolCell.includes(selectedSchool);

            if (isSearchMatch && isSchoolMatch) {
                row.style.display = ''; // Show row if it matches the filter
            } else {
                row.style.display = 'none'; // Hide row if it doesn't match the filter
            }
        });

        let currentPage = 1; // Halaman saat ini
        const rowsPerPage = 10; // Jumlah data per halaman

        // Fungsi untuk menampilkan data berdasarkan halaman
        function displayTableData(page) {
            const table = document.getElementById("attendanceTable").getElementsByTagName("tbody")[0];
            const rows = table.getElementsByTagName("tr");

            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = i >= start && i < end ? "" : "none";
            }
            document.getElementById("pageNumber").textContent = `Halaman ${page}`;
        }

        // Paginasi - tombol berikutnya
        function nextPage() {
            const table = document.getElementById("attendanceTable").getElementsByTagName("tbody")[0];
            const rows = table.getElementsByTagName("tr");

            if (currentPage * rowsPerPage < rows.length) {
                currentPage++;
                displayTableData(currentPage);
            }
        }

        // Paginasi - tombol sebelumnya
        function prevPage() {
            if (currentPage > 1) {
                currentPage--;
                displayTableData(currentPage);
            }
        }

        // Inisialisasi tabel untuk halaman pertama
        displayTableData(currentPage);

        function searchTable() {
            const searchValue = document.getElementById("search").value.toLowerCase();
            const rows = document.querySelectorAll("#attendanceTable tbody tr");
            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const school = row.children[2].textContent.toLowerCase();
                if (name.includes(searchValue) || school.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        function populateSchoolDropdown() {
            const rows = document.querySelectorAll("#attendanceTable tbody tr");
            const schoolDropdown = document.getElementById("school");

            const schools = new Set(); // Using a Set to ensure no duplicates

            rows.forEach(row => {
                const school = row.children[2].textContent.trim(); // Get the school name
                schools.add(school); // Add school to the Set (duplicates will be ignored)
            });

            // Clear the dropdown before adding new options
            schoolDropdown.innerHTML = '<option value="">Pilih Sekolah</option>'; 

            // Add the schools to the dropdown
            schools.forEach(school => {
                const option = document.createElement("option");
                option.value = school.toLowerCase().replace(/\s+/g, '_'); // Convert school name to a suitable format for value
                option.textContent = school;
                schoolDropdown.appendChild(option);
            });
        }

        function filterBySchool() {
            const school = document.getElementById("school").value.toLowerCase();
            const rows = document.querySelectorAll("#attendanceTable tbody tr");

            rows.forEach(row => {
                const rowSchool = row.children[2].textContent.toLowerCase().replace(/\s+/g, '_');
                if (school === "" || rowSchool.includes(school)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    // Initialize the dropdown on page load
    document.addEventListener('DOMContentLoaded', () => {
        populateSchoolDropdown();
        updatePagination();  // Initial pagination setup
    });
</script>

@endsection
