@extends('components.layout-user')

@section('title', 'Profile Siswa')

@section('content')
<!-- Main Content -->
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <main class="w-full p-4 flex-1">
        <div class="max-w-6xl mx-auto mt-10 bg-white rounded-lg shadow-md relative"> 
            <div class="flex flex-col md:flex-row items-center md:items-start py-8 px-8">
                <!-- Foto Profil di Pojok Kiri -->
                <div class="flex-shrink-0 mb-4 md:mb-0 md:w-1/3 text-center relative">
                    <img id="profilePic" class="w-auto h-20 mx-auto" src="{{ asset('assets/Fitri.jpg') }}" alt="Profile Picture">
                    <input type="file" id="fileInput" class="hidden" onchange="changePhoto()">
                    <div class="mt-4">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                        <p class="text-gray-600">Siswa</p>
                    </div>
                </div>                              
                
                <!-- Data Industri di Sebelah Kanan -->
                <div class="w-full md:w-2/3 text-center md:text-left md:pl-8">
                    <div class="max-w-2xl mx-auto border border-gray-300 rounded-lg mb-6">
                        <h3 class="bg-blue-500 text-white p-3 font-semibold text-center rounded-t-lg">Informasi Sekolah</h3>
                        <div class="p-3 text-left space-y-2">
                            <p class="font-sans text-base"><span class="font-medium">Nama Sekolah:</span> SMK Negeri 1 Bogor</p>
                            <p class="font-sans text-base"><span class="font-medium">Jurusan:</span> PPLG</p>
                        </div>
                    </div>                    
                    <!-- Tombol Edit di bawah Info Sekolah -->
                    
                </div>
                
            </div>
        </div>
    </main>

    <script>
    function changePhoto() {
        const fileInput = document.getElementById('fileInput');
        const reader = new FileReader();

        if (fileInput.files && fileInput.files[0]) {
            reader.onload = function (e) {
                document.getElementById('profilePic').src = e.target.result;
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    </script>
</body>
 
    <script>
        function changePhoto() {
            const fileInput = document.getElementById('fileInput');
            const reader = new FileReader();

            if (fileInput.files && fileInput.files[0]) {
                reader.onload = function (e) {
                    document.getElementById('profilePic').src = e.target.result;
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
@endsection
