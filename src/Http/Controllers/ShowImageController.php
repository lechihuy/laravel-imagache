<?php

namespace Imagache\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
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
        if (Cache::has($request->image)) {
            return Cache::get($request->image);
        }

        Cache::put($request->image, Image::make(Storage::get('images/'.$request->image))
            ->response());

        return Cache::get($request->image);
    }
}