<?php

class mcuiConfig extends xPDOSimpleObject {

    public function initPaths() {
        $paths = array();
        $paths['mycomponentCore'] = $this->xpdo->getOption('mc.core_path', null, $this->xpdo->getOption('core_path') . 'components/mycomponent/');
        $paths['tplPath'] = $paths['mycomponentCore'] . 'elements/chunks/';

        $paths['myCore'] = dirname(dirname(dirname(__file__))) . '/';

        $this->set('paths', $paths);
        return $paths;
    }

    public function loadConfigArray() {
        $paths = $this->initPaths();

        $path = $paths['mycomponentCore'] . '_build/config/' . strtolower($this->get('packageName') . '.config.php');
        if (file_exists($path)) {
            $configArray = include $path;
        }
        if (is_array($configArray)) {

            $mcui_config = $this->getMcuiConfig();
            if (is_array($mcui_config)) {
                foreach ($mcui_config as $field => $config) {
                    $type = $config['type'];
                    switch ($type) {
                        case 'migx':
                            $configArray[$field] = $this->toMigx($configArray[$field], $config);
                            break;
                        case 'arraylist':
                            break;
                        case 'todb_rename':
                            $configArray[$config['renameto']] = $configArray[$field];
                            unset($configArray[$field]);
                            break;
                    }
                }
            }

            $this->fromArray($configArray);
        }
    }

    public function getMcuiConfig() {
        $paths = $this->initPaths();
        $configfile = $paths['myCore'] . 'configs/mcui.config.inc.php';
        $myconfigfile = $paths['myCore'] . 'configs/mymcui.config.inc.php';
        $mcui_config = array();

        if (file_exists($myconfigfile)) {
            $mcui_config = include ($myconfigfile);
            $mcui_config = $this->xpdo->fromJson($mcui_config);
        } elseif (file_exists($configfile)) {
            $mcui_config = include ($configfile);
            $mcui_config = $this->xpdo->fromJson($mcui_config);
        }
        return $mcui_config;
    }

    public function prepareConfigArray($components) {


        $mcui_config = $this->getMcuiConfig();

        $objectArray = $this->toArray();

        $objectArray['packageNameLower'] = strtolower($objectArray['packageName']);

        if (is_array($mcui_config)) {
            foreach ($mcui_config as $field => $config) {
                $type = $config['type'];
                switch ($type) {
                    case 'migx':
                        $objectArray[$field] = $this->fromMigx($objectArray[$field], $config);
                        break;
                    case 'arraylist':
                        $objectArray[$field] = explode('||', $objectArray[$field]);
                        break;
                    case 'fromdb_rename':
                        $objectArray[$config['renameto']] = $objectArray[$field];
                        unset($objectArray[$field]);
                        break;
                }
            }
        }

        unset($objectArray['id'], $objectArray['createdon'], $objectArray['createdby']);

        return array_merge($components, $objectArray);

    }

    public function toMigx($config, $mcui_config) {
        $records = array();
        $convert_type = $this->xpdo->getOption('converttype', $mcui_config, 'default');
        $keyfield = $this->xpdo->getOption('keyfield', $mcui_config, 'key');
        $valuefield = $this->xpdo->getOption('valuefield', $mcui_config, 'value');
        $subarrays = $this->xpdo->getOption('subarrays', $mcui_config, '');
        $subarrays = !empty($subarrays) ? explode(',', $subarrays) : array();

        if (is_array($config)) {
            $i = 0;
            foreach ($config as $key => $record) {

                switch ($convert_type) {
                    case 'simple':
                        $value = $record;
                        $record = array();
                        $record[$valuefield] = $value;
                        break;
                    case 'key_value':
                        $value = $record;
                        $record = array();
                        $record[$keyfield] = $key;
                        $record[$valuefield] = $value;
                        break;
                }

                if (count($subarrays) > 0) {
                    foreach ($subarrays as $subarray) {
                        if (is_array($record[$subarray])) {
                            foreach ($record[$subarray] as $field => $value) {
                                $record[$subarray . '.' . $field] = $value;
                            }
                        }
                    }
                }

                $record['MIGX_id'] = $i;
                $records[] = $record;
                $i++;
            }
        }

        $records = $this->xpdo->toJson($records);

        return $records;
    }

