<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUpload
{
    public function uploadBase64EncodedImage($base64Image, $filename, $uploadFolder, $storageDisk = 'public')
    {
        if (preg_match('/^data:image\/(\w+);base64,/', $base64Image)) {
            $data = substr($base64Image, strpos($base64Image, ',') + 1);

            $data = base64_decode($data);
            $filenameWithExtension = $filename . '.png';
            $imagePath = 'images/' . $uploadFolder . '/' . $filenameWithExtension;
            Storage::disk($storageDisk)->put($imagePath, $data); // original was disk('public')
            $fileUrl = Storage::url($imagePath);
            return $fileUrl;
        }

        return null; // Return null if not an image
    }

    public function sampleBase64EncodedImage()
    {
        return "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAIAAACRXR/mAAACTklEQVR4nOzYXUhTfxzH8Z2/B/5WWkhYyoSJJYRFZEN6Wg9MnGBQXYyEysqCYoRYZkkIDaIHa1mUF8UMzCwDsUfsASNIKo1T0vKitiJbQRlmq0S60VW379/lufte/D53L842PnzZ93B+x2xZ0+dA+jIscmH3FjJ4bBZ5qKaanN9WSF7qfUrufpIgTe8qMudZOfmfQ2R0LTsRWst0fB6gk5WLycSRHHK4q5Z0ln8nm4Yi5PPO5cpV63/ya2QjedfIJYVOS9eyE6G1zIcpF2ij+TKZfeKN8mlPKTmR5yKj2/xk4w1lmfrv/yCt13/JO+59pNBp6Vp2IrSWURZ+RW9Pv0W+LPOQrUVxMq39IpkRuUbOdC4gRzdVkE2h6+Sn+rOk0GnpWnYitJbx9vFhepHrHjloNZLuF5PJZNJJur6pPx24SsaiATJUoTz2VAaKSaHT0rXsRGgtc8ZB5bxq+VPJrjqF+R3rycwGZSE6E1Fy+rBy1TozSF65vZLcMzJBCp2WrmUnQmuZNx3n6c1TlpLjWcqZ0z3tN5lX/IEsibWRwZ7Z5P66eeTa2BeyxzeHFDotXctOhNYyw+G5dKZXuel3DKSR9anryCU/a8iCo8p+vD/5QOGQ8shUums12ZKvLJPQaeladiK0ltEfV/6n0doGsiA5ldzbnUumnFa+W5h+nJzUGyJP7QyS1SMlZNyzjBQ6LV3LToTWMrJXfKTfPVJe0fjPecnWKh+ZVTRO+rYq7yzbm/+QB8aUc8Cvqh3khrFRUui0dC07EVrrXwAAAP//y1SVFycMbI8AAAAASUVORK5CYII=";
    }
}
