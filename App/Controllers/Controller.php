<?php
namespace App\Controller;

use App\Core\Database\Database;
use DateTime;
use Exception;
use Upload\File;
use Upload\Storage\FileSystem;
use Upload\Validation\Mimetype;
use Upload\Validation\Size;

class Controller extends Database {

    /**
     * @param $viewName = String with the view Name (this name must match with the name file)
     */
    public static function CreateView($viewName){
        require_once "../Views/$viewName.php";
    }

    public static function uploadFile($fileName, $ext, $folder, $acceptedFiles, $maxStorage){
        $date = new DateTime(date('Y-m-d'));
        $name = $date->getTimestamp(); //SET NAME FOR THE NEW FILE

        // DON'T OVERWRITE AN EXISTING FILE
        $i = 0;
        $parts = pathinfo($name.'.'.$ext);
        while (file_exists($folder . $name.'.'.$parts["extension"])) {
            $i++;
            $name = $parts["filename"] . "-" . $i;
        }
        // PRESERVE FILE FROM TEMPORARY DIRECTORY
        $storage = new FileSystem($folder);
        $file = new File($fileName, $storage);
        $file->setName($name);
        $file->addValidations(array(
            new Mimetype($acceptedFiles),
            new Size($maxStorage)
        ));

        // TRY TO UPLOAD FILE
        try {
            $file->upload();
        } catch (Exception $e) {
            return array("error"=>true, "message"=>$file->getErrors(), "name"=>$name, "ext"=>$file->getExtension());
        }
        return array('error'=>false, "message"=>"Archivo subido exitosamente", "name"=>$name.'.'.$ext);
    }
}