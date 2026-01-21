<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - FreshNest Admin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>

    <style>
        :root {
            --primary: #22c55e;
            --primary-dark: #16a34a;
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e5e7eb;
            --radius: 14px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: white;
            border-right: 1px solid var(--border);
            padding: 1.5rem 1rem;
        }

        .sidebar-header {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 2rem;
            color: var(--primary-dark);
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            margin-bottom: 6px;
            border-radius: 10px;
            color: var(--muted);
            text-decoration: none;
            font-weight: 500;
        }

        .sidebar-menu a:hover {
            background: #f1f5f9;
            color: var(--text);
        }

        .sidebar-menu a.active {
            background: #ecfdf5;
            color: var(--primary-dark);
        }

        /* Main */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
        }

        /* Topbar */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header-title {
            font-size: 1.8rem;
            font-weight: 600;
        }

        /* Cards */
        .card {
            background: var(--card);
            border-radius: var(--radius);
            padding: 1.5rem;
            border: 1px solid var(--border);
            margin-bottom: 1.5rem;
        }

        /* Buttons */
        .btn {
            padding: 10px 16px;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: white;
            color: var(--text);
            font-weight: 500;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid var(--border);
        }

        th {
            text-transform: uppercase;
            font-size: 12px;
            color: var(--muted);
        }

        /* Form */
        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }

        /* User */
        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

    </style>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-header">🍏 FreshNest</div>
    <nav class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('admin.categories.index') }}"><i class="fas fa-tags"></i> Kategori</a>
        <a href="{{ route('admin.fruits.index') }}"><i class="fas fa-apple-alt"></i> Buah</a>
        <a href="{{ route('admin.users.index')}}"><i class="fas fa-box"></i> User Create</a>
        <a href="#"><i class="fas fa-users"></i> User</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Pesanan</a>
    </nav>
</aside>

<main class="main-content">

    <div class="top-nav">
        <h1 class="header-title">@yield('title')</h1>
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn">Keluar</button>
            </form>
        </div>
    </div>

    @yield('content')

</main>

</body>
</html>
