<?php

namespace Album\Service;

use Album\Storage\MySQL\AlbumMapper;
use Krystal\Image\Tool\ImageManager;
use Krystal\Stdlib\VirtualEntity;
use Krystal\Application\Model\AbstractService;

final class AlbumService extends AbstractService
{
    /**
     * Any compliant album mapper
     * 
     * @var \Album\Storage\MySQL\AlbumMapper
     */
    private $albumMapper;

    /**
     * Image service instance
     * 
     * @var \Krystal\Image\Tool\ImageManager
     */
    private $imageManager;

    /**
     * State initialization
     * 
     * @param \Album\Storage\MySQL\AlbumMapper $albumMapper
     * @param \Krystal\Image\Tool\ImageManager $imageManager
     * @return void
     */
    public function __construct(AlbumMapper $albumMapper, ImageManager $imageManager)
    {
        $this->albumMapper = $albumMapper;
        $this->imageManager = $imageManager;
    }

    /**
     * {@inheritDoc}
     */
    protected function toEntity(array $row)
    {
        $imgBag = clone $this->imageManager->getImageBag();
        $imgBag->setCover($row['file'])
               ->setId($row['id']);

        $entity = new VirtualEntity();
        $entity->setId($row['id'])
               ->setFile($row['file'])
               ->setImageBag($imgBag);

        return $entity;
    }

    /**
     * Uploads a new photo
     * 
     * @param int $userId
     * @param array $input All input data
     * @return boolean
     */
    public function upload($userId, array $input)
    {
        if (isset($input['files']['file'])) {
            $file = $input['files']['file'];

            $this->albumMapper->persist([
                'user_id' => $userId,
                'file' => $file->getUniqueName()
            ]);

            return $this->imageManager->upload($this->albumMapper->getMaxId(), $file);

        } else {
            return false;
        }
    }

    /**
     * Fetch all photos by user id
     * 
     * @param int $userId
     * @return array
     */
    public function fetchAll($userId)
    {
        return $this->prepareResults($this->albumMapper->fetchAll($userId));
    }
}
