<!-- File: resources/views/admin/properties.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Properties')
@section('page_title', 'Property Management')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="dashboard-title">Property List</h4>
    <a href="{{ route('admin.properties.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Property
    </a>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cover</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Size</th>
                            <th>Floor</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($properties as $property)
                        <tr>
                            <td>{{ $property->id }}</td>
                            <td>
                                <img src="{{ asset('storage/uploads/' . $property->gambar_cover) }}" 
                                     alt="{{ $property->nama_rumah }}" width="50" height="50" 
                                     class="img-thumbnail">
                            </td>
                            <td>{{ $property->nama_rumah }}</td>
                            <td>{{ $property->lokasi }}</td>
                            <td>{{ $property->luas_bangunan }} m²</td>
                            <td>{{ $property->lantai }}</td>
                            <td>Rp {{ number_format($property->harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge {{ $property->status == 'Available' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $property->status ?: 'Available' }}
                                </span>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection