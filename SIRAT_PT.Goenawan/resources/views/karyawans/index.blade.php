@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Karyawan List</h1>
            <a href="{{ route('karyawans.create') }}" class="btn btn-primary">Add Karyawan</a>
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Cabang</th>
                        <th>Email</th>
                        <th>No WA</th>
                        <th>Alamat</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->id }}</td>
                            <td>{{ $karyawan->nama }}</td>
                            <td>{{ $karyawan->role }}</td>
                            <td>{{ $karyawan->cabang ? $karyawan->cabang->nama_cabang : 'N/A' }}</td>
                            <td>{{ $karyawan->email }}</td>
                            <td>{{ $karyawan->no_wa }}</td>
                            <td>{{ $karyawan->alamat }}</td>
                            <td>{{ $karyawan->username }}</td>
                            <td>
                                <a href="{{ route('karyawans.edit', $karyawan->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('karyawans.destroy', $karyawan->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
