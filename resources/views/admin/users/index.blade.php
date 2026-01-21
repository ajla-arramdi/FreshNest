@foreach($users as $u)
<tr>
  <td>{{ $u->name }}</td>
  <td>{{ $u->email }}</td>
  <td>{{ $u->role }}</td>
  <td>
    <a href="{{ route('users.edit',$u->id) }}">Edit</a>
    <form method="POST" action="{{ route('users.destroy',$u->id) }}">
      @csrf @method('DELETE')
      <button>Hapus</button>
    </form>
  </td>
</tr>
@endforeach
