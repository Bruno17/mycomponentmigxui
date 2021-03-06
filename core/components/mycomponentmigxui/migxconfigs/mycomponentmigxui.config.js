{
  "id":61,
  "name":"mycomponentmigxui",
  "formtabs":[
    {
      "MIGX_id":1,
      "caption":"Main",
      "fields":[
        {
          "MIGX_id":2,
          "field":"packageDescription",
          "caption":"Description",
          "inputTV":"",
          "inputTVtype":"textarea",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":3,
          "field":"version",
          "caption":"Version",
          "description":"for Example 1.0.0",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":4,
          "field":"release",
          "caption":"Release",
          "description":"beta1,beta2,beta3,pl",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":7,
          "field":"author",
          "caption":"Author",
          "description":"",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":8,
          "field":"email",
          "caption":"Email",
          "description":"",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":9,
          "field":"authorUrl",
          "caption":"AuthorUrl",
          "description":"",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":10,
          "field":"authorSiteName",
          "caption":"AuthorSiteName",
          "description":"",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":11,
          "field":"packageDocumentationUrl",
          "caption":"Package Documentation Url",
          "description":"",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":12,
          "field":"copyright",
          "caption":"Copyright Year",
          "description":"",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":5,
          "field":"gitHubUsername",
          "caption":"gitHubUsername",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":6,
          "field":"gitHubRepository",
          "caption":"gitHubRepository",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":13,
          "field":"primaryLanguage",
          "caption":"Primary Language Code",
          "description":" two-letter code of your primary language",
          "inputTV":"",
          "inputTVtype":"",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        }
      ]
    },
    {
      "MIGX_id":3,
      "caption":"Settings",
      "fields":[
        {
          "MIGX_id":1,
          "field":"process",
          "caption":"Process",
          "description":"Array of elements to export. All elements set below will be handled.<br \/>\nTo export resources, be sure to list pagetitles and\/or IDs of parents of desired resources",
          "inputTV":"",
          "inputTVtype":"listbox-multiple",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"contexts||snippets||plugins||templateVars||templates||chunks||resources||propertySets||systemSettings||contextSettings||systemEvents||menus",
          "default":""
        },
        {
          "MIGX_id":2,
          "field":"allStatic",
          "caption":"All Static",
          "description":"will make all element objects static - 'static' field above will be ignored",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        },
        {
          "MIGX_id":4,
          "field":"assetsDirs",
          "caption":"Asset Direcories",
          "description":"Define optional directories to create under assets.\nAdd your own as needed.\nSet to true to create directory.\nSet to hasAssets = false to skip.\nEmpty js and\/or css files will be created.",
          "inputTV":"",
          "inputTVtype":"migx",
          "configs":"mcuiassetsdirs",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":3,
          "field":"hasAssets",
          "caption":"Has Assets Directory",
          "description":"",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        },
        {
          "MIGX_id":5,
          "field":"minifyJS",
          "caption":"Minify Js",
          "description":"minify any JS files",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        },
        {
          "MIGX_id":6,
          "field":"hasCore",
          "caption":"Has Core",
          "description":"",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        },
        {
          "MIGX_id":7,
          "field":"install_options",
          "caption":"install.options",
          "description":"(optional) install.options is needed if you will interact\nwith user during the install.\nSee the user.input.php file for more information.\nSet this to 'install.options' or ''\nThe file will be created as _build\/install.options\/user.input.php\nDon't change the filename or directory name. ",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"yes==install.options||no==",
          "default":""
        },
        {
          "MIGX_id":8,
          "field":"dryRun",
          "caption":"Dry Run",
          "description":"ExportObjects will update existing files. If you set dryRun\nto '1', ExportObjects will report what it would have done\nwithout changing anything. Note: On some platforms,\ndryRun is *very* slow",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        }
      ]
    },
    {
      "MIGX_id":2,
      "caption":"Categories",
      "fields":[
        {
          "MIGX_id":1,
          "field":"categories",
          "caption":"Categories",
          "inputTV":"",
          "inputTVtype":"migx",
          "configs":"mcuicategories",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        }
      ]
    },
    {
      "MIGX_id":4,
      "caption":"Docs",
      "fields":[
        {
          "MIGX_id":1,
          "field":"docs",
          "caption":"Docs",
          "description":"Define basic directories and files to be created in project",
          "inputTV":"",
          "inputTVtype":"migx",
          "configs":"mcuidocs",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":2,
          "field":"readme_md",
          "caption":"readme.md",
          "description":"(optional) Description file for GitHub project home page",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        }
      ]
    },
    {
      "MIGX_id":5,
      "caption":"Export Resources",
      "fields":[
        {
          "MIGX_id":1,
          "field":"getResourcesById",
          "caption":"Get Resources by ID",
          "description":"Resources can be specified by pagetitle or ID, but you must use the same method\nfor all settings and specify it here. \nImportant: use IDs if you have duplicate pagetitles",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        },
        {
          "MIGX_id":2,
          "field":"exportResources",
          "caption":"Export - Resourcelist",
          "description":"List of resources to process. delimited by ||",
          "inputTV":"",
          "inputTVtype":"textarea",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":3,
          "field":"parents",
          "caption":"Export - Subresources of Containers",
          "description":"List of resource-parent-IDs to process. delimited by ||",
          "inputTV":"",
          "inputTVtype":"textarea",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":4,
          "field":"includeParents",
          "caption":"Include Parents",
          "description":"Also export the listed parent resources\n(set to false to include just the children)",
          "inputTV":"",
          "inputTVtype":"listbox",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"No==0||Yes==1",
          "default":""
        }
      ]
    },
    {
      "MIGX_id":6,
      "caption":"System",
      "fields":[
        {
          "MIGX_id":1,
          "field":"namespaces",
          "caption":"Namespaces",
          "description":"(optional) Typically, there's only one namespace which is set\nto the $packageNameLower value. Paths should end in a slash",
          "inputTV":"",
          "inputTVtype":"migx",
          "configs":"mcuinamespaces",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        },
        {
          "MIGX_id":2,
          "field":"menus",
          "caption":"Menus",
          "description":"If your extra needs Menus, you can create them here\nor create them in the Manager, and export them with exportObjects.\nBe sure to set their namespace to the lowercase package name\nof your extra.",
          "inputTV":"",
          "inputTVtype":"migx",
          "configs":"mcuimenus",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"",
          "default":""
        }
      ]
    },
    {
      "MIGX_id":7,
      "caption":"Export Subpackages",
      "fields":[
        {
          "MIGX_id":1,
          "field":"subpackages",
          "caption":"Subpackages",
          "description":"",
          "inputTV":"",
          "inputTVtype":"listbox-multiple",
          "configs":"",
          "sourceFrom":"config",
          "sources":"",
          "inputOptionValues":"@EVAL return $modx->runSnippet('migxGetPackageFilelist);",
          "default":""
        }
      ]
    }
  ],
  "contextmenus":"remove",
  "actionbuttons":"addItem",
  "columnbuttons":"update||runmycomponent",
  "filters":[
    {
      "MIGX_id":1,
      "name":"search",
      "label":"search",
      "emptytext":"search...",
      "type":"textbox",
      "getlistwhere":{
        "packageName:LIKE":"%[[+search]]%"
      },
      "getcomboprocessor":"",
      "combotextfield":"",
      "comboidfield":"",
      "comboparent":""
    }
  ],
  "extended":{
    "migx_add":"New Component",
    "formcaption":"Component [[+packageName]]",
    "update_win_title":"MyComponentMigxUI",
    "win_id":"mycomponentmigxui",
    "multiple_formtabs":"",
    "extrahandlers":"",
    "packageName":"mycomponentmigxui",
    "classname":"mcuiConfig",
    "task":"",
    "getlistsort":"",
    "getlistsortdir":"",
    "use_custom_prefix":"0",
    "prefix":"",
    "grid":"",
    "gridload_mode":1,
    "check_resid":1,
    "check_resid_TV":"",
    "join_alias":"",
    "getlistwhere":"",
    "joins":"",
    "cmpmaincaption":"MyComponent UI",
    "cmptabcaption":"MyComponent",
    "cmptabdescription":"Manage MyComponent Projects here",
    "cmptabcontroller":""
  },
  "columns":[
    {
      "MIGX_id":1,
      "header":"ID",
      "dataIndex":"id",
      "width":10,
      "sortable":true,
      "show_in_grid":"0",
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":""
    },
    {
      "MIGX_id":2,
      "header":"packageName",
      "dataIndex":"packageName",
      "width":20,
      "sortable":true,
      "show_in_grid":1,
      "renderer":"this.renderRowActions",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":""
    },
    {
      "MIGX_id":3,
      "header":"Version",
      "dataIndex":"version",
      "width":10,
      "sortable":"false",
      "show_in_grid":1,
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":""
    },
    {
      "MIGX_id":4,
      "header":"Release",
      "dataIndex":"release",
      "width":10,
      "sortable":"false",
      "show_in_grid":1,
      "renderer":"",
      "clickaction":"",
      "selectorconfig":"",
      "renderoptions":""
    }
  ],
  "createdby":0,
  "createdon":"2013-03-06 01:00:00",
  "editedby":1,
  "editedon":"2013-03-20 06:58:15",
  "deleted":0,
  "deletedon":"-1-11-30 00:00:00",
  "deletedby":0,
  "published":1,
  "publishedon":"2013-03-06 01:00:00",
  "publishedby":0
}