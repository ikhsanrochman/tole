<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;
use App\Models\City;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua data kota untuk dropdown
        $cities = City::orderBy('nama_kota', 'asc')->get();

        // Mulai query rumah
        $query = Rumah::where('status', 'Available');

        // Filter jika kota dipilih
        if ($request->has('city') && $request->city != '') {
            $query->where('lokasi', $request->city);
        }

        // Ambil properti hasil filter
        $properties = $query->get();

        // Kirim data ke view
        return view('landing', compact('properties', 'cities'));
    }

    public function propertyDetails($id)
    {
        $property = Rumah::findOrFail($id);
        return view('property-details', compact('property'));
    }
}
