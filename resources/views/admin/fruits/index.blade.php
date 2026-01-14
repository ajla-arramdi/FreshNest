@extends('admin.layout')

@section('title', 'Daftar Buah')

@section('content')
<div class="card">
    <div class="flex flex-wrap justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Buah</h1>
        <a href="{{ route('admin.fruits.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-2"></i>Tambah Buah
        </a>
    </div>

    @if($fruits->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fruits as $fruit)
                    <tr>
                        <td>{{ $fruit->id }}</td>
                        <td class="font-medium">{{ $fruit->name }}</td>
                        <td>{{ $fruit->category->name }}</td>
                        <td>Rp {{ number_format($fruit->price, 2, ',', '.') }}</td>
                        <td>{{ $fruit->stock }}</td>
                        <td class="actions-cell">
                            <a href="{{ route('admin.fruits.show', $fruit->id) }}" class="btn btn-outline" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.fruits.edit', $fruit->id) }}" class="btn btn-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form method="POST" action="{{ route('admin.fruits.destroy', $fruit->id) }}" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buah ini?');">
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
            {{ $fruits->links() }}
        </div>
    @else
        <div class="text-center py-12">
            <div class="mb-4 text-6xl text-gray-300">🍎</div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada buah</h3>
            <p class="text-gray-500 mb-6">Mulai tambahkan buah pertama Anda sekarang</p>
            <a href="{{ route('admin.fruits.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-2"></i>Tambah Buah
            </a>
        </div>
    @endif
</div>
@endsection