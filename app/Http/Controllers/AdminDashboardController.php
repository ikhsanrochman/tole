<?php
// File: app/Http/Controllers/AdminDashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;

class AdminDashboardController extends Controller
{
    /**
     * Show the admin dashboard
     */
    public function index()
    {
        $propertyCount = Rumah::count();
        $availableCount = Rumah::where('status', 'Available')->count();
        $soldCount = Rumah::where('status', 'Sold')->count();
        
        return view('admin.dashboard', compact('propertyCount', 'availableCount', 'soldCount'));
    }
    
    /**
     * Show properties list
     */
    public function properties()
    {
        $properties = Rumah::all();
        return view('admin.properties', compact('properties'));
    }

    public function create()
{
    return view('admin.properties.create');
}

/**
 * Store a newly created property in storage
 */
public function store(Request $request)
{
    $request->validate([
        'nama_rumah' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'alamat' => 'required|string',
        'luas_tanah' => 'required|numeric',
        'luas_bangunan' => 'required|numeric',
        'lantai' => 'required|numeric',
        'fasilitas' => 'required|string',
        'harga' => 'required|string|max:50',
        'gambar_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gambar_detail.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,avi,mov|max:20480',
    ]);

    // Handle cover image upload
    $coverImageName = time() . '_' . $request->file('gambar_cover')->getClientOriginalName();
    $request->file('gambar_cover')->storeAs('public/uploads', $coverImageName);

    // Handle multiple detail images/videos
    $detailFiles = [];
    if ($request->hasFile('gambar_detail')) {
        foreach ($request->file('gambar_detail') as $file) {
            $detailFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $detailFileName);
            $detailFiles[] = $detailFileName;
        }
    }

    // Create new property
    $property = new \App\Models\Rumah();
    $property->nama_rumah = $request->nama_rumah;
    $property->lokasi = $request->lokasi;
    $property->alamat = $request->alamat;
    $property->luas_tanah = $request->luas_tanah;
    $property->luas_bangunan = $request->luas_bangunan;
    $property->lantai = $request->lantai;
    $property->fasilitas = $request->fasilitas;
    $property->harga = $request->harga;
    $property->gambar_cover = $coverImageName;
    $property->gambar_detail = json_encode($detailFiles);
    $property->status = 'Available';
    $property->save();

    return redirect()->route('admin.properties')
        ->with('success', 'Property added successfully');
}
}