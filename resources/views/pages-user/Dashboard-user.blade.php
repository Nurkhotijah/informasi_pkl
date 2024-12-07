@extends('components.layout-user')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="flex-1 p-6 bg-gray-100">
    <div class="bg-white p-4 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-2">
            Hai {{ Auth::user()->name }}
            <span class="ml-2">
                <i class="fas fa-star text-yellow-500"></i>
            </span>
        </h1>
        <p class="text-lg font-semibold mb-1">Selamat Datang di Website Absensi PKL</p>
        <div class="flex space-x-4">
            <a class="bg-blue-500 text-white px-4 py-2 rounded-lg" href="{{ route('jurnal-siswa.index') }}">Lihat Jurnal</a>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg" id="ayo-absen">Ayo Absen</button>
            <a class="bg-gray-800 text-white px-4 py-2 rounded-lg flex items-center gap-2" 
                href="{{ asset('path/to/certificate.pdf') }}" 
                download="Sertifikat_PKL_{{ Auth::user()->name }}">
                <i class="fas fa-download"></i>
                Sertifikat PKL
            </a>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        <!-- Waktu Saat Ini -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Waktu Saat Ini</h2>
            <p class="text-3xl font-bold mt-4" id="current-time">--:--:-- WIB</p>
        </div>

        <!-- Jumlah Laporan -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Jumlah Laporan PKL</h2>
            <p class="text-3xl font-bold mt-4" id="jumlah-laporan">0</p>
        </div>

        <!-- Jumlah Absen -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Jumlah Absen yang Telah Dilakukan</h2>
            <p class="text-3xl font-bold mt-4" id="jumlah-absen">0</p>
        </div>
    </div>
</div>

<!-- Modal Kamera -->
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" id="cameraModal">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Kamera</h2>
            <button class="text-gray-600 hover:text-gray-800" id="closeButton"><i class="fas fa-times"></i></button>
        </div>
        <video autoplay class="w-full h-auto bg-gray-200 rounded-lg" id="video"></video>
        <!-- Tempat Menampilkan Gambar Setelah Foto diambil -->
        <img id="captured-image" class="hidden mt-4 w-full h-auto bg-gray-200 rounded-lg" />
        <div class="flex justify-center mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg mr-2" id="captureButton">Ambil Foto</button>
            <button class="bg-green-500 text-white px-4 py-2 rounded-lg hidden" id="doneButton">Selesai</button>
        </div>
    </div>
</div>

<script>
    // Timer untuk Waktu Saat Ini
    function updateTime() {
        const timeElement = document.getElementById("current-time");
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        timeElement.textContent = `${hours}:${minutes}:${seconds} WIB`;
    }

    // Update waktu setiap detik
    setInterval(updateTime, 1000);

    // Mendapatkan elemen modal dan tombol
    const cameraModal = document.getElementById("cameraModal");
    const captureButton = document.getElementById("captureButton");
    const doneButton = document.getElementById("doneButton");
    const videoElement = document.getElementById("video");
    const capturedImage = document.getElementById("captured-image");
    const closeButton = document.getElementById("closeButton");

   // Fungsi untuk membuka kamera
async function startCamera() {
    const stream = await navigator.mediaDevices.getUserMedia({ video: true });
    videoElement.srcObject = stream;
}

// Fungsi untuk mengambil foto
function capturePhoto() {
    const canvas = document.createElement("canvas");
    canvas.width = videoElement.videoWidth;
    canvas.height = videoElement.videoHeight;
    const ctx = canvas.getContext("2d");
    ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
    const dataUrl = canvas.toDataURL("image/png");

    capturedImage.src = dataUrl;
    capturedImage.classList.remove("hidden");
    videoElement.classList.add("hidden");
    captureButton.classList.add("hidden");
    doneButton.classList.remove("hidden");
}

// Menangani klik tombol Ambil Foto
captureButton.addEventListener("click", capturePhoto);

// Fungsi untuk menonaktifkan tombol setelah absen
function disableButton() {
    const absensiButton = document.getElementById("ayo-absen");
    absensiButton.disabled = true;  // Nonaktifkan tombol
    absensiButton.classList.add("cursor-not-allowed");  // Menambahkan kelas agar terlihat tidak aktif
    absensiButton.classList.add("opacity-50");  // Mengurangi opacity tombol untuk menunjukkan bahwa tombol tidak aktif
}

// Fungsi untuk mengganti teks dan ID tombol
function toggleButton() {
    const absensiButton = document.getElementById("ayo-absen");
    if (absensiButton.textContent === "Ayo Absen") {
        absensiButton.textContent = "Ayo Pulang";
        absensiButton.setAttribute("id", "ayo-pulang"); // Ubah ID tombol
    } else {
        absensiButton.textContent = "Ayo Absen";
        absensiButton.setAttribute("id", "ayo-absen"); // Kembalikan ID tombol
    }
    disableButton(); // Menonaktifkan tombol setelah klik
}

// Menangani klik tombol Selesai
doneButton.addEventListener("click", () => {
    cameraModal.classList.add("hidden");
    updateAttendance();  // Mengupdate jumlah absen
    toggleButton(); // Ganti tombol "Ayo Absen" menjadi "Ayo Pulang" dan menonaktifkan tombol
});

// Menangani klik tombol Tutup
closeButton.addEventListener("click", () => {
    cameraModal.classList.add("hidden");
});

// Menangani klik untuk membuka modal kamera
document.getElementById("ayo-absen").addEventListener("click", () => {
    // Reset gambar dan video saat membuka modal absen
    capturedImage.classList.add("hidden");
    capturedImage.src = "";
    videoElement.classList.remove("hidden");
    captureButton.classList.remove("hidden");
    doneButton.classList.add("hidden");

    // Buka modal kamera
    cameraModal.classList.remove("hidden");
});

// Memulai kamera saat halaman dimuat
window.addEventListener("DOMContentLoaded", startCamera);

// Fungsi untuk mengupdate jumlah absen
function updateAttendance() {
    const attendanceCountElement = document.getElementById("jumlah-absen");
    let currentCount = parseInt(attendanceCountElement.textContent);
    attendanceCountElement.textContent = currentCount + 1;
}

// Fungsi untuk membuka modal
function openModal(absensiId) {
    // Menampilkan modal sesuai ID
    document.getElementById('modal-' + absensiId).classList.remove('hidden');
}

// Fungsi untuk menutup modal
function closeModal(absensiId) {
    // Menyembunyikan modal sesuai ID
    document.getElementById('modal-' + absensiId).classList.add('hidden');
}

// Fungsi untuk menampilkan gambar absen (Masuk/Pulang)
function showImage(type, absensiId) {
    if (type === 'checkIn') {
        document.getElementById('checkInImage-' + absensiId).classList.remove('hidden');
        document.getElementById('checkOutImage-' + absensiId).classList.add('hidden');
    } else if (type === 'checkOut') {
        document.getElementById('checkOutImage-' + absensiId).classList.remove('hidden');
        document.getElementById('checkInImage-' + absensiId).classList.add('hidden');
    }
}

// Fungsi untuk mengirimkan absensi ke backend
async function sendAttendanceData(photoData) {
    const response = await fetch("{{ route('absen.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            photo: photoData
        })
    });
    const data = await response.json();
    if (data.message === 'Absen berhasil') {
        // Handle success (e.g., update UI)
    } else {
        // Handle error
    }
}


</script>

@endsection
