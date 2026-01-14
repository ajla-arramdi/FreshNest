@extends('admin.layout')

@section('title', 'Kategori Produk')

@section('content')
<div class="card">
    <div class="flex flex-wrap justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kategori</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Kategori
        </a>
    </div>

    @if($categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Dibuat Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td class="font-medium">{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>{{ $category->created_at->format('d M Y') }}</td>
                        <td><span class="status status-active">Aktif</span></td>
                        <td class="actions-cell">
                            <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-outline" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $categories->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="mb-4 text-6xl text-gray-300">🏷️</div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada kategori</h3>
            <p class="text-gray-500 mb-6">Mulai tambahkan kategori produk pertama Anda sekarang</p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Buat Kategori
            </a>
        </div>
    @endif
</div>
@endsection