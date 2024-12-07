<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('assets/logo absensipkl.png') }}" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 md:w-1/5 bg-gray-800 h-full text-white flex flex-col fixed">
            <div class="flex items-center justify-center p-4 text-lg font-bold border-b border-gray-700">
                <img src="{{ asset('assets/logo absensipkl.png') }}" alt="profile" class="rounded-full w-10 h-10 border-2 border-gray-400 mr-4">
                <span>Absensi PKL</span>
            </div>
            <nav class="mt-4 flex-grow">
                <ul>
                    <li class="p-3 {{ request()->is('user.dashboard') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <i class="fas fa-home"></i>
                        <a href="{{ route('user.dashboard') }}" class="text-sm">Dashboard</a>
                    </li>
                    <li class="p-3 {{ request()->is('riwayat-kehadiran') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <i class="fas fa-history"></i>
                        <a href="{{ route('riwayat-kehadiran') }}" class="text-sm">Riwayat Kehadiran</a>
                    </li>
                    <li class="p-3 {{ request()->is('jurnal-kegiatan') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <i class="fas fa-book"></i>
                        <a href="{{ route('jurnal-kegiatan') }}" class="text-sm">Jurnal Kegiatan Harian</a>
                    </li>
                    <li class="p-3 {{ request()->is('pengajuan-izin') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <i class="fas fa-user-clock"></i>
                        <a href="{{ route('pengajuan-izin') }}" class="text-sm">Pengajuan Izin</a>
                    </li>
                    <li class="p-3 {{ request()->is('profile') ? 'bg-green-600' : 'hover:bg-gray-700' }} flex items-center space-x-2">
                        <i class="fas fa-user"></i>
                        <a href="{{ route('profile') }}" class="text-sm">Profile</a>
                    </li>
                    <li class="p-3 hover:bg-gray-700 flex items-center space-x-2">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="text-sm">Logout</span>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-y-auto h-screen ml-64">

            <!-- Navbar -->
            <nav class="bg-gray-800 p-5 text-white flex items-center justify-between border-b border-gray-700 sticky top-0 z-10">
                <div class="flex items-center space-x-4"></div>

                <div class="flex items-center space-x-6 ml-auto">
                    <div class="text-white font-bold text-base">
                        Nama Siswa
                    </div>

                    <div class="relative">
                        <button id="profileButton" class="focus:outline-none flex items-center space-x-2">
                            <img src="{{ asset('assets/profile.png') }}" alt="profile"
                                class="rounded-full w-8 h-8 border-2 border-gray-400 cursor-pointer transition duration-150 ease-in-out hover:border-white">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </button>

                        <div id="profileDropdown" class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg hidden transition-all ease-in-out duration-150">
                            <ul class="py-1 text-gray-700">
                                <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                                    <a href="/profile" class="flex items-center space-x-2">
                                        <i class="fas fa-user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li class="block px-4 py-2 hover:bg-gray-100 cursor-pointer transition">
                                    <a href="/logout" class="flex items-center space-x-2">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            
            <div class="bg-gray-100 flex items-center justify-center h-screen">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-4xl">
                 <h2 class="text-2xl font-bold mb-6 text-gray-800">
                  Update Profil
                 </h2>
                 <form> 
                    <div class="flex flex-col md:flex-row">
                        <!-- Foto Profil -->
                        <div class="w-full md:w-1/3 flex flex-col items-center mb-6 md:mb-0">
                            <img id="profilePic" alt="Profile picture" class="rounded-full w-24 h-24 mb-4" 
                                 src="https://storage.googleapis.com/a1aa/image/zNHi9wDDoeV2GaPO4POlteybSvF8IudNiVmupg43WCFx1JsTA.jpg" />
                            <input type="file" id="fileInput" name="profile_picture" class="hidden" onchange="changePhoto()">
                            <label for="fileInput" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer">
                                Ganti Foto Profil
                            </label>
                        </div>
                    
                        <div class="w-full md:w-2/3 md:ml-8">
                            <form id="combinedForm" method="post" enctype="multipart/form-data">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-gray-700">Nama Lengkap</label>
                                        <input class="w-full px-3 py-2 border rounded" name="nama_lengkap" type="text" value="Nur Khotijah"/>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700">NIS</label>
                                        <input class="w-full px-3 py-2 border rounded" name="nis" type="text" value="1092"/>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700">Kelas</label>
                                        <input class="w-full px-3 py-2 border rounded" name="kelas" type="text" value="XII PPLG 3"/>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700">Tempat Lahir</label>
                                        <input class="w-full px-3 py-2 border rounded" name="tempat_lahir" type="text" value="CityB"/>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700">Tanggal Lahir</label>
                                        <div class="relative">
                                            <input class="w-full px-3 py-2 border rounded" name="tanggal_lahir" type="date"/>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-gray-700">Gender</label>
                                        <select class="w-full px-3 py-2 border rounded" name="gender">
                                            <option>Perempuan</option>
                                            <option>Laki-laki</option>
                                        </select>
                                    </div>
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block text-gray-700">Alamat</label>
                                        <textarea class="w-full px-3 py-2 border rounded" name="alamat">390 Road</textarea>
                                    </div>
                                </div>
                                <div class="mt-6 flex justify-center">
                                    <button class="bg-blue-500 text-white px-6 py-2 rounded" type="submit" onclick="submitForm(event)">
                                        Simpan Data
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
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
                    
                        function submitForm(event) {
                            event.preventDefault();
                            document.getElementById('combinedForm').submit();
                        }
                    </script>
                    
        </div>
    </div>
</body>


</html>
