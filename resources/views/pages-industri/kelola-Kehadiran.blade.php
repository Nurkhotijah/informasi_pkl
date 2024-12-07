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
                            <th class="py-2 px-4 border-b text-left">Sekolah</th>
                            <th class="py-2 px-4 border-b text-center">Tanggal</th>
                            <th class="py-2 px-4 border-b text-center">Waktu Masuk</th>
                            <th class="py-2 px-4 border-b text-center">Foto Masuk</th> 
                            <th class="py-2 px-4 border-b text-center">Foto Keluar</th>
                            <th class="py-2 px-4 border-b text-center">Waktu Keluar</th> 
                            <th class="py-2 px-4 border-b text-center">Status Kehadiran</th> 
                            <th class="py-2 px-4 border-b text-center">Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">1</td>
                            <td class="py-2 px-4 border-b text-left">Fitri Amaliah</td>
                            <td class="py-2 px-4 border-b text-left">SMKN 1 Ciomas</td>
                            <td class="py-2 px-4 border-b text-center">2023-10-01</td>
                            <td class="py-2 px-4 border-b text-center">08:00</td>
                            <td class="py-2 px-4 border-b text-center">
                                <img src="https://storage.googleapis.com/a1aa/image/masuk.jpg" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('https://storage.googleapis.com/a1aa/image/masuk.jpg')">
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <img src="https://storage.googleapis.com/a1aa/image/keluar.jpg" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('https://storage.googleapis.com/a1aa/image/keluar.jpg')">
                            </td>
                            <td class="py-2 px-4 border-b text-center">17:00</td>
                            <td class="py-2 px-4 border-b text-center">Hadir</td> 
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('edit-kehadiran', 1) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">2</td>
                            <td class="py-2 px-4 border-b text-left">Marsya</td>
                            <td class="py-2 px-4 border-b text-left">SMK Komputer Indonesia</td>
                            <td class="py-2 px-4 border-b text-center">2023-10-02</td>
                            <td class="py-2 px-4 border-b text-center">08:30</td>
                            <td class="py-2 px-4 border-b text-center">
                                <img src="https://storage.googleapis.com/a1aa/image/masuk2.jpg" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('https://storage.googleapis.com/a1aa/image/masuk2.jpg')">
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <img src="https://storage.googleapis.com/a1aa/image/keluar2.jpg" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-md cursor-pointer" onclick="openModal('https://storage.googleapis.com/a1aa/image/keluar2.jpg')">
                            </td>
                            <td class="py-2 px-4 border-b text-center">17:30</td>
                            <td class="py-2 px-4 border-b text-center">Izin</td> 
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <button class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out" onclick="editStatus('2')">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            
            {{-- <!-- Modal for showing photo -->
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
                        <img alt="Check Out" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" height="300" src="https://storage.googleapis.com/a1aa/image/g3oYLVfAcszXFincakeNQgd7iGD8hUjPaeNQJJXHBXvo6tbnA.jpg" width="300"/>
                    </div>
                </div>
            </div> --}}
            
           
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
        // Open the modal and set the content based on the student data
function openModal(name, checkInTime, checkOutTime, status, checkInImage, checkOutImage) {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('checkInImage').querySelector('img').src = checkInImage;
    document.getElementById('checkOutImage').querySelector('img').src = checkOutImage;
    showImage('checkIn'); // default to "Masuk" image first
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

          function openModal(imageUrl) {
                    const modal = document.getElementById("modal");
                    const checkInImage = document.getElementById("checkInImage");
                    const checkOutImage = document.getElementById("checkOutImage");
                    checkInImage.classList.add("hidden");
                    checkOutImage.classList.add("hidden");
            
                    // Show the clicked image in the modal
                    const img = document.createElement("img");
                   
                    img.classList.add("w-full", "h-auto", "rounded-lg", "shadow-md", "transition-transform", "transform", "hover:scale-105");
            
                    checkInImage.appendChild(img);
                    modal.classList.remove("hidden");
                }
            
                function closeModal() {
                    const modal = document.getElementById("modal");
                    modal.classList.add("hidden");
                }
        function viewPhoto(id, type) {
        const photoContainer = document.getElementById('photoContainer');
        if (type === 'checkIn') {
            photoContainer.innerHTML = `<img src="path/to/check-in-photo-${id}.jpg" alt="Foto Masuk" class="w-full h-auto">`;
        } else {
            photoContainer.innerHTML = `<img src="path/to/check-out-photo-${id}.jpg" alt="Foto Keluar" class="w-full h-auto">`;
        }
        document.getElementById('modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }
        function viewPhoto(id) {
            // Show modal
            document.getElementById('modal').classList.remove('hidden');
            
            // Dynamically change the images based on the ID (you can replace these URLs with dynamic ones)
            if (id == '1') {
                document.getElementById('checkInImage').innerHTML = `<img alt="Check In" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="https://storage.googleapis.com/a1aa/image/WztpJ9sAYAbAJtoJTVPK6Dzcc3JdredOr5FsatACWT5Auy0JA.jpg"/>`;
                document.getElementById('checkOutImage').innerHTML = `<img alt="Check Out" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" height="300" src="https://storage.googleapis.com/a1aa/image/g3oYLVfAcszXFincakeNQgd7iGD8hUjPaeNQJJXHBXvo6tbnA.jpg" width="300"/>`;
            } else if (id == '2') {
                document.getElementById('checkInImage').innerHTML = `<img alt="Check In" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" src="https://storage.googleapis.com/a1aa/image/sample-check-in-2.jpg"/>`;
                document.getElementById('checkOutImage').innerHTML = `<img alt="Check Out" class="w-full h-auto rounded-lg shadow-md transition-transform transform hover:scale-105" height="300" src="https://storage.googleapis.com/a1aa/image/sample-check-out-2.jpg" width="300"/>`;
            }
        }

        function showImage(type) {
            if (type === 'checkIn') {
                // Menampilkan gambar Masuk dan menyembunyikan gambar Pulang
                document.getElementById('checkInImage').classList.remove('hidden');
                document.getElementById('checkOutImage').classList.add('hidden');
            } else if (type === 'checkOut') {
                // Menampilkan gambar Pulang dan menyembunyikan gambar Masuk
                document.getElementById('checkInImage').classList.add('hidden');
                document.getElementById('checkOutImage').classList.remove('hidden');
            }
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

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

        window.onload = function() {
            populateSchoolDropdown();
        };

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

        function filterByDate() {
        const selectedDate = document.getElementById('date').value;
        if (selectedDate) {
            console.log(`Filter berdasarkan tanggal: ${selectedDate}`);
            // Tambahkan logika untuk memfilter data berdasarkan tanggal
            // Misalnya, panggil API atau filter data lokal
        } else {
            console.log('Tidak ada tanggal yang dipilih.');
        }
    }

    </script>
</div>
@endsection
