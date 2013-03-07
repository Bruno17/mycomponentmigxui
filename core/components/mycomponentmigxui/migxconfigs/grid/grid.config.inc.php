<?php


$gridcontextmenus['runmycomponent']['code']="
        m.push({
            className : 'runmycomponent', 
            text: 'Project Actions',
            handler: 'this.runmycomponent'
        });
        m.push('-');
";
$gridcontextmenus['runmycomponent']['handler'] = 'this.runmycomponent';


$gridfunctions['this.runmycomponent'] = "
runmycomponent: function(btn,e) {
        var object_id = this.menu.record.id;
        var tpl = 'mycomponenttemplate.html';
        var action = 'u';
		this.loadIframeWin(btn,e,tpl,action);
	}    	
";

