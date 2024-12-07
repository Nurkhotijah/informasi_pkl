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
                    <!-- Data example for "Hadir" -->
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">1</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">Nur Khotijah</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">2024-10-01</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">08:00</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">16:00</td>
                        <td class="py-2 px-4 border-b text-center">
                            <img src="path/to/check-in.jpg" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('path/to/check-in.jpg')">
                        </td> <!-- Foto Masuk -->
                        <td class="py-2 px-4 border-b text-center">
                            <img src="path/to/check-out.jpg" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('path/to/check-out.jpg')">
                        </td> <!-- Foto Keluar -->
                        <td class="py-2 px-4 border-b text-center">
                            <!-- Foto Izin (empty in this case for "Hadir") -->
                        </td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">Hadir</td> <!-- Status -->
                    </tr>
                    <!-- Data example for "Izin" -->
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">2</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">Fitri Amaliah</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">2024-10-02</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">-</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">-</td>
                        <td class="py-2 px-4 border-b text-center">
                            <img src="https://storage.googleapis.com/a1aa/image/your-uploaded-photo.jpg" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('https://storage.googleapis.com/a1aa/image/your-uploaded-photo.jpg')">
                        </td> <!-- Foto Masuk for Izin -->
                        <td class="py-2 px-4 border-b text-center">
                            <img src="https://storage.googleapis.com/a1aa/image/your-uploaded-photo.jpg" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('https://storage.googleapis.com/a1aa/image/your-uploaded-photo.jpg')">
                        </td> <!-- Foto Keluar for Izin -->
                        <td class="py-2 px-4 border-b text-center">
                            <img src="https://storage.googleapis.com/a1aa/image/your-uploaded-photo.jpg" alt="Foto Izin" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('https://storage.googleapis.com/a1aa/image/your-uploaded-photo.jpg')">
                        </td> <!-- Foto Izin for Izin -->
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">Izin</td> <!-- Status -->
                    </tr>
                    <!-- Data example for "Tidak Hadir" -->
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">3</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">Rahmat Hidayat</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">2024-10-03</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">-</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">-</td>
                        <td class="py-2 px-4 border-b text-center"></td> <!-- Empty for "Tidak Hadir" -->
                        <td class="py-2 px-4 border-b text-center"></td> <!-- Empty for "Tidak Hadir" -->
                        <td class="py-2 px-4 border-b text-center"></td> <!-- Empty for "Tidak Hadir" -->
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">Tidak Hadir</td> <!-- Status -->
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

<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="modal" onclick="closeModal()">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96" onclick="event.stopPropagation();">
        <h2 class="text-xl font-bold mb-4 flex justify-between items-center">
            Absen
            <span class="cursor-pointer text-black" onclick="closeModal()">×</span>
        </h2>
        <div class="flex justify-around">
            <div class="flex flex-col items-center">
                <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkInButton" onclick="showImage('checkIn')">
                    Masuk
                </button>
                <div class="border-b w-16 mt-1"></div>
            </div>
            <div class="flex flex-col items-center">
                <button class="text-black font-semibold px-4 py-2 hover:underline" id="checkOutButton" onclick="showImage('checkOut')">
                    Pulang
                </button>
                <div class="border-b w-16 mt-1"></div>
            </div>
        </div>
        <div class="mt-4" id="checkInImage">
            <img alt="Check In" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="https://storage.googleapis.com/a1aa/image/WztpJ9sAYAbAJtoJTVPK6Dzcc3JdredOr5FsatACWT5Auy0JA.jpg"/>
        </div>
        <div class="hidden mt-4" id="checkOutImage">
            <img alt="Check Out" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="https://storage.googleapis.com/a1aa/image/g3oYLVfAcszXFincakeNQgd7iGD8hUjPaeNQJJXHBXvo6tbnA.jpg"/>
        </div>
    </div>
</div>

<script>
   // Open the modal with dynamic content
function openModal(name, date, checkInTime, checkOutTime, status, checkInImage, checkOutImage) {
    document.getElementById('modal').classList.remove('hidden');
    
    // Set the content dynamically (you can also add name, date, and status if necessary)
    document.getElementById('checkInImage').querySelector('img').src = checkInImage;
    document.getElementById('checkOutImage').querySelector('img').src = checkOutImage;
    showImage('checkIn'); // Display check-in image by default
}

// Close the modal
function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}

// Switch between check-in and check-out images
function showImage(type) {
    if (type === 'checkIn') {
        document.getElementById('checkInImage').classList.remove('hidden');
        document.getElementById('checkOutImage').classList.add('hidden');
    } else if (type === 'checkOut') {
        document.getElementById('checkOutImage').classList.remove('hidden');
        document.getElementById('checkInImage').classList.add('hidden');
    }
}
    // Fungsi untuk menutup modal
