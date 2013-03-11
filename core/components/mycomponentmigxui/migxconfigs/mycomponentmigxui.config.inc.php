<?php

$action = $this->modx->getOption('action', $_REQUEST, '');
$object_id = $this->modx->getOption('object_id', $_REQUEST, '');

if ($action == 'mgr/migxdb/fields' && $object_id == 'new') {

    $tabs = '
[
{"caption":"Main", "fields": [
    {"field":"packageName","caption":"packageName","description":"No spaces, no dashes"}
]}
]
';
    $this->customconfigs['tabs'] = $this->modx->fromJson($tabs);

}
