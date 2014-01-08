<?php

/* @var $modx modX */

$modx->lexicon->load('mycomponent:default');
if (!$modx->user->hasSessionContext('mgr')) {
    die('This file can not be run outside of MODX. ');
}
$message = '&nbsp;';

/* get the current project from the mc _build/config directory */
$cpFile = $modx->getOption('mc.root', null, $modx->getOption('core_path') . 'components/mycomponent/') . '_build/config/current.project.php';

@include $cpFile;

/* get migx-configurations and set currentProject*/
$config = $modx->migx->customconfigs;
$prefix = isset($config['prefix']) && !empty($config['prefix']) ? $config['prefix'] : null;

if (isset($config['use_custom_prefix']) && !empty($config['use_custom_prefix'])) {
    $prefix = isset($config['prefix']) ? $config['prefix'] : '';
}
$packageName = $config['packageName'];
$sender = 'default/fields';

$packagepath = $modx->getOption('core_path') . 'components/' . $packageName . '/';
$modelpath = $packagepath . 'model/';

$modx->addPackage($packageName, $modelpath, $prefix);
$classname = $config['classname'];

$object_id = $modx->getOption('object_id', $_REQUEST, 0);

if ($object = $modx->getObject('mcuiConfig', $object_id)) {
    $newProjectName = strtolower($object->get('packageName'));
    $content = file_get_contents($cpFile);
    $content = str_replace($currentProject, $newProjectName, $content);
    $fp = fopen($cpFile, 'w');
    if ($fp) {
        fwrite($fp, $content);
        fclose($fp);
    }
    $currentProject = $newProjectName;

}


$params = array();
$params = $modx->migx->addConnectorParams($params);
$tplPath = $packagepath . 'elements/chunks/';
$tpl = $modx->migx->parseChunk($tplPath . 'migxmycomponentform.tpl', $params);


/* make sure we got it */
if (!isset($currentProject)) {
    die('Current Project is not set');
}

$cssFile = $modx->getOption('mc.assets_url', null, $modx->getOption('assets_url') . 'components/mycomponent/') . 'css/mycomponent.css';

$modx->regClientCSS($cssFile);


$newProjectName = '';
$output = '';
$projects = '';
$code = '';

$projectFile = $modx->getOption('mc.root', null, $modx->getOption('core_path') . 'components/mycomponent/') . '_build/config/projects.php';


$projects = require $projectFile;

if (!is_array($projects)) {
    die('could not get projects array');
}

// $tpl .= print_r($_POST, true);

