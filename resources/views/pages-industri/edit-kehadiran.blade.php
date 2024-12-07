@extends('components.layout-industri')

@section('title', 'Edit Kehadiran Siswa')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <h1 class="text-xl sm:text-2xl font-bold mb-6 text-center">Edit Kehadiran</h1>

        <form id="attendanceForm" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" class="border rounded p-2 w-full mt-1" readonly value="Fitri Amaliah">
            </div>

            <div>
                <label for="school" class="block text-sm font-medium text-gray-700">Sekolah</label>
                <input type="text" id="school" class="border rounded p-2 w-full mt-1" readonly value="SMKN 1 Ciomas">
            </div>

            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="date" class="border rounded p-2 w-full mt-1" readonly value="2023-10-01">
            </div>

            <div>
                <label for="checkInTime" class="block text-sm font-medium text-gray-700">Waktu Masuk</label>
                <input type="time" id="checkInTime" class="border rounded p-2 w-full mt-1" readonly value="08:00">
            </div>

            <div>
                <label for="checkOutTime" class="block text-sm font-medium text-gray-700">Waktu Keluar</label>
                <input type="time" id="checkOutTime" class="border rounded p-2 w-full mt-1" readonly value="17:00">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Kehadiran</label>
                <select id="status" class="border rounded p-2 w-full mt-1" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alfa">Alfa</option>
                </select>
            </div>

            <div class="col-span-1 sm:col-span-2 flex justify-end">
                <button type="reset" class="bg-gray-400 text-white text-xs px-3 py-2 rounded shadow hover:bg-gray-500 transition duration-300 ease-in-out mr-2">Batal</button>
                <button type="submit" class="bg-blue-400 text-white text-xs px-3 py-2 rounded shadow hover:bg-blue-500 transition duration-300 ease-in-out">Simpan</button>
            </div>
        </form>
    </div>
</main>

<script>
    document.getElementById('attendanceForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah reload halaman

        // Mendapatkan nilai dari form
        const attendanceData = {
            name: document.getElementById('name').value,
            school: document.getElementById('school').value,
            date: document.getElementById('date').value,
            checkInTime: document.getElementById('checkInTime').value,
            checkOutTime: document.getElementById('checkOutTime').value,
            status: document.getElementById('status').value
        };

        // Simpan data ke database (contoh: console.log untuk simulasi)
        console.log("Data yang disimpan:", attendanceData);

        // Notifikasi data berhasil disimpan
        alert('Data berhasil disimpan!');

        // Arahkan kembali ke halaman "Kelola Kehadiran"
        window.location.href = '/kelola-kehadiran'; // Ganti dengan path halaman Kelola Kehadiran yang benar
    });
</script>


@endsection