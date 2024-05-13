<?php

namespace osp\src\controllers;

use osp\src\components\OspReader;
use osp\src\components\Datatable;
use osp\src\models\Project;
use osp\src\components\JsonHelper;

class ProjectController extends StandartController
{
    public function __construct()
    {
    }    
    
    static public function table()
    {        
        $reader = new OspReader(app()->dir('projects'));    
        
        $reader->readProjects();
        
        $data = [];
        
        foreach($reader->projects as $dirProject){
            $project = new Project($dirProject);
            $project->read();
            
            $data[] = [
                'domains' => $project->getDomains(),
                'dir' => $project->dir,
                'actions' => $project->getActions(),
            ];
        }
        
        $headers = Project::labels();

        return Datatable::content([
            'id' => 'project',
            'fields' => array_keys($headers),
            'headers' => $headers,
            'data' => $data,
        ]);
    }    
    
    public function actionUpdate()
    {
        $dirProject = isset($_GET['project']) ? $_GET['project'] : null;
        
        if (!$dirProject){
            $this->redirect('/project');
        }
        
        $project = new Project($dirProject);

        if (isset($_GET['domain'])){
            $project->setDomains($_GET['domain']);
            $project->write();
            echo JsonHelper::outputSuccess('Saved');
            app()->end();
        }
        
        $project->read();
        
        return $this->renderPartial('update',['project'=>$project]);
    }
    
    public function actionCreate()
    {
        $dirProject = isset($_GET['project']) ? $_GET['project'] : null;
        
        if ($dirProject){
            $project = new Project($dirProject);
            $project->create();
            echo JsonHelper::outputSuccess('',['project'=>$dirProject]);
            app()->end();
        }
        
        return $this->renderPartial('create');
    }    
}