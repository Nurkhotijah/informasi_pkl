@extends('components.layout-admin')

@section('title', 'Update Profile Sekolah')

@section('content')
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main class="w-full p-4 flex-1">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Update Profile Sekolah</h2>
            <form action="{{ route('profile.update') }}" method="POST" id="profileForm" class="space-y-6 max-w-full sm:max-w-lg mx-auto">
                @csrf
                @method('PUT')

                <!-- Foto Profil -->
                <div class="text-center">
                    <div class="relative inline-block">
                        <img id="profilePic" class="w-24 h-24 sm:w-auto sm:h-22 mx-auto cursor-pointer" 
                            src="{{ asset('assets/skanic.jpg') }}" alt="Profile Picture" onclick="document.getElementById('fileInput').click();">
                        <input type="file" id="fileInput" class="hidden" onchange="changePhoto()">
                    </div>
                </div>
            
                <!-- Form Input -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="nama_sekolah" class="block font-medium text-gray-700 text-sm">Nama Sekolah</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $profile->name) }}" class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg p-2 text-sm shadow-sm transition">
                    </div>
            
                    <div class="space-y-2">
                        <label for="alamat" class="block font-medium text-gray-700 text-sm">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg p-2 text-sm shadow-sm transition">{{ old('alamat', $profile->alamat) }}</textarea>
                    </div>
            
                    <div class="space-y-2">
                        <label for="email" class="block font-medium text-gray-700 text-sm">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg p-2 text-sm shadow-sm transition">
                    </div>
                </div>
            
                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit" 
                        class="bg-blue-500 text-white text-sm px-6 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                        Simpan
                    </button>
                </div>
            </form>   
        </div>
    </main>

    <script>
        // You can uncomment the following lines if you want to enable profile picture change
        // function changePhoto() {
        //     var file = document.getElementById('fileInput').files[0];
        //     var reader = new FileReader();
        //     reader.onloadend = function () {
        //         document.getElementById('profilePic').src = reader.result; // Update the profile picture
        //     };
        //     if (file) {
        //         reader.readAsDataURL(file); // Read the file as a data URL
        //     }
        // }
    </script>
</body>
@endsection
