<?php
namespace Libraries;

use Core\Entities\Users;
use Core\ViewModels\BaseViewModel;

class AnnotationsInitializer extends \Phalcon\Mvc\User\Plugin
{
    /**
     * This event is executed before every route is executed in the dispatcher
     */
    public function beforeExecuteRoute($event, $dispatcher)
    {
        $reflection = new \ReflectionClass(
            $dispatcher->getActiveController()
        );
        $parent = $reflection->getParentClass();

        if($parent !== false)
        {
            $parentName = $parent->getName();
            $reflector = $this->annotations->get(
                $parentName
            );
            $annotations = $reflector->getClassAnnotations();

            if($annotations !== false)
            {
                foreach ($annotations as $annotation)
                {
                    $this->annotationCollection($annotation);
                }
            }
        }

        $reflector = $this->annotations->get(
            $dispatcher->getActiveController()
        );
        $annotations = $reflector->getClassAnnotations();

        if($annotations !== false)
        {
            foreach ($annotations as $annotation)
            {
                $this->annotationCollection($annotation);
            }
        }

        //@BUG: getControllerClass() throws call to to undefined method gethandlername

        //Parse the annotations in the method currently executed
        $annotationsMethod = $this->annotations->getMethod(
            get_class($dispatcher->getActiveController()),
            $dispatcher->getActiveMethod()
        );

        // Method level
        //Check if the method has an annotation 'Cache'
       if ($annotationsMethod->has('Authorize'))
       {
           //die('Authorize');
           //The method has the annotation 'Authorize'
           $annotation = $annotations->get('Authorize');
           $roles = $annotation->getNamedParameter('Roles');
            $options = array('roles' => $roles);
       /*
                   //Check if there is an user defined cache key
                   if ($annotation->hasNamedParameter('key')) {
                       $options['key'] = $annotation->getNamedParameter('key');
                   }
       */
            //Enable the cache for the current method
            //$this->view->cache($options);
       }

    }

    private function annotationCollection($annotation)
    {
        switch ($annotation->getName())
        {
            case 'Authorize':
                $authorize = new Authorization();
                $authorize->authorize();
                break;
        }
    }
}