<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ImageIntervention;
use Symfony\Component\HttpFoundation\Response;

class ConvertImageToWebp
{
    public function handle($request, Closure $next)
    {
        $imageFields = ['image', 'images'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $files = $request->file($field);
                $isSingleImage = !is_array($files); // Check if single image
                $files = is_array($files) ? $files : [$files]; // Ensure $files is always an array
                $convertedImages = [];

                foreach ($files as $file) {
                    $imageName = time() . '_' . uniqid() . '.webp';
                    $path = storage_path('app/public/images/' . $imageName);

                    try {
                        ImageIntervention::make($file)->encode('webp', 90)->save($path);
                        $convertedImages[] = $imageName;
                    } catch (\Exception $e) {
                        report($e);
                        return response()->json(['error' => 'Image processing failed.'], 500);
                    }
                }

                // Update the request with the new image names
                if ($isSingleImage) {
                    // If it's a single image, just pass the first element
                    $request->merge([$field => $convertedImages[0]]);
                } else {
                    // If multiple images, pass the whole array
                    $request->merge([$field => $convertedImages]);
                }
            }
        }

        return $next($request);
    }

}
