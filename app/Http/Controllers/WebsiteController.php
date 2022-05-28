<?php

namespace App\Http\Controllers;

use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{
    public function index(Request $request,$id = null){
        $website = Website::all();

        if (!empty($id)){
            $website = Website::where('id',$id)->get();
        }

        return WebsiteResource::collection($website);
    }
}
