<?php

namespace Album;

use Krystal\Application\Module\AbstractModule;
use Album\Service\AlbumService;

final class Module extends AbstractModule
{
    /**
     * Returns routes of this module
     * 
     * @return array
     */
    public function getRoutes()
    {
        return array(
        );
    }

    /**
     * Returns prepared service instances of this module
     * 
     * @return array
     */
    public function getServiceProviders()
    {
        return array(
            'albumService' => new AlbumService($this->createMapper('\Album\Storage\MySQL\AlbumMapper'))
        );
    }
}
