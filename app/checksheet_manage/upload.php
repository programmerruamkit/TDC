<?php

$path = "../../"; 
require_once($path.'config/authen.php'); 
require_once($path.'config/connect.php'); 

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'uploads/'; 
if(isset($_FILES['image'])){
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    $final_image = rand(1000,1000000).$img;
    if(in_array($ext, $valid_extensions)){ 
        $path = $path.strtolower($final_image); 

        if(move_uploaded_file($tmp,$path)){
            echo "<img src='app/checksheet_manage/$path' />";
            $insert = $conn->query("INSERT SHEET_LIST_RECORD (SHLR_IMG1) VALUES ('".$path."')");
            //echo $insert?'ok':'err';
        }
    }else{
        echo 'invalid';
    }
}

// IMAGE RESIZE
    // if (!empty($_FILES['image']['name'])) {
    //     $fileTmp = $_FILES['image']['tmp_name'];
    //     $sourceProperties = getimagesize($fileTmp);
    //     $fileNewName = 	rand("10000000","99999999");
    //     $folderPath = 'uploads/';
    //     $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    //     $imageType = $sourceProperties[2];
        
    //     $newFile = $fileNewName.".".$ext;
    //     $filePath = 'uploads/'.$newFile;
    //     echo "<img src='app/checksheet_manage/$filePath' />";
    //     $stmt = $conn->prepare("INSERT SHEET_LIST_RECORD (j) VALUES ('".$newFile."')");
    //     // $stmt = $conn->prepare("UPDATE SHEET_LIST_RECORD SET images=:images	WHERE id=:id");
    //     // $stmt->bindParam(':images', $newFile , PDO::PARAM_STR);
    //     // $stmt->bindParam(':id', $image_id , PDO::PARAM_STR);
    //     $stmt->execute();
    //     // unlink($filePath);

    //     switch ($imageType) {
    //         case IMAGETYPE_PNG:
    //             $imageResourceId = imagecreatefrompng($fileTmp); 
    //             $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
    //             imagepng($targetLayer,$folderPath.$fileNewName.".".$ext);
    //             break;
    //         case IMAGETYPE_GIF:
    //             $imageResourceId = imagecreatefromgif($fileTmp); 
    //             $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
    //             imagegif($targetLayer,$folderPath.$fileNewName.".".$ext);
    //             break;
    //         case IMAGETYPE_JPEG:
    //             $imageResourceId = imagecreatefromjpeg($fileTmp); 
    //             $targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
    //             imagejpeg($targetLayer,$folderPath.$fileNewName.".".$ext);
    //             break;
    //         default:
    //             echo "Invalid Image type.";
    //             exit;
    //             break;
    //     }        
    // } 

    // function imageResize($imageResourceId,$width,$height) {
    //     $targetWidth = $width < 1280 ? $width : 1280 ;
    //     $targetHeight = ($height/$width)* $targetWidth;
    //     $targetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
    //     imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
    //     return $targetLayer;
    // }
