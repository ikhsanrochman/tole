<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rumah;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Rumah::where('status', 'Available')->get();
        return view('landing', compact('properties'));
    }

    public function propertyDetails($id)
    {
        $property = Rumah::findOrFail($id);
        return view('property-details', compact('property'));
    }
}