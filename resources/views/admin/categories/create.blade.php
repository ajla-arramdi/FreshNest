@extends('admin.layout')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah Kategori Baru</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nama Kategori *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') border-red-500 @enderror" required>

            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" rows="4" class="form-control @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>

            @error('description')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-wrap gap-3 mt-8">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </form>
</div>
@endsection