<?php
require_once __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Cek apakah user admin sudah ada
$admin = User::where('email', 'admin@gmail.com')->first();

if (!$admin) {
    User::create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'admin'
    ]);
    echo "User admin berhasil ditambahkan.\n";
} else {
    echo "User admin sudah ada.\n";
}