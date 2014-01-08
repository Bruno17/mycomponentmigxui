<?php

$config = $modx->migx->customconfigs;

//todo: make this configurable
$tpl = $modx->getOption('iframeTpl',$scriptProperties,'default.html');

$tpl = $modx->getOption('core_path') .'components/mycomponentmigxui/migxtemplates/mgr/iframechunks/'.$tpl;

unset($_REQUEST['store_params']);

$modx->toPlaceholders($modx->migx->config,'migx_config');
$modx->toPlaceholders($_REQUEST,'request');

return $modx->migx->renderChunk($tpl);
