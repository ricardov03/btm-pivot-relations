<?php

namespace App\Http\Controllers;

use App\Http\Resources\PropertyCollection;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\PropertyCollection
     */
    public function index(Request $request)
    {
        $properties = Property::all();

        return new PropertyCollection($properties);
    }
}
