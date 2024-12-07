@extends('components.layout-industri')

@section('title', 'Cetak Kehadiran Siswa')

@section('content')

<main class="bg-white p-4 md:p-8">
    <div class="flex justify-end mb-4">
        <button onclick="window.print()" class="bg-green-400 text-white text-xs px-5 py-2 shadow hover:bg-green-500 transition duration-300 ease-in-out">
            <i class="fas fa-print mr-1"></i> Cetak
        </button>
    </div>
    <div class="max-w-2xl mx-auto border p-4 md:p-8">
        <h1 class="text-center text-lg md:text-xl font-bold mb-6 md:mb-8">REKAPITULASI KEHADIRAN PKL</h1>
        <div class="mb-4">
            <div class="flex flex-wrap justify-between mb-2">
                <span class="w-1/2 sm:w-auto">Nama Siswa</span>
                <span class="w-1/2 sm:w-auto text-right">: ....................................................</span>
            </div>
            <div class="flex flex-wrap justify-between mb-2">
                <span class="w-1/2 sm:w-auto">Program Keahlian</span>
                <span class="w-1/2 sm:w-auto text-right">: ....................................................</span>
            </div>
            <div class="flex flex-wrap justify-between mb-2">
                <span class="w-1/2 sm:w-auto">Nama Instansi / Perusahaan</span>
                <span class="w-1/2 sm:w-auto text-right">: ....................................................</span>
            </div>
            <div class="flex flex-wrap justify-between mb-2">
                <span class="w-1/2 sm:w-auto">Lama Praktik</span>
                <span class="w-1/2 sm:w-auto text-right">: ....................................................</span>
            </div>
        </div>
        <table class="w-full border-collapse border border-black mb-4 text-xs md:text-sm">
            <thead>
                <tr>
                    <th class="border border-black p-1 md:p-2">No</th>
                    <th class="border border-black p-1 md:p-2">Uraian</th>
                    <th class="border border-black p-1 md:p-2">Tingkat Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black p-1 md:p-2 text-center">1</td>
                    <td class="border border-black p-1 md:p-2">Hadir</td>
                    <td class="border border-black p-1 md:p-2">________ Hari</td>
                </tr>
                <tr>
                    <td class="border border-black p-1 md:p-2 text-center">2</td>
                    <td class="border border-black p-1 md:p-2">Tidak Hadir</td>
                    <td class="border border-black p-1 md:p-2">________ Hari</td>
                </tr>
                <tr>
                    <td class="border border-black p-1 md:p-2 text-center">3</td>
                    <td class="border border-black p-1 md:p-2">Izin</td>
                    <td class="border border-black p-1 md:p-2">________ Hari</td>
                </tr>
                <tr>
                    <td class="border border-black p-1 md:p-2 text-center"></td>
                    <td class="border border-black p-1 md:p-2">Jumlah</td>
                    <td class="border border-black p-1 md:p-2">________ Hari</td>
                </tr>
            </tbody>
        </table>
        <div class="mb-4">
            <div class="flex flex-wrap justify-between mb-2">
                <span class="w-1/2 sm:w-auto">Dibuat tanggal</span>
                <span class="w-1/2 sm:w-auto text-right">: .......................... 20....</span>
            </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between mb-4">
            <div class="text-center mb-6 md:mb-0">
                <p>Mengetahui,</p>
                <p>Pembimbing Industri dan Dunia Kerja</p>
                <p>(IDUKA)</p>
                <br><br><br>
                <p>________________________</p>
                <p>NIP</p>
            </div>
            <div class="text-center">
                <p>Pembimbing Sekolah (1)</p>
                <br><br><br>
                <p>________________________</p>
                <p>NIP</p>
            </div>
        </div>
    </div>
</main>

@endsection