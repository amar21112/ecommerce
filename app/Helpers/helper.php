<?php

define('PAGINATION_COUNT', 20);
function  getFolder(){
         return app()->getLocale() == 'ar' ? 'css-rtl' : 'css';
    }
function saveImage($folder,$image)
   {
        $file_ext = $image->getClientOriginalExtension();
        $file_name = time().'.'.$file_ext;
        $path = $folder;
        $image->move($path,$file_name);

        return $file_name;
   }
 function deleteImage($imagePath)
{

     $file_path =($imagePath);
    if (file_exists($file_path)) {
        unlink($file_path);
    }

}
