<?php

namespace App\Doctrine;

use App\Entity\LikedImage;
use App\Service\ImageManager;
use Doctrine\ORM\Event\LifecycleEventArgs;

class LikedImageListener
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * ImageUploadListener constructor.
     * @param ImageManager $imageManager
     */
    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        if (!$args->getEntity() instanceof LikedImage) {
            return;
        }

        $this->imageManager->updateLikeCounters();
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        if (!$args->getEntity() instanceof LikedImage) {
            return;
        }

        $this->imageManager->updateLikeCounters();
    }
}
