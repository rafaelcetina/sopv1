<?php
//echo $bandera;
$image = imagecreatefromstring($bandera); 

ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
imagejpeg($image, null, 80);
$data = ob_get_contents();
ob_end_clean();
echo '<img src="data:image/jpg;base64,' .  base64_encode($data)  . '" />';
?>

