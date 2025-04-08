@extends('admin.layouts.app')

@section('title', 'Edit Property')
@section('page_title', 'Edit Property')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
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
                                   id="nama_rumah" name="nama_rumah" value="{{ old('nama_rumah', $property->nama_rumah) }}" required>
                            @error('nama_rumah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" 
                                   id="lokasi" name="lokasi" value="{{ old('lokasi', $property->lokasi) }}" required>
                            @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Link Google Maps <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                                   id="alamat" name="alamat" value="{{ old('alamat', $property->alamat) }}" required>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="luas_tanah" class="form-label">Luas Tanah (m²) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('luas_tanah') is-invalid @enderror" 
                                           id="luas_tanah" name="luas_tanah" value="{{ old('luas_tanah', $property->luas_tanah) }}" required>
                                    @error('luas_tanah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="luas_bangunan" class="form-label">Luas Bangunan (m²) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('luas_bangunan') is-invalid @enderror" 
                                           id="luas_bangunan" name="luas_bangunan" value="{{ old('luas_bangunan', $property->luas_bangunan) }}" required>
                                    @error('luas_bangunan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="lantai" class="form-label">Jumlah Lantai <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('lantai') is-invalid @enderror" 
                                           id="lantai" name="lantai" value="{{ old('lantai', $property->lantai) }}" required>
                                    @error('lantai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="Available" {{ old('status', $property->status) == 'Available' ? 'selected' : '' }}>Available</option>
                                    <option value="Sold" {{ old('status', $property->status) == 'Sold' ? 'selected' : '' }}>Sold</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('harga') is-invalid @enderror" 
       id="harga" name="harga" value="{{ old('harga', $property->harga) }}" required>

                            @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="fasilitas" class="form-label">Fasilitas <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('fasilitas') is-invalid @enderror" 
                                      id="fasilitas" name="fasilitas" rows="4" required>{{ old('fasilitas', $property->fasilitas) }}</textarea>
                            @error('fasilitas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="gambar_cover" class="form-label">Gambar Cover</label>
                            <input type="file" class="form-control @error('gambar_cover') is-invalid @enderror" 
                                   id="gambar_cover" name="gambar_cover" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengganti</small>
                            @error('gambar_cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if($property->gambar_cover)
                            <div class="mt-2" id="cover-preview-container">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <img id="cover-preview" src="{{ asset('storage/public/properties/cover/'.$property->gambar_cover) }}" alt="Cover Preview" class="img-fluid" style="max-height: 200px;">
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="gambar_detail" class="form-label">Gambar & Video Detail</label>
                            <input type="file" class="form-control @error('gambar_detail') is-invalid @enderror" 
                                   id="gambar_detail" name="gambar_detail[]" accept="image/*,video/*" multiple>
                            <small class="text-muted">Kosongkan jika tidak ingin menambah</small>
                            @error('gambar_detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('gambar_detail.*')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror

                            @if ($property->gambar_detail)
                            <div class="mt-2" id="detail-preview-container">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="row" id="detail-preview">
                                            @foreach(json_decode($property->gambar_detail) as $file)
                                            <div class="col-md-3 mb-2 position-relative file-wrapper" data-filename="{{ $file }}">
    <button type="button" class="btn-close btn-sm position-absolute top-0 end-0 m-1 delete-file-btn" aria-label="Close"></button>
    @if (Str::endsWith($file, ['.jpg', '.jpeg', '.png', '.webp']))
    <img src="{{ asset('storage/public/properties/details/'.$file) }}" class="img-fluid" style="height: 100px; object-fit: cover;">
    @elseif (Str::endsWith($file, ['.mp4', '.mov', '.webm']))
    <video src="{{ asset('storage/public/properties/details/'.$file) }}" controls style="width: 100%; height: 100px;"></video>
    @endif
</div>

                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="hidden" name="deleted_files" id="deleted_files" value="">

                <div class="mt-4 d-flex justify-content-between">
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Properti
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const coverInput = document.getElementById('gambar_cover');
    const coverPreview = document.getElementById('cover-preview');

    if (coverInput) {
        coverInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreview.src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    const detailInput = document.getElementById('gambar_detail');
    const detailPreview = document.getElementById('detail-preview');

    detailInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            detailPreview.innerHTML = '';
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
                        const video = document.createElement('video');
                        video.src = e.target.result;
                        video.controls = true;
                        video.style.width = '100%';
                        video.style.height = '100px';
                        col.appendChild(video);
                    }
                    detailPreview.appendChild(col);
                }
                reader.readAsDataURL(file);
            }
        }
    });

    // Handle delete buttons for existing files
const deletedFilesInput = document.getElementById('deleted_files');
const deleteButtons = document.querySelectorAll('.delete-file-btn');

deleteButtons.forEach(button => {
    button.addEventListener('click', function () {
        const wrapper = this.closest('.file-wrapper');
        const filename = wrapper.getAttribute('data-filename');

        // Sembunyikan elemen
        wrapper.style.display = 'none';

        // Tambahkan nama file ke input hidden
        let deleted = deletedFilesInput.value ? deletedFilesInput.value.split(',') : [];
        if (!deleted.includes(filename)) {
            deleted.push(filename);
            deletedFilesInput.value = deleted.join(',');
        }
    });
});

});
</script>

@endsection
