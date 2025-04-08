@extends('layouts.app')

@section('content')
<section class="hero relative">
    <div class="relative bg-gradient-to-r from-blue-500 to-indigo-600 h-96">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="container mx-auto px-6 md:px-12 relative z-10 flex items-center h-full">
            <div class="text-center mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight mb-4">
                    Temukan Rumah Sewa Impian Anda
                </h1>
                <p class="text-xl text-white mb-8">
                    Berbagai pilihan properti berkualitas dengan harga terjangkau
                </p>
                <a href="#properties" class="bg-white text-blue-600 hover:bg-blue-50 font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-lg">
                    Lihat Properti
                </a>
            </div>
        </div>
    </div>
</section>

<section id="features" class="py-16 bg-gray-50">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Mengapa Memilih Kami?</h2>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="text-blue-500 text-4xl mb-4">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Lokasi Strategis</h3>
                <p class="text-gray-600">Properti kami berlokasi di area strategis dengan akses mudah ke fasilitas umum.</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="text-blue-500 text-4xl mb-4">
                    <i class="fas fa-home"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Properti Berkualitas</h3>
                <p class="text-gray-600">Setiap properti kami memiliki kualitas terbaik dengan fasilitas lengkap.</p>
            </div>
            
            <div class="bg-white p-8 rounded-lg shadow-md text-center">
                <div class="text-blue-500 text-4xl mb-4">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3 class="text-xl font-semibold mb-3">Harga Terjangkau</h3>
                <p class="text-gray-600">Kami menawarkan harga yang kompetitif sesuai dengan fasilitas yang didapatkan.</p>
            </div>
        </div>
    </div>
</section>

<section id="properties" class="py-16">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Properti Tersedia</h2>
        <p class="text-center text-gray-600 mb-12">Temukan rumah yang sesuai dengan kebutuhan Anda</p>
        <form method="GET" action="{{ route('home') }}" class="mb-8 flex flex-col md:flex-row items-center justify-center gap-4">
            <select name="city" class="w-full md:w-1/3 p-3 border rounded-md focus:outline-none focus:ring focus:ring-blue-300">
                <option value="">-- Pilih Kota --</option>
                @foreach($cities as $city)
                    <option value="{{ $city->nama_kota }}" {{ request('city') == $city->nama_kota ? 'selected' : '' }}>
                        {{ $city->nama_kota }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600 transition">
                Filter
            </button>
        </form>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($properties as $property)
            <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
                <img src="{{ asset('storage/public/properties/cover/'.$property->gambar_cover) }}" alt="{{ $property->nama_rumah }}" class="w-full h-64 object-cover">
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-xl font-bold text-gray-800">{{ $property->nama_rumah }}</h3>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $property->status }}</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i>{{ $property->lokasi }}</p>
                    
                    <div class="flex flex-wrap gap-4 mb-4 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-ruler-combined mr-2 text-blue-500"></i>
                            <span>{{ $property->luas_tanah }} m²</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-home mr-2 text-blue-500"></i>
                            <span>{{ $property->luas_bangunan }} m²</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-layer-group mr-2 text-blue-500"></i>
                            <span>{{ $property->lantai }} lantai</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                    <span class="text-xl font-bold text-blue-600">Rp {{ number_format($property->harga, 0, ',', '.') }}</span>
                    <a href="{{ route('property.details', $property->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if(count($properties) == 0)
        <div class="text-center py-8">
            <p class="text-gray-600">Belum ada properti yang tersedia saat ini. Silakan cek kembali nanti.</p>
        </div>
        @endif
    </div>
</section>


@endsection