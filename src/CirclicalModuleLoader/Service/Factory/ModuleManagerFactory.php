<?php

/**
,,
`""*3b..											
     ""*3o.					  						10/16/15 10:18 AM
         "33o.			                  			S. Alexandre M. Lemaire
           "*33o.                                 	
              "333o.								Redistribution of these files is illegal.
                "3333bo...       ..o:
                  "33333333booocS333    ..    ,.
               ".    "*3333SP     V3o..o33. .333b
                "33o. .33333o. ...A33333333333333b
          ""bo.   "*33333333333333333333P*33333333:
             "33.    V333333333P"**""*"'   VP  * "l
               "333o.433333333X
                "*3333333333333AoA3o..oooooo..           .b
                       .X33333333333P""     ""*oo,,     ,3P
                      33P""V3333333:    .        ""*****"
                    .*"    A33333333o.4;      .
                         .oP""   "333333b.  .3;
                                  A3333333333P
                                  "  "33333P"
                                      33P*"
		                              .3"
                                     "
                                     
                                     
*/

namespace CirclicalModuleLoader\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Service\ModuleManagerFactory as ZendModuleManagerFactory;

class ModuleManagerFactory extends ZendModuleManagerFactory
{
    /**
     * {@inheritDoc}
     *
     * @return ModuleManager
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config      = $serviceLocator->get('ApplicationConfig');
        $manager     = parent::createService($serviceLocator);

        if( empty( $config['modules_conditional'] ) )
            return $manager;

        $modules = $manager->getModules();

        foreach( $config['modules_conditional'] as $name => $closure )
            if( !in_array( $name, $modules ) )
                $modules[] = $name;

        $manager->setModules($modules);

        return $manager;
    }
}