    public function fromMigx($config, $mcui_config) {

        $convert_type = $this->xpdo->getOption('converttype', $mcui_config, 'default');
        $keyfield = $this->xpdo->getOption('keyfield', $mcui_config, 'key');
        $valuefield = $this->xpdo->getOption('valuefield', $mcui_config, 'value');
        $subarrays = $this->xpdo->getOption('subarrays', $mcui_config, '');
        $subarrays = !empty($subarrays) ? explode(',', $subarrays) : array();

        $in_array = $this->xpdo->fromJson($config);
        $out_array = array();
        if (is_array($in_array)) {
            foreach ($in_array as $record) {

                if (count($subarrays) > 0) {
                    foreach ($subarrays as $subarray) {
                        foreach ($record as $field => $value) {
                            $fieldparts = explode('.', $field);
                            if (count($fieldparts) > 1 && $fieldparts[0] == $subarray) {
                                $record[$fieldparts[0]][$fieldparts[1]] = $value;
                                unset($record[$field]);
                            }

                        }
                    }
                }
                $key = $record[$keyfield];
                unset($record['MIGX_id']);
                switch ($convert_type) {
                    case 'simple':
                        $out_array[] = $record[$valuefield];
                        break;
                    case 'key_value':
                        $out_array[$key] = $record[$valuefield];
                        break;
                    default:
                        $out_array[$key] = $record;
                }

            }
        }
        return $out_array;
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
            $result = $this->createConfigFile();
        }
        return $result;
    }

    public function exportFiles() {
        $paths = $this->initPaths();

        $path = $paths['mycomponentCore'] . '_build/config/' . strtolower($this->get('packageName') . '.config.php');
        if (file_exists($path)) {
            $configArray = include $path;
            $dirPermission = $this->xpdo->getOption('dirPermission', $configArray, 0777);
            $packageNameLower = $this->xpdo->getOption('packageNameLower', $configArray, '');
            $targetRoot = $this->xpdo->getOption('targetRoot', $configArray, '');
            $workingDirs = $this->xpdo->getOption('workingDirs', $configArray, array());
            $assetsWorkingDir = $this->xpdo->getOption('assets', $workingDirs, '');
            $coreWorkingDir = $this->xpdo->getOption('core', $workingDirs, '');
            if (!empty($packageNameLower) && !empty($assetsWorkingDir) && !empty($targetRoot)) {
                $assetsTargetDir = $targetRoot . 'assets/components/' . $packageNameLower . '/';
                $this->copyDir($assetsWorkingDir, $assetsTargetDir, $dirPermission);
            }
            if (!empty($packageNameLower) && !empty($coreWorkingDir) && !empty($targetRoot)) {
                $coreTargetDir = $targetRoot . 'core/components/' . $packageNameLower . '/';
                $this->copyDir($coreWorkingDir, $coreTargetDir, $dirPermission);
            }

        }

    }

    public function exportPackages() {
        $paths = $this->initPaths();

        $path = $paths['mycomponentCore'] . '_build/config/' . strtolower($this->get('packageName') . '.config.php');
        if (file_exists($path)) {
            $configArray = include $path;
            $dirPermission = $this->xpdo->getOption('dirPermission', $configArray, 0777);
            $packageNameLower = $this->xpdo->getOption('packageNameLower', $configArray, '');
            $targetRoot = $this->xpdo->getOption('targetRoot', $configArray, '');
            $subpackages = $this->xpdo->getOption('subpackages', $configArray, '');
            $sourceDir = $this->xpdo->getOption('core_path') . 'packages/';
            $targetCore = $targetRoot.'core/';
            $targetPackages = $targetCore.'packages/';

            if (is_array($subpackages) && !empty($targetRoot)) {
                $targetDir = $targetRoot . '_build/data/subpackages';
        
                if (!is_dir($targetCore)) {
                    mkdir($targetCore, $dirPermission, true);
                }
                if (!is_dir($targetPackages)) {
                    mkdir($targetPackages, $dirPermission, true);
                }                                 
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, $dirPermission, true);
                }
                foreach ($subpackages as $package) {
                    $filename = $package . '.transport.zip';
                    $source = $sourceDir . $filename;
                    $destination = $targetPackages . $filename;
                    if (file_exists($source)){
                    copy($source, $destination);
                    echo "SOURCE: " . $source . "\nDESTINATION: " . $destination . "<br />";                        
                    }
                    else{
                        echo "SOURCE: " . $source . ' does not exist <br />';    
                    }

                }
            }
        }
    }

    public function copyDir($source, $destination, $dirPermission) {
        $source = rtrim($source, '/');
        $destination = rtrim($destination, '/');
        echo "SOURCE: " . $source . "\nDESTINATION: " . $destination . "<br />";
        if (is_dir($source)) {
            if (!is_dir($destination)) {
                mkdir($destination, $dirPermission, true);
            }
            $objects = scandir($source);
            if (sizeof($objects) > 0) {
                foreach ($objects as $file) {
                    if ($file == "." || $file == ".." || $file == '.git' || $file == '.svn') {
                        continue;
                    }

                    if (is_dir($source . '/' . $file)) {
                        $this->copyDir($source . '/' . $file, $destination . '/' . $file, $dirPermission);
                    } else {
                        copy($source . '/' . $file, $destination . '/' . $file);
                    }
                }
            }
            return true;
        } elseif (is_file($source)) {
            return copy($source, $destination);
        } else {
            return false;
        }
    }

    public function createConfigFile() {
        $newProjectName = $this->get('packageName');
        $newProjectLower = strtolower($newProjectName);
        $paths = $this->initPaths();
        $props = array();
        require_once $paths['mycomponentCore'] . 'model/mycomponent/helpers.class.php';
        $props['mycomponentCore'] = $paths['myCore'];
        $helpers = new Helpers($this->xpdo, $props);
        $helpers->init();
        //$helpers->tplPath = $paths['myTplPath'];echo $paths['myTplPath'];
        $newTpl = $helpers->getTpl('migxexample.config.php');
        if (empty($newTpl)) {
            $this->set('errormessage', 'Could not find migxexample.config.php');
            return false;
        }
        $newTpl = str_replace('Example', $newProjectName, $newTpl);
        $newTpl = str_replace('example', $newProjectLower, $newTpl);
        $configDir = $this->xpdo->getOption('mc.root', null, $this->xpdo->getOption('core_path') . 'components/mycomponent/') . '_build/config/';
        if (!is_dir($configDir)) {
            $this->set('errormessage', 'Config directory does not exist');
            return false;
        }
        $configFile = $configDir . $newProjectLower . '.config.php';
        if (!file_exists($configFile)) {
            $fp = fopen($configFile, 'w');
            if ($fp) {
                fwrite($fp, $newTpl);
                fclose($fp);
            } else {
                $this->set('errormessage', 'Could not open new config file');
                return false;
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
        return true;
    }


}
