@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Produk</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Dropdown Kategori -->
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">Kategori</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="" disabled>Pilih Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nama Produk -->
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Produk</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama produk" value="{{ $product->name }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Harga Beli -->
                <div class="mb-3">
                    <label for="purchase_price" class="form-label fw-bold">Harga Beli</label>
                    <input type="number" name="purchase_price" id="purchase_price" class="form-control" placeholder="Masukkan harga beli" value="{{ $product->purchase_price }}">
                    @error('purchase_price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Harga Jual -->
                <div class="mb-3">
                    <label for="sale_price" class="form-label fw-bold">Harga Jual</label>
                    <input type="text" id="sale_price" class="form-control bg-light" placeholder="Harga jual otomatis dihitung" value="{{ $product->sale_price }}" readonly>
                </div>

                <!-- Stok Produk -->
                <div class="mb-3">
                    <label for="stock" class="form-label fw-bold">Stok Produk</label>
                    <input type="number" name="stock" id="stock" class="form-control" placeholder="Masukkan jumlah stok" value="{{ $product->stock }}">
                    @error('stock')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Upload Gambar</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    @if ($product->image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-thumbnail" width="150">
                        </div>
                    @endif
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('products.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
