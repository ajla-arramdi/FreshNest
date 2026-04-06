@extends('admin.layouts.app')


@section('title', 'Sub Categories')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Sub Categories</h1>
        <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary">Tambah Sub Category</a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Sub Category</th>
                    <th>Category</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subCategories as $index => $subCategory)
                    <tr>
                        <td>{{ $subCategories->firstItem() + $index }}</td>
                        <td>{{ $subCategory->name }}</td>
                        <td>{{ $subCategory->category->name }}</td>
                        <td>{{ $subCategory->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.sub-categories.edit', $subCategory->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.sub-categories.destroy', $subCategory->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Yakin ingin menghapus sub category ini?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada Sub Category.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-3">
        {{ $subCategories->links() }}
    </div>
</div>
@endsection