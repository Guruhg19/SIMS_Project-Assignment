@extends('layouts.app')

@section('content')
<div class="h-screen flex">
    <div class="bg-white  rounded-lg p-10 w-full max-w-3xl">
        <!-- Foto dan Nama Kandidat (Vertikal) -->
        <div class="flex flex-col mb-8">
            <!-- Foto Kandidat -->
            <img src="{{ asset('uploads/user2.png') }}" alt="Foto Profil" class="w-32 h-32 object-cover rounded-full mx-auto">
            
            <!-- Nama Kandidat -->
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
            </div>
        </div>

        <!-- Informasi Kandidat -->
        <div class="grid grid-cols-2 gap-8">
            <!-- Kolom Nama Kandidat -->
            <div>
                <label class="block text-lg font-semibold text-gray-600">Nama Kandidat</label>
                <div class="bg-gray-50 border rounded-lg px-4 py-3 mt-2 text-gray-800">
                    {{ $user->name }}
                </div>
            </div>

            <!-- Kolom Posisi Kandidat -->
            <div>
                <label class="block text-lg font-semibold text-gray-600">Posisi Kandidat</label>
                <div class="bg-gray-50 border rounded-lg px-4 py-3 mt-2 text-gray-800">
                    {{ $user->position ?? 'Belum diatur' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
