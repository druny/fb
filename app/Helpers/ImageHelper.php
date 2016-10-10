<?php


namespace app\Helpers;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageHelper
{


    public static function getImgName($img) {
        return md5(time() . $img->getClientOriginalName()) . '.' . $img->getClientOriginalExtension();
    }
    public static function upload($img) {

        $name = self::getImgName($img);
        $path = public_path(config('image.path'));


        Image::make($img)->resize(800, 800)
            ->save($path . config('image.originalFolder') . '/' . $name)
            ->resize(150, 150)
            ->save($path . config('image.mediumFolder') . '/' . $name)
            ->resize(60, 60)
            ->save($path . config('image.smallFolder') . '/' . $name);

        return $name;

    }


    public static function uploadAvatar($img)
    {
        $name = self::getImgName($img);
        $path = public_path(config('image.path') . '/avatars');

        Image::make($img)
            ->resize(150, 150)
            ->save($path . config('image.avatarFolder') . '/' . $name)
            ->resize(60, 60)
            ->save($path . config('image.smallFolder') . '/' . $name);

        return $name;
    }


    public static function delete($name)
    {


        $delete = Storage::delete([
             config('image.originalFolder') . '/' . $name,
             config('image.mediumFolder') . '/' . $name,
             config('image.smallFolder') . '/' . $name,
        ]);
        return $delete;
    }

    public static function deleteAvatar($imgName)
    {
        $folder = 'avatars/';
        Storage::delete([
            $folder . config('image.avatarFolder') . '/' . $imgName,
            $folder . config('image.smallFolder') . '/' . $imgName,
        ]);
    }
}