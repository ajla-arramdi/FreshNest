@extends('admin.layouts.app')

@section('title', 'Tambah Sub Category')

@section('content')
<div class="container mt-4">
    <h1>Tambah Sub Category</h1>
    <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    {{-- Form --}}
    <form action="{{ route('admin.sub-categories.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Sub Category</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection