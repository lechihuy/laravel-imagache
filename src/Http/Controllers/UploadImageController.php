<?php

namespace Imagache\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Imagache\Http\Requests\UploadImageRequest;

class UploadImageController extends Controller
{
    /**
     * Handle upload image.
     * 
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UploadImageRequest $request) 
    {
        $images = $request->file('images');
        $urls = [];

        foreach ($images as $image) {
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('images', $imageName);
            array_push($urls, route('imagache.show', ['image' => $imageName]));
        }

        return response()->json(['urls' => $urls]);
    }
}