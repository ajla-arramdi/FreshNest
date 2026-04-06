@extends('admin.layouts.app')

@section('title', 'Edit User')

@section('content')

<div class="card">
    <h3>Edit User</h3>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div style="margin-bottom:12px;">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div style="margin-bottom:12px;">
            <label>Email</label>
            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>

        <div style="margin-bottom:12px;">
            <label>Password (opsional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div style="margin-bottom:12px;">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

@endsection