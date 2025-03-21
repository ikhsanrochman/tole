<!-- File: resources/views/admin/properties/create.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Add Property')
@section('page_title', 'Add New Property')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_rumah" class="form-label">Nama Rumah <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_rumah') is-invalid @enderror" 
                                   id="nama_rumah" name="nama_rumah" value="{{ old('nama_rumah') }}" required>
                            @error('nama_rumah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                   id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Link Google Maps <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                                   id="alamat" name="alamat" value="{{ old('alamat') }}" 
                                   placeholder="https://maps.app.goo.gl/..." required>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="luas_tanah" class="form-label">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('luas_tanah') is-invalid @enderror" 
                                           id="luas_tanah" name="luas_tanah" value="{{ old('luas_tanah') }}" required>
                                    @error('luas_tanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="luas_bangunan" class="form-label">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('luas_bangunan') is-invalid @enderror" 
                                           id="luas_bangunan" name="luas_bangunan" value="{{ old('luas_bangunan') }}" required>
                                    @error('luas_bangunan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="lantai" class="form-label">Jumlah Lantai <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('lantai') is-invalid @enderror" 
                                           id="lantai" name="lantai" value="{{ old('lantai') }}" required>
                                    @error('lantai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" 
                                   id="harga" name="harga" value="{{ old('harga') }}" required>
                            @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fasilitas" class="form-label">Fasilitas <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('fasilitas') is-invalid @enderror" 
                                      id="fasilitas" name="fasilitas" rows="4" required>{{ old('fasilitas') }}</textarea>
                            @error('fasilitas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar_cover" class="form-label">Gambar Cover <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('gambar_cover') is-invalid @enderror" 
                                   id="gambar_cover" name="gambar_cover" accept="image/*" required>
                            <small class="text-muted">Upload gambar utama untuk properti (maks. 2MB)</small>
                            @error('gambar_cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <div class="mt-2" id="cover-preview-container" style="display: none;">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <img id="cover-preview" src="#" alt="Cover Preview" class="img-fluid" style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar_detail" class="form-label">Gambar & Video Detail <span class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('gambar_detail') is-invalid @enderror" 
                                   id="gambar_detail" name="gambar_detail[]" accept="image/*,video/*" multiple required>
                            <small class="text-muted">Upload beberapa gambar atau video (maks. 20MB per file)</small>
                            @error('gambar_detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('gambar_detail.*')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            
                            <div class="mt-2" id="detail-preview-container" style="display: none;">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="row" id="detail-preview"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.properties') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Properti
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cover image preview
    const coverInput = document.getElementById('gambar_cover');
    const coverPreview = document.getElementById('cover-preview');
    const coverPreviewContainer = document.getElementById('cover-preview-container');
    
    coverInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                coverPreview.src = e.target.result;
                coverPreviewContainer.style.display = 'block';
            }
            
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Multiple files preview
    const detailInput = document.getElementById('gambar_detail');
    const detailPreview = document.getElementById('detail-preview');
    const detailPreviewContainer = document.getElementById('detail-preview-container');
    
    detailInput.addEventListener('change', function() {
        detailPreview.innerHTML = '';
        
        if (this.files && this.files.length > 0) {
            detailPreviewContainer.style.display = 'block';
            
            for (let i = 0; i < this.files.length; i++) {
                const file = this.files[i];
                const reader = new FileReader();
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-2';
                
                reader.onload = function(e) {
                    if (file.type.includes('image')) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'img-fluid';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        col.appendChild(img);
                    } else if (file.type.includes('video')) {
                        const videoThumb = document.createElement('div');
                        videoThumb.className = 'bg-dark text-white text-center p-4';
                        videoThumb.innerHTML = '<i class="fas fa-video fa-2x mb-2"></i><br>' + file.name.substring(0, 15) + '...';
                        col.appendChild(videoThumb);
                    }
                    
                    detailPreview.appendChild(col);
                }
                
                reader.readAsDataURL(file);
            }
        }
    });
    
    // Format price input with thousand separator
    const hargaInput = document.getElementById('harga');
    
    hargaInput.addEventListener('input', function() {
        // Remove non-digit characters
        let value = this.value.replace(/\D/g, '');
        
        // Format with thousand separator
        if (value) {
            this.value = new Intl.NumberFormat('id-ID').format(value);
        }
    });
});
</script>
@endsection