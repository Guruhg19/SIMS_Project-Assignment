@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-lg  mb-6">Daftar Produk</h2>

    <!-- Form Pencarian dan Filter -->
    <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4 mb-6">
        <input type="text" 
               name="search" 
               placeholder="Cari produk..." 
               value="{{ request('search') }}" 
               class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
        
        <select name="category" 
                class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        
        <button type="submit" 
                class="w-full md:w-auto px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
            Cari
        </button>
    </form>

    <!-- Tombol Tambah Produk dan Ekspor Excel -->
    <div class="flex justify-between items-center mb-4">
        <a href="{{ route('products.create') }}" 
           class="px-6 py-2  bg-blue-500 text-white rounded-lg hover:bg-blue-700">
        Tambah Produk
        </a>
        <a href="{{ route('products.export') }}" 
        class="flex items-center px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-700">
         <img src="{{ asset('uploads/MicrosoftExcelLogo.png') }}" 
              alt="Excel Icon" 
              class="w-5 h-5 mr-2">
         Ekspor Excel
     </a>
     
    </div>

    <!-- Tabel Data Produk -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-gray-500 text-sm">
                <tr>
                    <th class="px-4 py-5 text-left">No</th>
                    <th class="px-4 py-5 text-left">Gambar</th>
                    <th class="px-4 py-5 text-left">Nama Produk</th>
                    <th class="px-4 py-5 text-left">Kategori Produk</th>
                    <th class="px-4 py-5 text-left">Harga Beli (Rp)</th>
                    <th class="px-4 py-5 text-left">Harga Jual (Rp)</th>
                    <th class="px-4 py-5 text-left">Stok Produk</th>
                    <th class="px-4 py-5 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-500">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2">{{ $product->category->name }}</td>
                        <td class="px-4 py-2">{{ number_format($product->purchase_price, 2, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ number_format($product->sale_price, 2, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ $product->stock }}</td>
                        <td class="px-4 py-10    flex items-center space-x-2">
                            <a href="{{ route('products.edit', $product->id) }}" class="flex items-center justify-center">
                                <img src="{{ asset('uploads/edit.png') }}" alt="Edit" class="w-4 h-4 hover:scale-110 transition-transform duration-200">
                            </a>
                        
                            <form action="{{ route('products.destroy', $product->id) }}" 
                                  method="POST" 
                                  class="inline-block" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-center">
                                    <img src="{{ asset('uploads/delete.png') }}" alt="Delete" class="w-4 h-4 hover:scale-110 transition-transform duration-200">
                                </button>
                            </form>
                        </td>                        
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-2 text-center text-gray-500">
                            Tidak ada data produk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links('pagination::tailwind') }}
    </div>
</div>
@endsection
