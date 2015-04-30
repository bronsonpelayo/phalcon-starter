<?php
namespace Area\Frontend\Controllers;
use Core\Entities\User as EntityUser,
    Core\Entities,
    Core\Repositories;
use Core\ViewModels\LoginViewModel;
use Frontend\Forms\LoginForm;

//use \Modules\Models\Services\Services as Services;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        $form= new LoginForm();
        $viewmodel = new LoginViewModel();
        if ($this->request->isPost())
        {
            $form->bind($this->request->getPost(), $viewmodel);

            if( $viewmodel->state())
            {
                if($this->authorization->byUsername(
                    $viewmodel->username, $viewmodel->password
                    ))
                {
                    $this->response->redirect('user');
                    $this->view->disable();
                    return;
                }else{
                    $viewmodel->setState(false,"Invalid username/password") ;
                }
            }
        }

        $this->view->form =  $form;
        $this->view->viewmodel =  $viewmodel;
    }

    public function logoutAction()
    {
        $this->authorization->remove();
        $this->response->redirect('index');
        $this->view->disable();
        return;
    }
}