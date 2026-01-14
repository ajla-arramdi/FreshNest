@extends('admin.layout')

@section('title', 'Edit Kategori')

@section('content')
<div class="card max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">✏️ Edit Kategori</h1>

    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Nama Kategori *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex gap-3 mt-8">
            <button class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>Update
            </button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </form>
</div>
@endsection
