<?php
class Storage
{

   public static function get(string $entity, int $refId, string $resource_name, string $quality = 'original')
   {
      $resource_name = str_replace(' ', '_', $resource_name);
      $file = STORAGE_URI . '/entities/' . $entity . '/' . $refId . '/' . ($quality != 'original' ?  $quality . '/' : '') . $resource_name;
      $fileRoute = STORAGE_DIR . '/entities/' . $entity . '/' . $refId . '/' . ($quality != 'original' ?  $quality . '/' : '') . $resource_name;
      if (file_exists($fileRoute)) {
         return $file;
      } else {
         return STORAGE_URI . '/resources/' . 'empty.png';
      }
   }
   public static function up(string $entity, int $refId, string $inputFileName)
   {
      $target_dir = STORAGE_DIR .
         '/entities/' . $entity . '/' . $refId . '/';
      if (Tools::fileUpload($inputFileName, $target_dir)) {
         // $fileName = $target_dir . '/' . $_FILES[$inputFileName]["name"];
         // $newFileName = $target_dir . '/low_' . $_FILES[$inputFileName]["name"];
         // copy($fileName, $newFileName);
         // self::resize_image($newFileName, 640, 640);
         return true;
      }
      return false;
   }
   public static function remove(string $entity, int $refId, $resource_name)
   {
      $current_dir = STORAGE_DIR .
         '/entities/'  . $entity . '/' . $refId . '/' . $resource_name;
      $target_dir = STORAGE_DIR . 'deleted/' . date('Y') . '/' . $entity . '/' . $refId . '/' . $resource_name;
      if (move_uploaded_file($current_dir, $target_dir)) {
         return true;
      }
      return false;
   }
   public static function removeFileBackup(string $entity, int $refId, $resource_name)
   {
      $current_dir = STORAGE_DIR . '/entities/' . $entity . '/' . $refId . '/' . $resource_name;
      $target_dir = STORAGE_BACKUPS_DIR . date('Y') . '/' . $entity . '/' . $refId . '/' . $resource_name;
      if (move_uploaded_file($current_dir, $target_dir)) {
         return true;
      }
      return false;
   }
   public static function empty()
   {
      return STORAGE_URI . '/resources/empty.png';
   }
   public static function resize_image($file, $w, $h, $crop = FALSE)
   {
      list($width, $height) = getimagesize($file);
      $r = $width / $height;
      if ($crop) {
         if ($width > $height) {
            $width = ceil($width - ($width * abs($r - $w / $h)));
         } else {
            $height = ceil($height - ($height * abs($r - $w / $h)));
         }
         $newWidth = $w;
         $newHeight = $h;
      } else {
         if ($w / $h > $r) {
            $newWidth = $h * $r;
            $newHeight = $h;
         } else {
            $newHeight = $w / $r;
            $newWidth = $w;
         }
      }
      $src = imagecreatefromjpeg($file);
      $dst = imagecreatetruecolor($newWidth, $newHeight);
      imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
      return $dst;
   }
}
