@extends('admin.layouts.app')

@section('title', 'Edit Sub Category')

@section('content')
<div class="container mt-4">
    <h1>Edit Sub Category</h1>
    <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    {{-- Form --}}
    <form action="{{ route('admin.sub-categories.update', $subCategory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $subCategory->category_id) == $category->id ? 'selected' : '' }}>
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
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $subCategory->name) }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection