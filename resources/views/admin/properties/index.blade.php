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
                            <img src="{{ asset('storage/public/properties/cover/'.$property->gambar_cover) }}"  
                                     alt="{{ $property->nama_rumah }}" width="50" height="50" 
                                     class="img-thumbnail">
                            </td>
                            <td>{{ $property->nama_rumah }}</td>
                            <td>{{ $property->lokasi }}</td>
                            <td>{{ $property->luas_bangunan }} m²</td>
                            <td>{{ $property->lantai }}</td>
                            <td>Rp {{ $property->harga }}</td>
                            <td>
                                <span class="badge {{ $property->status == 'Available' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $property->status ?: 'Available' }}
                                </span>
                            </td>
                            <td>
                                
                                <a href="{{ route('admin.properties.edit',$property->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $property->id }})">
    <i class="fas fa-trash"></i>
</button>

<form id="delete-form-{{ $property->id }}" action="{{ route('admin.properties.destroy', $property->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Properti?',
        text: 'Tindakan ini tidak bisa dibatalkan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
@endpush

@endsection