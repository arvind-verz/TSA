<?php
	class Resize
	{
		private $file_source;		
		private $width_resize;
		private $height_resize;	
		private $proportional;
		
		public function __construct($file_source, $width_resize, $height_resize, $proportional)
		{
			$this->file_source = $file_source;
			$this->width_resize = $width_resize;
			$this->height_resize = $height_resize;			
			$this->proportional = $proportional;
		}
		
		public function setProportional($proportional)
		{
			$this->proportional = $proportional;
		}
		
		public function setFileSource($file_source)
		{
			$this->file_source = $file_source;
		}
		
		public function setHeightResize($height_resize)
		{
			$this->height_resize = $height_resize;
		}
		
		public function setWidthResize($width_resize)
		{
			$this->width_resize = $width_resize;
		}
		
		/*
		private function MemoryUsage()
		{
			$imageInfo    = getimagesize($this->file_source);
			$memoryNeeded = round(($imageInfo[0] * $imageInfo[1] * $imageInfo['bits'] * $imageInfo['channels'] / 8 + Pow(2, 16)) * 1.65);
			  
			$memoryLimit = (int) ini_get('memory_limit')*1048576;
			if ((memory_get_usage() + $memoryNeeded) > $memoryLimit)
			ini_set('memory_limit', ceil((memory_get_usage() + $memoryNeeded + $memoryLimit)/1048576).'M');
		}
		*/		
		public function ImageResize($folder="")
		{
			//$this->MemoryUsage();
			
			if ( $this->height_resize <= 0 && $this->width_resize <= 0 ) return false;
       
			$info = getimagesize($this->file_source);
		    $image = '';
		      
			$final_width = 0;
			$final_height = 0;
			list($width_old, $height_old) = $info;
		      
			if($this->proportional) 
			{		          
				/*
				$proportion = $width_old / $height_old;
		          
				if ( $this->width_resize > $this->height_resize && $this->height_resize != 0) 
				{
					$final_height = $this->height_resize;
					$final_width = $final_height * $proportion;
				}
				elseif ( $this->width_resize < $this->height_resize && $this->width_resize != 0) 
				{
					$final_width = $this->width_resize;
					$final_height = $final_width / $proportion;
				}
				elseif ( $this->width_resize == 0 ) 
				{
					$final_height = $this->height_resize;
					$final_width = $final_height * $proportion;           
				}
				elseif ( $this->height_resize == 0) 
		        {
					$final_width = $this->width_resize;
					$final_height = $final_width / $proportion;           
				}
				else 
				{
					$final_width = $this->width_resize;
					$final_height = $this->height_resize;
				}
				*/
							
				
				/*
				function resize($width,$height) 
				{
					$new_image = imagecreatetruecolor($width, $height);
					
					if( $this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG ) 
					{
						$current_transparent = imagecolortransparent($this->image);
						if($current_transparent != -1) 
						{
							$transparent_color = imagecolorsforindex($this->image, $current_transparent);
							$current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
							imagefill($new_image, 0, 0, $current_transparent);
							imagecolortransparent($new_image, $current_transparent);
						} 
						elseif( $this->image_type == IMAGETYPE_PNG) 
						{
							imagealphablending($new_image, false);
							$color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
							imagefill($new_image, 0, 0, $color);
							imagesavealpha($new_image, true);
						}
					}
					
					imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
					$this->image = $new_image;	
				}
				*/
				
	            /********** added by ajay on 09-07-2012 *************/	
						
				if(($width_old > $this->width_resize) || ($height_old > $this->height_resize))
				{
					//original width exceeds, so reduce the original width to maximum limit.
					//calculate the height according to the maximum width.
					if(($width_old > $this->width_resize) && ($height_old <= $this->height_resize))
					{   
						$percent = $this->width_resize/$width_old;  
						$final_width = $this->width_resize;
						$final_height = round ($height_old * $percent);
					}
				
					//image height exceeds, recudece the height to maxmimum limit.
					//calculate the width according to the maximum height limit.
					if(($width_old <= $this->width_resize) && ($height_old > $this->height_resize))
					{
						$percent = $this->height_resize/$height_old;
						$final_height = $this->height_resize;
						$final_width = round ($width_old * $percent);
					}
				
					//both height and width exceeds.
					//but image can be vertical or horizontal.
					if(($width_old > $this->width_resize) && ($height_old > $this->height_resize))
					{
						//if image has more width than height
						//resize width to maximum width.
						if ($width_old > $height_old)
						{
							$percent = $this->width_resize/$width_old;
							$final_width = $this->width_resize;
							$final_height = round ($height_old * $percent );
						}
				
						//image is vertical or square. More height than width.
						//resize height to maximum height.  
						else
						{
							$percent = $this->height_resize/$height_old;
							$final_height = $this->height_resize;
							$final_width = round ($width_old * $percent);
						}
					}
				} 	
				else
				{
					$final_width = $this->width_resize;
					$final_height = $this->height_resize;
				}
				
				/***********************************************/				
				
			}
			else 
			{
				$final_width = ($this->width_resize <= 0) ? $this->width_resize_old : $this->width_resize;
				$final_height = ($this->height_resize <= 0) ? $this->height_resize_old : $this->height_resize;
			}
		  
			switch ( $info[2] ) 
			{
				case IMAGETYPE_GIF:
					$image = imagecreatefromgif($this->file_source);
				break;
				case IMAGETYPE_JPEG:
					$image = imagecreatefromjpeg($this->file_source);
				break;
				case IMAGETYPE_PNG:
					$image = imagecreatefrompng($this->file_source);
				break;
				default:
					return false;
			}
		  
			$image_resized = imagecreatetruecolor( $final_width, $final_height );
			imagecolortransparent($image_resized, imagecolorallocate($image_resized, 0, 0, 0) );
			imagealphablending($image_resized, false);
			imagesavealpha($image_resized, true);
						  
			imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
			
			//header('Content-type: image/jpeg') ; 
			switch ( $info[2] ) 
			{
				case IMAGETYPE_GIF:					
				imagegif($image_resized, $folder);
				return $folder;  
				break;
				
				case IMAGETYPE_JPEG:
				imagejpeg($image_resized,$folder);
				return $folder;	
				break;
				
				case IMAGETYPE_PNG:
				imagepng($image_resized,$folder);
				return $folder;
				break;
				
				default:
					return false;
			}		      
			return true;
			
		}
	}
	
?>