@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="mb-8">
        <a href="{{ route('home') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="p-6 md:p-8">
            <!-- Property Header -->
            <div class="flex flex-wrap justify-between items-start mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $property->nama_rumah }}</h1>
                    <p class="text-gray-600 mt-2">
                        <i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>{{ $property->lokasi }}
                    </p>
                </div>
                <div class="mt-4 md:mt-0">
                <span class="text-xl font-bold text-blue-600">Rp {{ number_format($property->harga, 0, ',', '.') }}</span>
                <span class="ml-2 bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded">
                        {{ $property->status }}
                    </span>
                </div>
            </div>

            <!-- Image Gallery -->
            <div class="mb-8">
                <!-- Main Image -->
                <div class="mb-4">
                    <img id="main-image" src="{{ asset('storage/public/properties/cover/'.$property->gambar_cover) }}" alt="{{ $property->nama_rumah }}" class="w-full h-96 object-cover rounded-lg">
                </div>
                
                <!-- Thumbnails -->
                <div class="grid grid-cols-5 gap-2">
                    <div class="thumbnail-item active">
                        <img src="{{ asset('storage/public/properties/cover/'.$property->gambar_cover) }}" alt="{{ $property->nama_rumah }}" class="h-24 w-full object-cover rounded cursor-pointer" onclick="changeMainImage(this.src)">
                    </div>

                    @php
                        $detailImages = [];
                        if (!empty($property->gambar_detail)) {
                            $decoded = json_decode($property->gambar_detail, true);
                            if (is_array($decoded)) {
                                $detailImages = $decoded;
                            }
                        }
                    @endphp

                    @foreach($detailImages as $index => $image)
    @if(is_string($image) && !str_ends_with($image, '.mp4'))
        <div class="thumbnail-item">
            <img src="{{ asset('storage/public/properties/details/' . $image) }}" alt="{{ $property->nama_rumah }} {{ $index+1 }}" class="h-24 w-full object-cover rounded cursor-pointer" onclick="changeMainImage(this.src)">
        </div>
    @endif
@endforeach

                </div>
            </div>

            <!-- Property Details -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full text-blue-500 mr-4">
                            <i class="fas fa-ruler-combined text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Luas Tanah</p>
                            <p class="font-semibold">{{ $property->luas_tanah }} m²</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full text-blue-500 mr-4">
                            <i class="fas fa-home text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Luas Bangunan</p>
                            <p class="font-semibold">{{ $property->luas_bangunan }} m²</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex items-center">
                        <div class="bg-blue-100 p-3 rounded-full text-blue-500 mr-4">
                            <i class="fas fa-layer-group text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Jumlah Lantai</p>
                            <p class="font-semibold">{{ $property->lantai }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Description -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Alamat</h2>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <p class="text-gray-700 leading-relaxed">{{ $property->lokasi }}</p>
                </div>
            </div>

            <!-- Property Facilities -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Fasilitas</h2>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="prose max-w-none text-gray-700">
                        <p>{{ $property->fasilitas }}</p>
                    </div>
                </div>
            </div>

            <!-- Property Location -->
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Lokasi</h2>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="prose max-w-none text-gray-700">
                        <p>{{ $property->alamat }}</p>
                    </div>
                </div>
            </div>

            <!-- WhatsApp Contact Button -->
            <div class="mt-8">
                <a href="https://wa.me/{{ urlencode('+6287824795784') }}?text={{ urlencode('Halo, saya tertarik dengan properti ' . $property->nama_rumah . ' di ' . $property->lokasi) }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center transition">
                    <i class="fab fa-whatsapp mr-2 text-xl"></i> Hubungi via WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function changeMainImage(src) {
        document.getElementById('main-image').src = src;
        
        // Update active thumbnail
        document.querySelectorAll('.thumbnail-item').forEach(item => {
            item.classList.remove('active');
            if(item.querySelector('img').src === src) {
                item.classList.add('active');
            }
        });
    }
</script>
@endsection
@endsection
