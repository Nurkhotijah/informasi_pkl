<div class="p-8 border-t border-gray-200">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Ganti Kata Sandi</h3>
    <form action="{{ route('profile.updatePassword') }}" method="POST">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Kata Sandi Lama</label>
                <input type="password" name="old_password" class="mt-1 p-2 border rounded w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                <input type="password" name="new_password" class="mt-1 p-2 border rounded w-full">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="confirm_password" class="mt-1 p-2 border rounded w-full">
            </div>
        </div>
        <button type="submit" class="mt-4 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">
            Ganti Kata Sandi
        </button>
    </form>
</div>
