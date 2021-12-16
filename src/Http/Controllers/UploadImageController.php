<?php

namespace Imagache\Http\Controllers;

use Illuminate\Routing\Controller;
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

        foreach ($images as $image) {
            $image->storeAs('images', $image->getClientOriginalName());
        }

        return response()->json([
            'message' => 'OK'
        ]);
    }
}