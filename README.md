# Dynamic Module Loader

I needed a means to dynamically wire modules into ZF2.  This overrides the ModuleManager to create a system where closure conditions can be used to modify the application config's module array.

Configuration is very simple, and is done in your **application.config.php**, not in your module config!

## Installation

```
composer require saeven/zf2-dynamic-modules
```


## application.config.php

```
return [

    'service_manager' => [
        'factories' => [
            'ModuleManager' => 'CirclicalModuleLoader\Service\Factory\ModuleManagerFactory',
        ],
    ],

    'modules_conditional' => [
        'SomeModule' => function(){ return true; }
    ],

    'modules' => [

        // usual modules

    ],

    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
        'module_paths' => [
            './module',
            './vendor',
        ],
    ],
];
```

The magic happens in the closure that accompanies the modules_conditional array.  Your closure would return true or false based on environment conditions.

> Todo - this was done to conditionally load modules based on route, and perhaps, based on database data.