"# osp" 
There is small easy web editor for OpenServerPanel version 6 (https://ospanel.io/) 
1. to add/edit files project.ini for projects
2. to edit file {OSPanel}/config/program.ini
To install make 5 small steps:
1. save files to folder '{ROOT_FOR_OSPanel}\OSPanel\home\osp\'.
2. edit file {ROOT_FOR_OSPanel}\OSPanel\home\osp\src\config\config.php
2.1. write path to {ROOT_FOR_OSPanel}\OSPanel in the parameter 'OSPanel'
2.2. [optional] edit paramenter 'projects' if path to folder with projects in other folder than 'home'   
5. restart openserver
6. call http://osp.local
7. enjoy ;-)

P.S. after any saving, please do not forget restart openserver   

Advantages of using:
1. show list of all projects with posibilities search and open project in new browser window
2. view/save option in one click in popup window
3. saving previous vesion of file project.ini/program.ini in format project.ini.yyyymmdd_hhmmss/program.ini.yyyymmdd_hhmmss (as archive of rewrited version), that allows to restore previous version if save incorrect value(s) in new version  

Write any questions/suggestions in the telegram group https://t.me/OspEasyEditor

