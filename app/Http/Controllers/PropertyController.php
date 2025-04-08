<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\City;

use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // Menampilkan daftar properti
    public function index()
    {
        $cities = City::orderBy('nama_kota', 'asc')->get();
        $properties = Property::all();
        return view('admin.properties.index', compact('properties'));
    }

    // Menampilkan form tambah properti
    public function create()
    {
        $cities = City::all();
        $cities = City::select('nama_kota')->orderBy('nama_kota')->get();
        return view('admin.properties.create', compact('cities'));
    }

    // Menyimpan data properti baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_rumah' => 'required|string',
            'lokasi' => 'required|string',
            'alamat' => 'required|string',
            'luas_tanah' => 'required|numeric',
            'luas_bangunan' => 'required|numeric',
            'lantai' => 'required|integer',
            'fasilitas' => 'required|string',
            'harga' => 'required|numeric',
            'status' => 'required|in:Available,Sold',
            'gambar_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_detail.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename_cover = null;
        if ($request->hasFile('gambar_cover')) {
            $filename_cover = time() . '_cover.' . $request->gambar_cover->extension();
            $request->gambar_cover->storeAs('public/properties/cover', $filename_cover);
        }

        $detailImages = [];
        if ($request->hasFile('gambar_detail')) {
            foreach ($request->file('gambar_detail') as $image) {
                $filename_detail = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/properties/details', $filename_detail);
                $detailImages[] = $filename_detail;
            }
        }

        Property::create([
            'nama_rumah' => $request->nama_rumah,
            'lokasi' => $request->lokasi,
            'alamat' => $request->alamat,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'lantai' => $request->lantai,
            'fasilitas' => $request->fasilitas,
            'harga' => $request->harga,
            'status' => $request->status,
            'gambar_cover' => $filename_cover,
            'gambar_detail' => json_encode($detailImages),
        ]);

        return redirect()->route('admin.properties.index')->with('success', 'Property added successfully.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('admin.properties.edit', compact('property'));
    }

    // Menyimpan perubahan data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rumah' => 'required|string',
            'lokasi' => 'required|string',
            'alamat' => 'required|string',
            'luas_tanah' => 'required|numeric',
            'luas_bangunan' => 'required|numeric',
            'lantai' => 'required|numeric',
            'fasilitas' => 'required|string',
            'harga' => 'required|numeric',
            'status' => 'required|in:Available,Sold',
            'gambar_cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_detail.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $property = Property::findOrFail($id);

        $property->update($request->only([
            'nama_rumah', 'lokasi', 'alamat', 'luas_tanah',
            'luas_bangunan', 'lantai', 'fasilitas', 'harga', 'status'
        ]));

        // Cover image
        if ($request->hasFile('gambar_cover')) {
            if ($property->gambar_cover && Storage::exists('public/properties/cover/' . $property->gambar_cover)) {
                Storage::delete('public/properties/cover/' . $property->gambar_cover);
            }
            $filename_cover = time() . '_cover.' . $request->gambar_cover->extension();
            $request->gambar_cover->storeAs('public/properties/cover', $filename_cover);
            $property->gambar_cover = $filename_cover;
        }

        // Detail images
        // Detail images
$existingImages = json_decode($property->gambar_detail, true) ?? [];

// Tambahkan gambar baru jika ada
if ($request->hasFile('gambar_detail')) {
    foreach ($request->file('gambar_detail') as $image) {
        $filename_detail = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/properties/details', $filename_detail);
        $existingImages[] = $filename_detail;
    }
}

// Proses file yang dihapus
$deletedFiles = explode(',', $request->input('deleted_files'));
$existingImages = array_filter($existingImages, function ($img) use ($deletedFiles) {
    if (in_array($img, $deletedFiles)) {
        Storage::delete('public/properties/details/' . $img);
        return false;
    }
    return true;
});

$property->gambar_detail = json_encode(array_values($existingImages));
$property->save();


    return redirect()->route('admin.properties.index')->with('success', 'Properti berhasil diperbarui.');
    }

    // Hapus gambar cover
    public function deleteCoverImage($id)
    {
        $property = Property::findOrFail($id);

        if ($property->gambar_cover && Storage::exists('public/properties/cover/' . $property->gambar_cover)) {
            Storage::delete('public/properties/cover/' . $property->gambar_cover);
        }

        $property->gambar_cover = null;
        $property->save();

        return back()->with('success', 'Cover image deleted successfully.');
    }

    // Hapus satu gambar detail
    public function deleteDetailImage($id, $image)
    {
        $property = Property::findOrFail($id);
        $images = json_decode($property->gambar_detail, true) ?? [];

        $images = array_filter($images, fn($img) => $img !== $image);

        if (Storage::exists('public/properties/details/' . $image)) {
            Storage::delete('public/properties/details/' . $image);
        }

        $property->gambar_detail = json_encode(array_values($images));
        $property->save();

        return back()->with('success', 'Detail image deleted successfully.');
    }

    // Hapus gambar detail dengan AJAX
    public function deleteDetailImageAjax($id, $image)
    {
        $property = Property::findOrFail($id);
        $images = json_decode($property->gambar_detail, true) ?? [];

        $images = array_filter($images, fn($img) => $img !== $image);

        if (Storage::exists('public/properties/details/' . $image)) {
            Storage::delete('public/properties/details/' . $image);
        }

        $property->gambar_detail = json_encode(array_values($images));
        $property->save();

        return response()->json(['message' => 'Gambar berhasil dihapus']);
    }

    // Menghapus properti
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if ($property->gambar_cover && Storage::exists('public/properties/cover/' . $property->gambar_cover)) {
            Storage::delete('public/properties/cover/' . $property->gambar_cover);
        }

        $detailImages = json_decode($property->gambar_detail, true) ?? [];
        foreach ($detailImages as $image) {
            if (Storage::exists('public/properties/details/' . $image)) {
                Storage::delete('public/properties/details/' . $image);
            }
        }

        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}
