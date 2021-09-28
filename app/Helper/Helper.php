<?php
namespace App\Helpers;

class Helper
{
    public static function storagePath($filename)
    {
		// Path to the project's root folder    
		//echo base_path();
		
		// Path to the 'app' folder    
		//echo app_path();        
		
		// Path to the 'public' folder    
		//echo public_path();
		
		// Path to the 'storage' folder    
		//echo storage_path();
		
		// Path to the 'storage/app' folder    
		//echo storage_path('app');
		
		$imagepath = asset('uploads/product/thumnail/jpg/'.$filename);
        echo $imagepath;
    }
	
	 public static function isMobileDevice() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", 
		$_SERVER["HTTP_USER_AGENT"]);
	}
}