<?php
$target_file =basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//Choisi le nouveau nom, prend le temps avtuel en miliseconde et ajoute un nb aléoa
$newname = "img".floor(microtime(true) * 1000).rand(0,10000).'.'.$imageFileType;

// verifie le bon format
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {      
    $filename = $_FILES["fileToUpload"]["tmp_name"];
      if (move_uploaded_file($filename,'uploads/'.$newname)) {
        echo "L'image ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a été mise en ligne";
      }else {
        echo "Problème durant l'upload";
      }
  } else {
      //si il y a un probleme
    echo "Pas une image";
  }
}
?>