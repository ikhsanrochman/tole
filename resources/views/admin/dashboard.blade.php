<!-- File: resources/views/admin/dashboard.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="dashboard-title">Dashboard Overview</h4>
    
    <div class="row">
        <!-- Total Properties Card -->
        <div class="col-md-4">
            <div class="card stat-card primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase mb-1 text-primary">Total Properties</div>
                            <div class="h5 mb-0 font-weight-bold">{{ $propertyCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home stat-icon text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Available Properties Card -->
        <div class="col-md-4">
            <div class="card stat-card success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase mb-1 text-success">Available Properties</div>
                            <div class="h5 mb-0 font-weight-bold">{{ $availableCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle stat-icon text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sold Properties Card -->
        <div class="col-md-4">
            <div class="card stat-card warning">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="text-xs text-uppercase mb-1 text-warning">Sold Properties</div>
                            <div class="h5 mb-0 font-weight-bold">{{ $soldCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags stat-icon text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Recent Properties</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Rumah::orderBy('id', 'desc')->take(5)->get() as $property)
                                <tr>
                                    <td>{{ $property->id }}</td>
                                    <td>{{ $property->nama_rumah }}</td>
                                    <td>{{ $property->lokasi }}</td>
                                    <td>{{ $property->luas_bangunan }} m²</td>
                                    <td>Rp {{ number_format($property->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $property->status == 'Available' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $property->status ?: 'Available' }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection