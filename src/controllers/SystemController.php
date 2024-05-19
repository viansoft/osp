<?php

namespace osp\src\controllers;

use osp\src\models\Program;
use osp\src\components\JsonHelper;

// use osp\src\components\Datatable;

/*
use osp\src\components\OspReader;
use osp\src\models\Project;
*/

class SystemController extends StandartController
{
    protected $title = 'System';
    
    public function __construct()
    {
    }

    public function actionProgramupdate()
    {
        if (isset($_GET['section'])){
            $program = new Program();
            $program->setSections($_GET['section']);
            $program->write();
            echo JsonHelper::outputSuccess('Saved');
            app()->end();
        }
        
        return $this->renderPartial('program/form/update');
    } 
}