<?php

namespace  App\Scripts;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

Class ImageUploader {
    public $targetDirectory;
    public $slugger;
    
    function __construct(?string $targetDirectory,  SluggerInterface $slugger) {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    function upload(UploadedFile $file){
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);

        $newname = "img_"  . $safeFilename . '_' . uniqid() . '_'  . '.' . $file->guessExtension();

        if (!getimagesize($file)) {
          throw new ExtensionFileException ("Il y a un probleme avec l'extension.");
        }

        try { 
            $file->move($this->targetDirectory, $newname);
        } catch (FileException $e) {
          throw $e;
        }

        return $newname;
    }
}
?>