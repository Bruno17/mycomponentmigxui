$folder = $modx->getOption('core_path') . '/packages/';
if (file_exists($folder)) {
    $dir = opendir($folder);
    $files = array();
    while ($file = readdir($dir)) {
        //checks that file is an image
        $extension = '.transport.zip';
        if ($file != '.' && $file != '..' && $file != 'core'.$extension && strstr($file, $extension)) {
            $files[] = str_replace($extension,'',$file);
        }
    }
    closedir($imgDir);
    asort($files);
    return implode('||',$files);
}