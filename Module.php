<?php

namespace Album;

use Krystal\Application\Module\AbstractModule;
use Krystal\Image\Tool\ImageManager;
use Album\Service\AlbumService;

final class Module extends AbstractModule
{
    /**
     * Returns album image manager
     * 
     * @return \Krystal\Image\Tool\ImageManager
     */
    private function createImageManager()
    {
        $plugins = array(
            'thumb' => array(
                'dimensions' => array(
                    // Administration area
                    array(350, 350)
                )
            ),

            'original' => array(
                'prefix' => 'original'
            )
        );

        return new ImageManager(
            '/data/uploads/module/album',
            $this->appConfig->getRootDir(),
            $this->appConfig->getRootUrl(),
            $plugins
        );
    }

    /**
     * Returns routes of this module
     * 
     * @return array
     */
    public function getRoutes()
    {
        return [
            '/profile/album' => [
                'controller' => 'Album@indexAction'
            ],

            '/profile/album/upload' => [
                'controller' => 'Album@uploadAction'
            ],

            '/profile/album/delete/(:var)' => [
                'controller' => 'Album@deleteAction'
            ]
        ];
    }

    /**
     * Returns prepared service instances of this module
     * 
     * @return array
     */
    public function getServiceProviders()
    {
        return array(
            'albumService' => new AlbumService($this->createMapper('\Album\Storage\MySQL\AlbumMapper'), $this->createImageManager())
        );
    }
}
