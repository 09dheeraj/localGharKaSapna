<?php

namespace App\Http\Controllers;

use App\Models\PostProperty;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $sessionID = session()->get('id');
        $title = "My Post Properties - Ghar Ka Sapna";
        $properties = PostProperty::where('reg_id', $sessionID)->orderBy('created_at', 'desc')->paginate(25);
        return view('Vendor.post_properties', compact('title', 'properties'));
    }

    public function editPostProperty($name, $id)
    {

        $ID = base64_decode($id);
        $decodeName = base64_decode($name);
        $title = $decodeName . " - Ghar Ka Sapna";
        $property = PostProperty::where('id', $ID)->first();
        return view('Vendor.edit_postProperty', compact('title', 'property'));
    }

    public function singlePropertyListing($name, $id)
    {
        $ID = base64_decode($id);
        $decodeName = base64_decode($name);
        $title = $decodeName . " - Ghar Ka Sapna";
        $property = PostProperty::where('id', $ID)->first();
        return view('Vendor.single_property', compact('title', 'property'));
    }
}
