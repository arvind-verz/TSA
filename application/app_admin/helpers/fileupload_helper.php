<?php
require_once(HELPER_DIR."ImageResize.php");
function fileupload($file, $target, $width, $height, $resize_or_not_resize, $imghidden)
{
    
	$filename = $file['name'];				
		
	if(!empty($filename)) 
	{
		 $filename = explode(".", $filename);				
		 $extension = $filename[count($filename)-1];
		 $filename  = date('YmdHis')."-".rand(0,9).".".$extension; 		
		   
		 $temp = $file['tmp_name'];
		 $upload  = $target."/".$filename;
		 copy($temp, $upload);
		   
		 if(!empty($imghidden))
		 {
			if( file_exists($target."/".$imghidden) and !empty($imghidden) ){ unlink($target."/".$imghidden); }
			if( file_exists($target."/thumb/".$imghidden) and !empty($imghidden) ){ unlink($target."/thumb/".$imghidden); }
			if( file_exists($target."/admin_thumb/".$imghidden) and !empty($imghidden) ){ unlink($target."/admin_thumb/".$imghidden); }
		 }
			
		#############################
		#  IMAGE RESIZE START HERE  #
		#############################
		if($resize_or_not_resize=='true')
		{					
			$image = $target."/".$filename; // SOURCE
				
			if(!empty($width) and empty($height)){ $r = new Resize($image, $width, 0, true); }
			if(!empty($height) and empty($width)){ $r = new Resize($image, 0, $height, true); }
			if(!empty($height) and !empty($width)){ $r = new Resize($image, $width, $height, true); } 
			
			$r=$r->ImageResize($target."/thumb/".$filename);  //  RETURN PATH	
							
		}		
		
		if(is_dir($target."/admin_thumb")) 
		{
			$image = $target."/".$filename; // SOURCE		
			$r2 = new Resize($image, '100', '50', true);
			$r2=$r2->ImageResize($target."/admin_thumb/".$filename);  //  RETURN PATH		
		}
		#############################
		#  IMAGE RESIZE ENDS  HERE  #
		#############################
		
		return $filename;
	}	
	else
	{
		return '';
	}
	
}