function closeModal() {
    const modal = document.getElementById("modal");
    modal.classList.add("hidden"); // Menambahkan kelas 'hidden' untuk menyembunyikan modal
}

 function openModal(name, checkIn, checkOut, status, checkInPhoto = '', checkOutPhoto = '', izinPhoto = '') {
    if (status === "Tidak Hadir") {
        return; // Jangan buka modal jika status "Tidak Hadir"
    }

    const modalTitle = document.getElementById("modalTitle");
    const modalStatus = document.getElementById("modalStatus");
    const modalImage = document.getElementById("modalImage");
    const checkInOutButtons = document.getElementById("checkInOutButtons");

    modalTitle.textContent = `Detail Kehadiran: ${name}`;
    modalStatus.textContent = `Status: ${status}`;
    modalImage.classList.add("hidden");

    if (status === "Hadir") {
        checkInOutButtons.classList.remove("hidden");
        modalImage.src = checkInPhoto;
    } else if (status === "Izin") {
        checkInOutButtons.classList.add("hidden");
        modalImage.classList.remove("hidden");
        modalImage.src = izinPhoto;
    }

    document.getElementById("modal").classList.remove("hidden");
}

  //PAGINATION
  const data = [
        { no: 1, nama: "Nur Khotijah", tanggal: "2024-10-01", status: "Hadir", masuk: "08:00", keluar: "16:00" },
        { no: 2, nama: "Fitri Amaliah", tanggal: "2024-10-02", status: "Izin", masuk: "-", keluar: "-" },
        { no: 3, nama: "Aliyah Fadilah", tanggal: "2024-10-03", status: "Sakit", masuk: "-", keluar: "-" },
        { no: 4, nama: "Ahmad Zaki", tanggal: "2024-10-04", status: "Hadir", masuk: "08:05", keluar: "16:10" },
        { no: 5, nama: "Rizki Fauzan", tanggal: "2024-10-05", status: "Hadir", masuk: "08:10", keluar: "16:15" },
        { no: 6, nama: "Intan Permata", tanggal: "2024-10-06", status: "Izin", masuk: "-", keluar: "-" },
        { no: 7, nama: "Eka Pratama", tanggal: "2024-10-07", status: "Hadir", masuk: "08:00", keluar: "16:00" },
        { no: 8, nama: "Dewi Melati", tanggal: "2024-10-08", status: "Sakit", masuk: "-", keluar: "-" },
        { no: 9, nama: "Hadi Wibowo", tanggal: "2024-10-09", status: "Hadir", masuk: "08:05", keluar: "16:10" },
        { no: 10, nama: "Siti Aminah", tanggal: "2024-10-10", status: "Hadir", masuk: "08:00", keluar: "16:00" },
        { no: 11, nama: "Fajar Nugraha", tanggal: "2024-10-11", status: "Izin", masuk: "-", keluar: "-" },
        { no: 12, nama: "Lila Kurnia", tanggal: "2024-10-12", status: "Hadir", masuk: "08:10", keluar: "16:20" },
        { no: 13, nama: "Beni Ramadhan", tanggal: "2024-10-13", status: "Hadir", masuk: "08:00", keluar: "16:15" },
        // Tambahkan lebih banyak data sesuai kebutuhan
    ];

    let currentPage = 1; // Halaman saat ini
    const rowsPerPage = 10; // Jumlah data per halaman

    function renderTable() {
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        const paginatedData = data.slice(start, end);

        const tableBody = document.querySelector("#attendanceTable tbody");
        tableBody.innerHTML = ""; // Hapus isi tabel sebelumnya

        paginatedData.forEach((item) => {
            const row = `
                <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-700">${item.no}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-800">${item.nama}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-gray-600">${item.tanggal}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">${item.status}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">${item.masuk}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">${item.keluar}</td>
                    <td class="py-4 px-4 border-b border-gray-300 text-center">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                            <i class="fas fa-eye"></i> Lihat
                        </button>
                    </td>
                </tr>
            `;
            tableBody.insertAdjacentHTML("beforeend", row);
        });

        document.getElementById("pageNumber").textContent = `Halaman ${currentPage}`;
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    }

    function nextPage() {
        if (currentPage < Math.ceil(data.length / rowsPerPage)) {
            currentPage++;
            renderTable();
        }
    }
   
document.getElementById('profileButton').onclick = () => {
    document.getElementById('profileDropdown').classList.toggle('hidden');
};

document.addEventListener('click', (event) => {
    if (!document.getElementById('profileButton').contains(event.target) &&
        !document.getElementById('profileDropdown').contains(event.target)) {
        document.getElementById('profileDropdown').classList.add('hidden');
    }
});
function searchTable() {
    const searchValue = document.getElementById("search").value.toLowerCase();
    const rows = document.querySelectorAll("#attendanceTable tbody tr");
    rows.forEach(row => {
        const name = row.children[1].textContent.toLowerCase(); // Kolom Nama
        if (name.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

function searchByDate() {
    const selectedDate = document.getElementById("date").value;
    const rows = document.querySelectorAll("#attendanceTable tbody tr");
    rows.forEach(row => {
        const rowDate = row.children[2].textContent.trim(); // Kolom Tanggal
        if (rowDate === selectedDate || selectedDate === "") {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

</script>
@endsection