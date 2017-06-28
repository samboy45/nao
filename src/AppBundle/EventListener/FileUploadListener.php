<?php
/**
 * Created by PhpStorm.
 * User: 17014
 * Date: 08/06/2017
 * Time: 13:04
 */

namespace AppBundle\EventListener;


use AppBundle\Entity\Observation;
use AppBundle\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploadListener
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof Observation) {
            return;
        }

        $file = $entity->getImage();


            // only upload new files
            if (!$file instanceof UploadedFile) {
                return;
            }




        $fileName = $this->uploader->upload($file);
        $entity->setImage($fileName);
    }

    /*public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Observation ) {
            return;
        }

        if ($fileName = $entity->getImage()) {
            $entity->setImage(new File($this->uploader->getTargetDir().'/'.$fileName));
        }
    }*/

}