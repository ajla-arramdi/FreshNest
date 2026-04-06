@extends('admin.layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="card max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">➕ Tambah Kategori Baru</h1>

    <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label">Nama Kategori *</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') border-red-500 @enderror" required>
            @error('name') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="flex gap-3 mt-8">
            <button class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Simpan
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </form>
</div>
@endsection
