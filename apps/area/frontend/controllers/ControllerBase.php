<?php
namespace Area\Frontend\Controllers;

use Phalcon\Mvc\Controller,
    Phalcon\Mvc\Dispatcher;

/**
 * Class ControllerBase
 * @package Area\Frontend\Controllers
 *
 */
class ControllerBase extends Controller
{
    public $identity;
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        $this->identity = $this->authorization->getIdentity();
        $reflection = new \ReflectionClass(get_class($this)); //get_class_vars( get_class($this) );
        $properties = array_filter($reflection->getProperties(\ReflectionProperty::IS_PUBLIC), function($prop) use($reflection){
            //$prop->getDeclaringClass()->getName()
            return  get_class($this) == $reflection->getName();
        });
        // send public properties to view
        foreach($properties as $prop => $val)
        {
            $name=$val->name;
            $this->view->{$name} = $this->{$name};
        }

    }

    protected function contentLeftHome()
    {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir( $this->view->getViewsDir() );
        $view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);

        $view->start();
        $view->render('shared', 'content-left-home');  //view folder/<file>.phtml
        $view->finish();
        $this->view->content_left =  $view->getContent();
    }

    protected function contentLeftAgenda()
    {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir( $this->view->getViewsDir() );
        $view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);

        $view->start();
        $view->render('shared', 'content-left-agenda');  //view folder/<file>.phtml
        $view->finish();
        $this->view->content_left =  $view->getContent();
    }

    protected function contentRight()
    {
        $view = new \Phalcon\Mvc\View();
        $view->setViewsDir($this->view->getViewsDir());
        $view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_LAYOUT);

        $view->start();
        $view->render('shared', 'content-right');  //view folder/<file>.phtml
        $view->finish();
        $this->view->content_right =  $view->getContent();

        $url_array =  explode('/', $_SERVER['REQUEST_URI']);
        $url = end($url_array);
        $url_link_array = explode('.', $url);

        /*
        $description_link = $url_link_array[0];
        $description_style = '';

        switch($description_link){
            case '':
                $dlink = 'how-home.php';
                break;
            case 'index':
                $dlink = 'how-home.php';
                break;
            case 'agenda':
                $dlink = 'how-agenda.php';
                break;
            case 'buy-credits':
                $dlink = 'how-buy.php';
                break;
            default:
                $description_style = 'display:none;';
        }


        $video_link = $url_link_array[0];

        switch($video_link){
            case 'agenda':
                $vlink = '<a href="video/Agenda.mov"><img class="video-link" src="public/img/banner-video-icon.png"></a>';
                break;
            case 'buy-credits':
                $vlink = '<a href="video/Uren kopen.mov"><img class="video-link" src="public/img/banner-video-icon.png"></a>';
                break;
            default:
                $vlink = '<img class="video-link" src="public/img/banner-video-icon.png">';
        }

        $view->vlink = $vlink;


   */
    }
}