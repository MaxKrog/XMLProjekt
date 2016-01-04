<?php
function createThumb($pathToImg, $newname){
	$dest_width = 80;
	$dest_height = 80;

	$orig_img = ImageCreateFromPNG($pathToImg);	//OR JPEG
	$orig_width = imagesx($orig_img);
	$orig_height = imagesy($orig_img);

	$tmp_img = imagecreatetruecolor($dest_width, $dest_width);
	
	if( $orig_width <= $orig_height) {

		$src_x = 0;
		$src_y = floor(($orig_height - $orig_width)/2);
		$dest_y = 0;
		$dest_x = 0;
	
		imagecopyresized($tmp_img, $orig_img, $dest_x, $dest_y, $src_x, $src_y, $dest_width, $dest_height, $orig_width, $orig_width);
		imagepng($tmp_img, $newname);
	} else {
	
		$src_x = floor(($orig_width - $orig_height)/2);
		$src_y = 0;
		$dest_y = 0;
		$dest_x = 0;
	
		imagecopyresized($tmp_img, $orig_img, $dest_x, $dest_y, $src_x, $src_y, $dest_width, $dest_height, $orig_height, $orig_height);
		imagepng($tmp_img, $newname);
	}
}

function createMedium($pathToImg, $newname){


	$orig_img = ImageCreateFromPNG($pathToImg);	//OR JPEG
	$orig_width = imagesx($orig_img);
	$orig_height = imagesy($orig_img);
	
	$max_width = 800;
	if( $orig_width > $max_width) {
		$dest_height = floor(( $max_width / $orig_width) * $orig_height);
		
		$tmp_img = imagecreatetruecolor($max_width, $dest_height);
		
		$src_x = 0;
		$src_y = 0;
		$dest_y = 0;
		$dest_x = 0;
	
		imagecopyresized($tmp_img, $orig_img, $dest_x, $dest_y, $src_x, $src_y, $max_width, $dest_height, $orig_width, $orig_height);
		imagepng($tmp_img, $newname);
	}
}