<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Rules\Photo2x4Dimension;
use App\Photo;
use Image;
use File;
use DB;

class ImageUploadController extends Controller
{
    public function imageUploadPost(Request $request)
    {

        $messages = [
            'images.min' => 'O número de imagens enviadas não pode ser menor que 5.',
            'images.max' => 'O número de imagens enviadas não pode ser maior que 5.',
        ];

        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,|max:1024',
            'images.*' => new Photo2x4Dimension,
            'images' => 'min:5|max:5',
            'id_person' => 'required',
        ], $messages);

        $idPerson = $request->id_person;

        $images = $request->file('images');

        $lastPhoto = DB::table('photos')->orderBy('group_id', 'desc')->first();

        $groupPhoto = ($lastPhoto) ? (int) $lastPhoto->group_id : 0;

        $groupPhoto++;

        foreach ($images as $key => $image) {
            $time = time() + $key;

            $imageName = $time . '.' . $image->extension();  

            $pathStorage = 'storage/image/photo/person/' . $idPerson . '/' . date('Y/m/d');

            $pathDestination = public_path($pathStorage);

            $this->resizeImage($image, $pathDestination, $imageName);

            Photo::create([
                'person_id' => $idPerson,
                'group_id' => $groupPhoto,
                'path_storage' => $pathStorage . '/' . $imageName,
            ]);
        }

        return back()
            ->with('success', 'Suas imagens foram salvas com sucesso!')
            ->with('image',$imageName);
    }

    public function resizeImage($image, $pathDestination, $imageName)
    {
        $resizeImage = Image::make($image->path());

        if(!File::isDirectory($pathDestination)){
            File::makeDirectory($pathDestination, 0755, true, true);
        }

        $resizeImage->resize(354, 472, function ($constraint) {
            $constraint->aspectRatio();
        })->save($pathDestination . '/' . $imageName);
    }
}
