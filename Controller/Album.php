<?php

namespace Album\Controller;

use Site\Controller\AbstractSiteController;

final class Album extends AbstractSiteController
{
    /**
     * Renders all photos of a current user
     * 
     * @return string
     */
    public function indexAction()
    {
        $this->view->getPluginBag()->appendLastScript('@Album/grid-layout.js');
        
        return $this->view->render('profile/album', array(
            'photos' => $this->getModuleService('albumService')->fetchAll($this->getAuthService()->getId())
        ));
    }

    /**
     * Uploads a photo
     * 
     * @return mixed
     */
    public function uploadAction()
    {
        $id = $this->getAuthService()->getId();
        $input = $this->request->getAll();

        if ($this->getModuleService('albumService')->upload($id, $input)){
            $this->flashBag->set('success', 'Your photo has been uploaded successfully');
        } else {
            $this->flashBag->set('warning', 'No file selected or an error occurred during upload');
        }

        return 1;
    }
}
