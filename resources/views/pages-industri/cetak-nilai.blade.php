@extends('components.layout-industri')

@section('title', 'Cetak Nilai Siswa')

@section('content')
<main class="bg-gray-100 p-8">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-lg font-bold mb-4">A. Aspek Kepribadian (Aspek Non Teknis)</h2>
        <table class="w-full border-collapse border border-gray-400 mb-8">
            <thead>
                <tr>
                    <th class="border border-gray-400 p-2 text-center">NO</th>
                    <th class="border border-gray-400 p-2 text-center">KEMAMPUAN</th>
                    <th class="border border-gray-400 p-2 text-center">NILAI</th>
                    <th class="border border-gray-400 p-2 text-center">KUALIFIKASI</th>
                    <th class="border border-gray-400 p-2 text-center">DESKRIPSI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">1</td>
                    <td class="border border-gray-400 p-2">Disiplin Waktu</td>
                    <td class="border border-gray-400 p-2 text-center">90</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">2</td>
                    <td class="border border-gray-400 p-2">Kemampuan Kerja/Motivasi</td>
                    <td class="border border-gray-400 p-2 text-center">95</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">3</td>
                    <td class="border border-gray-400 p-2">Kualitas Kerja</td>
                    <td class="border border-gray-400 p-2 text-center">92</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">4</td>
                    <td class="border border-gray-400 p-2">Inisiatif dan Kreatif</td>
                    <td class="border border-gray-400 p-2 text-center">93</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">5</td>
                    <td class="border border-gray-400 p-2">Perilaku/Keselamatan Kerja</td>
                    <td class="border border-gray-400 p-2 text-center">90</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
            </tbody>
        </table>

        <h2 class="text-lg font-bold mb-4">B. Aspek Produktif (Aspek Pekerjaan/Teknis)</h2>
        <table class="w-full border-collapse border border-gray-400">
            <thead>
                <tr>
                    <th class="border border-gray-400 p-2 text-center">NO</th>
                    <th class="border border-gray-400 p-2 text-center">KEMAMPUAN</th>
                    <th class="border border-gray-400 p-2 text-center">NILAI</th>
                    <th class="border border-gray-400 p-2 text-center">KUALIFIKASI</th>
                    <th class="border border-gray-400 p-2 text-center">DESKRIPSI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">1</td>
                    <td class="border border-gray-400 p-2">Adobe Photoshop</td>
                    <td class="border border-gray-400 p-2 text-center">85</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">2</td>
                    <td class="border border-gray-400 p-2">Adobe Premiere</td>
                    <td class="border border-gray-400 p-2 text-center">87</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
                <tr>
                    <td class="border border-gray-400 p-2 text-center">3</td>
                    <td class="border border-gray-400 p-2">Penggunaan Kamera</td>
                    <td class="border border-gray-400 p-2 text-center">88</td>
                    <td class="border border-gray-400 p-2 text-center">A</td>
                    <td class="border border-gray-400 p-2 text-center">Kompeten</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>


@endsection