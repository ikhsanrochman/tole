@extends('admin.layouts.app') <!-- Sesuaikan dengan layout kamu -->

@section('content')
<div class="container mt-5">
    <h2>Edit Profil Admin</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.profile.update') }}">
        @csrf
    
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $admin->email) }}" required>
    
        <label>Nomor WhatsApp</label>
        <input type="text" name="whatsapp" value="{{ old('whatsapp', $admin->whatsapp) }}">
    
        <label>Password Baru (opsional)</label>
        <input type="password" name="password">
    
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation">
    
        <button type="submit">Update Profil</button>
    </form>
    
    
</div>
@endsection
