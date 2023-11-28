<?php

namespace  App\Scripts;

Class FileUploader {
    public $directory;
    
    function __construct(?string $targetDirectory) {
        $this->directory = $targetDirectory;
    }

    function upload(){
        $target_file =basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        //Choisi le nouveau nom, prend le temps avtuel en miliseconde et ajoute un nb aléoa
        //$newname = "img".floor(microtime(true) * 1000).rand(0,10000).'.'.$imageFileType;
        $newname = "img".uniqid().$imageFileType;
        // verifie le bon format
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {      
            $filename = $_FILES["fileToUpload"]["tmp_name"];
              if (move_uploaded_file($filename,$directory.$newname)) {
                echo "L'image ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a été mise en ligne";
                  return $filename.$directory.$newname;
              }else {
                throw new Exception("Error Processing Image");
                
              }
          } else {
              throw new Exception("Pas d'image.");
          }
        }
    }
}
?>