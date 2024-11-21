<?php

namespace App\Http\Controllers;

use App\Models\Wilaya;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function get_dairas_by_wilaya(Wilaya $wilaya)
    {
        return json_encode($wilaya->dairas);
    }
}
