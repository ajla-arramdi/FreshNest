@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

{{-- Statistik Cards --}}
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;margin-bottom:30px;">

    <div class="card">
        <div style="color:#64748b;font-size:14px;">Total Produk</div>
        <div style="font-size:32px;font-weight:700;margin-top:10px;">128</div>
    </div>

    <div class="card">
        <div style="color:#64748b;font-size:14px;">Total Kategori</div>
        <div style="font-size:32px;font-weight:700;margin-top:10px;">8</div>
    </div>

    <div class="card">
        <div style="color:#64748b;font-size:14px;">Total Pesanan</div>
        <div style="font-size:32px;font-weight:700;margin-top:10px;">256</div>
    </div>

    <div class="card">
        <div style="color:#64748b;font-size:14px;">Pendapatan</div>
        <div style="font-size:32px;font-weight:700;margin-top:10px;">Rp 12.500.000</div>
    </div>

</div>

{{-- Section --}}
<div class="card">
    <h3 style="margin-bottom:16px;">📦 Pesanan Terbaru</h3>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#1001</td>
                <td>Andi</td>
                <td>Rp 120.000</td>
                <td><span style="color:green;font-weight:600;">Selesai</span></td>
            </tr>
            <tr>
                <td>#1002</td>
                <td>Budi</td>
                <td>Rp 80.000</td>
                <td><span style="color:orange;font-weight:600;">Diproses</span></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection
