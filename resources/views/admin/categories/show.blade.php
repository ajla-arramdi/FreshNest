@extends('admin.layout')

@section('title', 'Detail Buah')

@section('content')
<div class="card max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Buah</h1>
            <p class="text-gray-600">Informasi lengkap produk buah</p>
        </div>
        <a href="{{ route('admin.fruits.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <div class="bg-gray-50 p-4 rounded">
            <p class="text-sm text-gray-500">Nama Buah</p>
            <p class="text-lg font-semibold">{{ $fruit->name }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded">
            <p class="text-sm text-gray-500">Kategori</p>
            <p class="text-lg font-semibold">{{ $fruit->category->name }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded">
            <p class="text-sm text-gray-500">Tipe Jual</p>
            <p class="text-lg font-semibold">
                {{ $fruit->sell_type == 'kg' ? 'Per Kilogram' : 'Per Buah' }}
            </p>
        </div>

        <div class="bg-gray-50 p-4 rounded">
            <p class="text-sm text-gray-500">Harga</p>
            <p class="text-lg font-semibold">
                {{ $fruit->display_price }}
            </p>
        </div>

        @if($fruit->sell_type == 'item')
        <div class="bg-gray-50 p-4 rounded">
            <p class="text-sm text-gray-500">Berat Rata-rata</p>
            <p class="text-lg font-semibold">{{ $fruit->avg_weight }} kg / buah</p>
        </div>
        @endif

        <div class="bg-gray-50 p-4 rounded">
            <p class="text-sm text-gray-500">Stok</p>
            <p class="text-lg font-semibold">
                {{ $fruit->stock }} {{ $fruit->sell_type == 'kg' ? 'kg' : 'buah' }}
            </p>
        </div>

        <div class="md:col-span-2 bg-gray-50 p-4 rounded">
            <p class="text-sm text-gray-500">Deskripsi</p>
            <p>{{ $fruit->description ?? '-' }}</p>
        </div>

    </div>

    <div class="flex gap-3">
        <a href="{{ route('admin.fruits.edit', $fruit->id) }}" class="btn btn-primary">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
    </div>
</div>
@endsection
