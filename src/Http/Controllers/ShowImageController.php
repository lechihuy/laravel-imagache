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
        $filter = collect(array_filter($request->validated()));
        $filterHash = $filter->count() ? '_'.$filter->toJson() : null;
        $key = $request->image.$filterHash;
        
        if ($cache = Cache::get($key)) {
            $image = Image::make($cache);
        } else {
            $image = Image::make(Storage::get('images/'.$request->image));
            
            // Resize  image
            if ($filter->has('w') || $filter->has('h')) {
                $w = $filter->get('w', null);
                $h = $filter->get('h', null);

                $image->resize($filter->get('w'), $filter->get('h'), function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            Cache::forever($key, (string) $image->encode('data-url'));
        }

        return $image->response();
    }
}