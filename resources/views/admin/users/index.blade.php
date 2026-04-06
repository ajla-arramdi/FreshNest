@extends('admin.layouts.app')


@section('title', 'Users')

@section('content')

<div class="card">
    <div style="display:flex; justify-content:space-between; margin-bottom:16px;">
        <h3>Data User</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">+ Tambah</a>
    </div>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $u->id) }}" class="btn">Edit</a>

                    <form method="POST" action="{{ route('admin.users.destroy', $u->id) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn" onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
