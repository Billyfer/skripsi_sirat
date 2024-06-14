@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Branches</h1>
            <a href="{{ route('branches.create') }}" class="btn btn-primary">Add Branch</a>
            <br><br>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Cabang</th>
                        <th>Kota/Kabupaten</th>
                        <th>Alamat</th>
                        <th>Nama Pimpinan</th>
                        <th>NIB Cabang</th>
                        <th>PDF NIB</th>
                        <th>PDF Akta Cabang</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($branches as $branch)
                        <tr>
                            <td>{{ $branch->id }}</td>
                            <td>{{ $branch->nama_cabang }}</td>
                            <td>{{ $branch->kota_kabupaten }}</td>
                            <td>{{ $branch->alamat }}</td>
                            <td>{{ $branch->nama_pimpinan }}</td>
                            <td>{{ $branch->nib_cabang }}</td>
                            <td><a href="{{ asset('storage/' . $branch->pdf_nib) }}" target="_blank">View PDF</a></td>
                            <td><a href="{{ asset('storage/' . $branch->pdf_akta_cabang) }}" target="_blank">View PDF</a></td>
                            <td>
                                <a href="{{ route('branches.edit', $branch->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" style="display:inline-block;">
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
