@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Karyawan</h1>
            <form action="{{ route('karyawans.update', $karyawan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" class="form-control" id="role" required>
                        <option value="Karyawan Pusat" {{ $karyawan->role == 'Karyawan Pusat' ? 'selected' : '' }}>Karyawan Pusat</option>
                        <option value="Pimpinan Cabang" {{ $karyawan->role == 'Pimpinan Cabang' ? 'selected' : '' }}>Pimpinan Cabang</option>
                        <option value="Karyawan Cabang" {{ $karyawan->role == 'Karyawan Cabang' ? 'selected' : '' }}>Karyawan Cabang</option>
                    </select>
                </div>
                <div class="form-group" id="cabang-group" style="{{ $karyawan->role == 'Karyawan Pusat' ? 'display: none;' : 'display: block;' }}">
                    <label for="cabang_id">Cabang:</label>
                    <select name="cabang_id" class="form-control">
                        <option value="">Pilih Cabang</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ $karyawan->cabang_id == $branch->id ? 'selected' : '' }}>{{ $branch->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{ $karyawan->email }}" required>
                </div>
                <div class="form-group">
                    <label for="no_wa">No WA:</label>
                    <input type="text" name="no_wa" class="form-control" value="{{ $karyawan->no_wa }}" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" name="alamat" class="form-control" value="{{ $karyawan->alamat }}" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" value="{{ $karyawan->username }}" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const roleSelect = document.getElementById('role');
        const cabangGroup = document.getElementById('cabang-group');

        const toggleCabangGroup = () => {
            if (roleSelect.value === 'Karyawan Pusat') {
                cabangGroup.style.display = 'none';
            } else {
                cabangGroup.style.display = 'block';
            }
        };

        roleSelect.addEventListener('change', toggleCabangGroup);

        // Initial check
        toggleCabangGroup();
    });
</script>
@endsection
