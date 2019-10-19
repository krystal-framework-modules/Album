<?php

namespace Album\Service;

use Album\Storage\MySQL\AlbumMapper;

final class AlbumService
{
    /**
     * Any compliant album mapper
     * 
     * @var \Album\Storage\MySQL\AlbumMapper
     */
    private $albumMapper;

    /**
     * State initialization
     * 
     * @param \Album\Storage\MySQL\AlbumMapper $albumMapper
     * @return void
     */
    public function __construct(AlbumMapper $albumMapper)
    {
        $this->albumMapper = $albumMapper;
    }

    /**
     * Fetch all photos by user id
     * 
     * @param int $userId
     * @return array
     */
    public function fetchAll($userId)
    {
        return $this->albumMapper->fetchAll($userId);
    }
}
