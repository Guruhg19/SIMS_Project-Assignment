@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-full overflow-x-auto">
    <h2 class="text-2xl font-semibold mb-6">Daftar Produk > Tambah Produk</h2>
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Kategori dan Nama Produk -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Dropdown Kategori -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Produk -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
        </div>

        <!-- Harga Beli, Harga Jual dan Stok Barang -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
            <!-- Harga Beli -->
            <div>
                <label for="purchase_price" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                <input type="number" name="purchase_price" id="purchase_price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>

            <!-- Harga Jual (otomatis) -->
            <div>
                <label for="sale_price" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                <input type="number" name="sale_price" id="sale_price" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
            </div>

            <!-- Stok Barang -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700">Stok Barang</label>
                <input type="number" name="stock" id="stock" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            </div>
        </div>

        <!-- Upload Gambar -->
        <div class="col-span-full mb-6">
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Gambar</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10">
                <div class="text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" />
                    </svg>
                    <div class="mt-4 flex text-sm text-gray-600">
                        <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="image" name="image" type="file" class="sr-only" accept="image/jpeg, image/png" required>
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-600">PNG, JPG, GIF 100Kb</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mb-6">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Tambah Produk</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // Hitung harga jual otomatis berdasarkan harga beli
    document.getElementById('purchase_price').addEventListener('input', function() {
        let purchasePrice = parseFloat(this.value);
        if (!isNaN(purchasePrice)) {
            let salePrice = purchasePrice * 1.30; // Harga jual = Harga beli + 30%
            document.getElementById('sale_price').value = salePrice.toFixed(2); // Menampilkan harga jual dengan 2 angka desimal
        }
    });
</script>
@endsection