/* process form */
if ((!empty($_POST)) && (isset($_POST['doit']) || isset($_POST['newproject']) || isset($_POST['switchproject']))) {
    if (isset($_POST['newproject'])) {
        $action = 'newproject';
    } elseif (isset($_POST['switchproject'])) {
        $action = 'switchproject';
    } else {
        $action = $_POST['doit'];
    }

    switch ($action) {
        case 'switchproject':

            break;
        case 'newproject':
            if (empty($_POST['currentproject'])) {
                $message = $modx->lexicon('mc_you_must_specify_a_project_name');
            } elseif (isset($projects[strtolower($_POST['currentproject'])])) {
                $message = $modx->lexicon('mc_project_already_exists');
            } else {
                $newProjectName = $_POST['currentproject'];
                $newProjectLower = strtolower($newProjectName);

                /* update MC current.project.php file */
                $content = file_get_contents($cpFile);
                $content = str_replace($currentProject, $newProjectLower, $content);
                $fp = fopen($cpFile, 'w');
                if ($fp) {
                    fwrite($fp, $content);
                    fclose($fp);
                }


                $currentProject = $newProjectLower;

                /* create new project config file */
                /*
                $tplPath = $modx->getOption('mc.core_path', null, $modx->getOption('core_path') . 'components/mycomponent/') . 'elements/chunks/';
                $newTpl = file_get_contents($tplPath . 'example.config.php');
                */

                $props = array();
                $props['mycomponentCore'] = $modx->getOption('mc.core_path', null, $modx->getOption('core_path') . 'components/mycomponent/');
                require_once $props['mycomponentCore'] . 'model/mycomponent/helpers.class.php';
                $helpers = new Helpers($modx, $props);
                $helpers->init();
                $newTpl = $helpers->getTpl('example.config.php');


                if (empty($newTpl)) {
                    $message = 'Could not find example.config.php';
                    break;
                }
                $newTpl = str_replace('Example', $newProjectName, $newTpl);
                $newTpl = str_replace('example', $newProjectLower, $newTpl);
                $configDir = $modx->getOption('mc.root', null, $modx->getOption('core_path') . 'components/mycomponent/') . '_build/config/';
                if (!is_dir($configDir)) {
                    $message = 'Config directory does not exist';
                    break;
                }
                $configFile = $configDir . $newProjectLower . '.config.php';
                $fp = fopen($configFile, 'w');
                if ($fp) {
                    fwrite($fp, $newTpl);
                    fclose($fp);
                } else {
                    $message = 'Could not open new config file';
                    break;
                }
                $message = "Important! Edit the new config file before running any utilities:\n" . $configFile;
                $projects[$newProjectLower] = $configFile;
                /* update projects file */
                $content = '<' . '?' . "php\n\n  \$projects = " . var_export($projects, true) . ';' . "\n return \$projects;";
                $fp = fopen($projectFile, 'w');
                if ($fp) {
                    fwrite($fp, $content);
                    fclose($fp);
                }

            }

            break;
        case 'bootstrap':
            if ($object) {
                $modx->currentProjectObject = &$object;
            }
            $output = $modx->runSnippet('Bootstrap');
            break;
        case 'exportobjects':
            if ($object) {
                $modx->currentProjectObject = &$object;
            }        
            $output = $modx->runSnippet('ExportObjects');
            break;
        case 'importobjects':
            $output = $modx->runSnippet('ImportObjects');
            break;
        case 'lexiconhelper':
            $output = $modx->runSnippet('LexiconHelper');
            break;
        case 'build':
            if ($object) {
                $modx->currentProjectObject = &$object;
            }          
            $output = $modx->runSnippet('Build');
            break;
        case 'checkproperties':
            $output = $modx->runSnippet('CheckProperties');
            break;

        case 'removeobjects':
            $output = $modx->runSnippet('RemoveObjects');
            break;
        case 'removeobjectsandfiles':
            $output = $modx->runSnippet('RemoveObjects', array('removeFiles' => true));
            break;
        case 'exportfiles':
            if ($object) {
                $modx->currentProjectObject = &$object;
                $output = $object->exportFiles();
            }
            break;
        case 'exportpackages':
            if ($object) {
                $modx->currentProjectObject = &$object;
                $output = $object->exportPackages();
            }                                
            break;            
    }


}

/* populate projects drop-down list with current project selected */
foreach ($projects as $k => $value) {
    $selected = '';
    if ($k == $currentProject) {
        $selected = ' selected="selected" ';
    }
    $code .= '        <option value="' . $k . '"' . $selected . '>' . $k . "</option >\n";
}

$tpl = str_replace('[[+projects]]', $code, $tpl);
$tpl = str_replace('[[+message]]', $message, $tpl);
$tpl = str_replace('[[+current_project]]', $currentProject, $tpl);
$tpl = str_replace('[[+confirm_remove_objects]]', 'Are you sure you want to remove all objects?', $tpl);
$tpl = str_replace('[[+confirm_remove_objects_and_files]]', 'Are you sure you want to remove all objects and files?', $tpl);

// $tpl .= "\nNEW PROJECT: " . $newProjectName . "\n" . 'URL: ' . $url . "\n\n" . print_r($projects, true);

return $tpl . '<pre>' . $output;
