<?php

$mcui_config = '
{
    "categories":{
        "type":"migx"
        ,"keyfield":"category"
    }
    ,"namespaces":{
        "type":"migx"
        ,"keyfield":"name"
    } 
    ,"menus":{
        "type":"migx"
        ,"keyfield":"MIGX_id"
        ,"subarrays":"action"
    }        
    ,"docs":{
        "type":"migx"
        ,"converttype":"simple"
    }
    ,"assetsDirs":{
        "type":"migx"
        ,"converttype":"key_value"
    }    
    ,"process":{
        "type":"arraylist"
    }
    ,"install_options":{
        "type":"fromdb_rename"
        ,"renameto":"install.options"
    }
    ,"readme_md":{
        "type":"fromdb_rename"
        ,"renameto":"readme.md"
    }
    ,"install.options":{
        "type":"todb_rename"
        ,"renameto":"install_options"
    }
    ,"readme.md":{
        "type":"todb_rename"
        ,"renameto":"readme_md"
    }               
}
';

return $mcui_config;
