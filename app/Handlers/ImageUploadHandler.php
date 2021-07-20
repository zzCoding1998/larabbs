<?php


namespace App\Handlers;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadHandler
{

    protected $allowed_ext = ['jpg','jpeg','png','gif'];

    public function save(UploadedFile $file,$folder,$prefix,$max_width = false)
    {
        $folder_name = "uploads/images/{$folder}/" . date('Y-m-d');

        $upload_path = public_path() . '/' . $folder_name;

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        if(! in_array($extension,$this->allowed_ext)){
            return false;
        }

        $file->move($upload_path,$filename);

        if($max_width && $extension != 'gif'){
            $this->reduceSize($upload_path . '/' . $filename, $max_width);
        }

        return [
            'path' => '/' . $folder_name . '/' . $filename
        ];
    }

    protected function reduceSize($filePath,$max_width)
    {
        $image = Image::make($filePath);

        $image->resize($max_width,null,function ($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $image->save($filePath);
    }

}
