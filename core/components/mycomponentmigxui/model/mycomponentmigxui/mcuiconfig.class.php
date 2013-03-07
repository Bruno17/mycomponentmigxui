<?php

class mcuiConfig extends xPDOSimpleObject {

    public function initPaths() {
        $paths = array();
        $paths['mycomponentCore'] = $this->xpdo->getOption('mc.core_path', null, $this->xpdo->getOption('core_path') . 'components/mycomponent/');
        $paths['tplPath'] = $paths['mycomponentCore'] . 'elements/chunks/';
        $this->set('paths', $paths);
        return $paths;
    }

    public function loadConfigArray() {
        $paths = $this->initPaths();

        $path = $paths['mycomponentCore'] . '_build/config/' . strtolower($this->get('packageName') . '.config.php');
        if (file_exists($path)) {
            $config = include $path;
        }
        if (is_array($config)) {
            $this->fromArray($config);
        }
    }

    public function prepareConfigArray($components) {
        $objectArray = $this->toArray();
        
        $objectArray['packageNameLower'] = strtolower($objectArray['packageName']);
        
        $cats = $this->xpdo->fromJson($objectArray['categories']);
        if (is_array($cats)) {
            $categories = array();
            foreach ($cats as $category) {
                unset($category['MIGX_id']);
                $categories[$category['category']] = $category;
            }
            $objectArray['categories'] = $categories;
        }
        
        $objectArray['process'] = explode('||',$objectArray['process']);

        unset($objectArray['id'], $objectArray['createdon'], $objectArray['createdby']);

        return array_merge($components, $objectArray);

    }

    public function loadExampleContent() {
        $paths = $this->initPaths();
        $props = array();
        $props['mycomponentCore'] = $this->xpdo->getOption('mc.core_path', null, $this->xpdo->getOption('core_path') . 'components/mycomponent/');
        require_once $paths['mycomponentCore'] . 'model/mycomponent/helpers.class.php';
        $helpers = new Helpers($this->xpdo, $props);
        $helpers->init();
        $newTpl = $helpers->getTpl('example.config.php');
        return $newTpl;
    }

    public function save($cacheFlag = null) {
        $result = parent::save($cacheFlag);
        if ($result) {
            $this->createConfigFile();
        }
        return $result;
    }

    public function createConfigFile() {
        $newProjectName = $this->get('packageName');
        $newProjectLower = strtolower($newProjectName);

        $paths = $this->initPaths();

        $props = array();
        $props['mycomponentCore'] = $paths['mycomponentCore'];
        require_once $props['mycomponentCore'] . 'model/mycomponent/helpers.class.php';
        $helpers = new Helpers($this->xpdo, $props);
        $helpers->init();
        $newTpl = $helpers->getTpl('example.config.php');


        if (empty($newTpl)) {
            $message = 'Could not find example.config.php';
            break;
        }
        $newTpl = str_replace('Example', $newProjectName, $newTpl);
        $newTpl = str_replace('example', $newProjectLower, $newTpl);
        $configDir = $this->xpdo->getOption('mc.root', null, $this->xpdo->getOption('core_path') . 'components/mycomponent/') . '_build/config/';
        if (!is_dir($configDir)) {
            $message = 'Config directory does not exist';
            break;
        }
        $configFile = $configDir . $newProjectLower . '.config.php';

        if (!file_exists($configFile)) {
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

    }


}
