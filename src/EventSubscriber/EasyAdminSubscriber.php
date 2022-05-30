<?php

namespace App\EventSubscriber;


use App\Entity\Advertisment;
use App\Entity\User;

use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityDeletedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $appKernel;
    private $User;

    public function __construct(KernelInterface $appKernel)
    {
        $this->appKernel = $appKernel;
    }

    public static function getSubscribedEvents()
    {
        return[
            BeforeEntityPersistedEvent::class=>['CreatedAt'],
            BeforeEntityUpdatedEvent::class=>['UpdatedAt'],




        ];
    }


    public function CreatedAt (BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if (!(($entityInstance instanceof Advertisment)||($entityInstance instanceof User)))return;
        $entityInstance->setCreatedAt( new DateTime() );
    }

    public function UpdatedAt (BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();
        if (!(($entityInstance instanceof Advertisment)||($entityInstance instanceof User)))return;
        $entityInstance->setUpdatedAt( new DateTime() );

    }



}






























// // return array of errros
// public function ControleUplodedFilesAndMakeMove($file_field_name,$MovingFileTo,$max_photo_uploading_size=10485760,$allow_exts=["jpg","gif","png","jpeg"]){
//     $errors=array();
//     try {
//         // Get File Name
//         $FileName = $_FILES[$file_field_name]['name']['illustration']['file'];

//         // Get Originale File Extention
//         $OriginaleFileExtention = explode(".",$FileName);
//         $OriginaleFileExtention=strtolower(end($OriginaleFileExtention));

//         // Get File Size
//         $FileSize= $_FILES[$file_field_name]['size']['illustration']['file'];

//         // Get File Temp
//         $FileTmpName = $_FILES[$file_field_name]['tmp_name']['illustration']['file'];

//         // Get The Real Extention Of The File
//         $FileExtention = explode("/",$_FILES[$file_field_name]["type"]['illustration']['file']);
//         $FileExtention=strtolower(end($FileExtention));

//         // Set The New File Name To Be Pushed In The Data Base (With Extension and File Name Is Absolutly Unique)
//         $NewFileName = md5(uniqid().$FileName).".".$OriginaleFileExtention;

//         // Checking If There Is No Choosen File
//         if(empty($FileSize)){$errors[]="You Must Choose A Photo ";}

//         // Checking The Extention
//         if(! in_array($FileExtention,$allow_exts)){$errors[]="Invalid File Format Must Be ".implode(",",$allow_exts);}

//         // Checking The Size
//         if($FileSize>$max_photo_uploading_size){$errors[]="Too Large File the Size Must be under ". $max_photo_uploading_size." Bytes";}

//     }catch(\Throwable $th){$errors[]="Somthing Went Wrong With Uploading The File";}

//     if (!empty($errors)) {
//         // Deleting the File Initially to Check IT
//         var_dump($this->appKernel->getProjectDir()."/public/Uploads/imgs/".$_FILES["Advertisement"]['name']['illustration']['file']);
//             unlink($this->appKernel->getProjectDir()."/public/Uploads/imgs/".$_FILES["Advertisement"]['name']['illustration']['file']);
//         //end Deleting
//     }
//     return $errors;
// }