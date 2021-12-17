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

        if (Cache::has($key)) {
            return Cache::get($key);
        }

        $image = Image::make(Storage::get('images/'.$request->image));

        if ($filter->has(['w', 'h'])) {
            logger(1);
            $image->resize((int) $filter->get('w'), (int) $filter->get('h'));
        }

        Cache::put($key, $image->response());

        return $image->response();
    }
}