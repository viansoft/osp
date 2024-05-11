<?php

$url = '/project/update?project=' . $project->dir . '&';

echo controller()->renderPartial('form',['project'=>$project, 'url' => $url, 'action'=>'update']);