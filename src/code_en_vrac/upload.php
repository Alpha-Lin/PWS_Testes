<?php
$target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//Choisi le nouveau nom
$newname = "img".floor(microtime(true) * 1000).rand(0,10000).'.'.$imageFileType;

// verifie le bon format
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
      
    $filename = $_FILES["fileToUpload"]["tmp_name"];
      if (move_uploaded_file($filename,'uploads/'.$newname)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
      }else {
        echo "Sorry, there was an error uploading your file.";
      }
  } else {
      //si il y a un probleme
    echo "File is not an image.";
  }
}
?>