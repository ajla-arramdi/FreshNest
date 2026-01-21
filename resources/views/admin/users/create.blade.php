<form method="POST" action="{{ route('users.store') }}">
@csrf

<input name="name" placeholder="Nama">
<input name="email" placeholder="Email">
<input name="phone" placeholder="No HP">
<input type="password" name="password" placeholder="Password">

<select name="role">
    <option value="user">User</option>
    <option value="staff">Staff</option>
</select>

<button type="submit">Simpan</button>
</form>
