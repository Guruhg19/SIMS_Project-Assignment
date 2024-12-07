@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 text-white px-6 py-4">
            <h2 class="text-xl font-semibold">Edit Produk</h2>
        </div>

        <!-- Form -->
        <div class="p-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Dropdown Kategori -->
                <div>
                    <label for="category_id" class="block text-gray-700 font-medium">Kategori</label>
                    <select name="category_id" id="category_id" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500">
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nama Produk -->
                <div>
                    <label for="name" class="block text-gray-700 font-medium">Nama Produk</label>
                    <input type="text" name="name" id="name" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500" placeholder="Masukkan nama produk" value="{{ $product->name }}">
                    @error('name')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Harga Beli -->
                <div>
                    <label for="purchase_price" class="block text-gray-700 font-medium">Harga Beli</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500" placeholder="Masukkan harga beli" value="{{ $product->purchase_price }}">
                    @error('purchase_price')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Harga Jual -->
                <div>
                    <label for="sale_price" class="block text-gray-700 font-medium">Harga Jual</label>
                    <input type="text" id="sale_price" class="w-full mt-2 p-3 bg-gray-100 border border-gray-300 rounded-lg" placeholder="Harga jual otomatis dihitung" value="{{ $product->sale_price }}" readonly>
                </div>

                <!-- Stok Produk -->
                <div>
                    <label for="stock" class="block text-gray-700 font-medium">Stok Produk</label>
                    <input type="number" name="stock" id="stock" class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-500" placeholder="Masukkan jumlah stok" value="{{ $product->stock }}">
                    @error('stock')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div>
                    <label for="image" class="block text-gray-700 font-medium">Upload Gambar</label>
                    <input type="file" name="image" id="image" class="w-full mt-2 p-3 border border-gray-300 rounded-lg">
                    @error('image')
                        <small class="text-red-500">{{ $message }}</small>
                    @enderror

                    @if ($product->image)
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg shadow-md">
                        </div>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
