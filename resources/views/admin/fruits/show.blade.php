@extends('admin.layout')

@section('title', 'Detail Buah')

@section('content')
<div class="card max-w-3xl mx-auto">
    <div class="flex flex-wrap justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Buah</h1>
            <p class="text-gray-600">Informasi lengkap tentang buah</p>
        </div>
        <a href="{{ route('admin.fruits.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">ID</h3>
            <p class="text-lg font-medium">{{ $fruit->id }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Nama</h3>
            <p class="text-lg font-medium">{{ $fruit->name }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Kategori</h3>
            <p class="text-lg font-medium">{{ $fruit->category->name }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Harga</h3>
            <p class="text-lg font-medium">Rp {{ number_format($fruit->price, 2, ',', '.') }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Stok</h3>
            <p class="text-lg font-medium">{{ $fruit->stock }}</p>
        </div>
        <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Deskripsi</h3>
            <p class="text-lg">{{ $fruit->description ?? '-' }}</p>
        </div>
        <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Gambar</h3>
            @if($fruit->image)
                <img src="{{ asset('images/fruits/' . $fruit->image) }}" alt="{{ $fruit->name }}" class="w-48 h-48 object-cover mt-2 rounded">
            @else
                <p class="text-lg">-</p>
            @endif
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Dibuat Tanggal</h3>
            <p class="text-lg">{{ $fruit->created_at->format('d M Y H:i') }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-medium text-gray-500">Diubah Tanggal</h3>
            <p class="text-lg">{{ $fruit->updated_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.fruits.edit', $fruit->id) }}" class="btn btn-primary">
            <i class="fas fa-edit mr-2"></i>Edit
        </a>
        <form method="POST" action="{{ route('admin.fruits.destroy', $fruit->id) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buah ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash mr-2"></i>Hapus
            </button>
        </form>
    </div>
</div>
@endsection