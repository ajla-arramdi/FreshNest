@extends('admin.layout')

@section('title', 'Edit Buah')

@section('content')
<div class="card max-w-3xl mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Buah</h1>

    <form method="POST" action="{{ route('admin.fruits.update', $fruit->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name" class="form-label">Nama Buah *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $fruit->name) }}" class="form-control @error('name') border-red-500 @enderror" required>

            @error('name')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category_id" class="form-label">Kategori *</label>
            <select id="category_id" name="category_id" class="form-control @error('category_id') border-red-500 @enderror" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $fruit->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea id="description" name="description" rows="4" class="form-control @error('description') border-red-500 @enderror">{{ old('description', $fruit->description) }}</textarea>

            @error('description')
                <div class="form-error">{{ $message }}</div>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="form-group">
                <label for="price" class="form-label">Harga *</label>
                <input type="number" id="price" name="price" value="{{ old('price', $fruit->price) }}" step="0.01" min="0" class="form-control @error('price') border-red-500 @enderror" required>

                @error('price')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="stock" class="form-label">Stok *</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $fruit->stock) }}" min="0" class="form-control @error('stock') border-red-500 @enderror" required>

                @error('stock')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image" class="form-label">Gambar</label>
            <input type="file" id="image" name="image" class="form-control @error('image') border-red-500 @enderror">
            <small class="text-gray-500">Format: jpeg, png, jpg, gif. Max: 2MB</small>

            @error('image')
                <div class="form-error">{{ $message }}</div>
            @enderror

            @if($fruit->image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Gambar saat ini:</p>
                    <img src="{{ asset('images/fruits/' . $fruit->image) }}" alt="{{ $fruit->name }}" class="w-32 h-32 object-cover mt-1 rounded">
                </div>
            @endif
        </div>

        <div class="flex flex-wrap gap-3 mt-8">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-sync-alt mr-2"></i>Perbarui
            </button>
            <a href="{{ route('admin.fruits.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </form>
</div>
@endsection