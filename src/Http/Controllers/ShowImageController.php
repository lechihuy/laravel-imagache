<?php

namespace Imagache\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Imagache\Http\Requests\ShowImageRequest;

class ShowImageController extends Controller
{
    /**
     * Handle show image.
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(ShowImageRequest $request) 
    {
        return response()->file(Storage::path('images/'.$request->image));
    }
}