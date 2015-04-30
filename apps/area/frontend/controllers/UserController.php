<?php
namespace Area\Frontend\Controllers;
use Area\Frontend\Models\UserModel;
use Core\Entities\Users,
    Core\Entities,
    Core\Repositories,
    Core\ViewModels,
    Phalcon\Forms\Element\Text,
    Phalcon\Forms\Form,
    Frontend\Forms,
    Libraries\Mapper as Mapper;

//use \Modules\Models\Services\Services as Services;
/**
 * Class IndexController
 * @package Area\Frontend\Controllers
 * @Authorize
 */

class UserController extends ControllerBase
{

    protected $model;
    public function initialize()
    {
        $this->model = new UserModel($this);
    }

    public function indexAction()
    {
        $viewmodel = new ViewModels\UsersViewModel();
        $this->view->viewmodel = $this->model->getall(array($viewmodel));
    }

    /**
     * @param $id
     */
    public function editAction($id)
    {
        if(empty($id))
        {
            $this->view->disable();
            $this->response->redirect("user/index");
        }
        $viewmodel = new ViewModels\EditUserViewModel();
        $viewmodel = $this->model->getbyid($viewmodel, $id);

        if(empty($viewmodel))
        {
            $this->view->disable();
            $this->response->redirect("user/index");
        }
        $form = new Forms\EditUserForm($viewmodel);

        if($this->request->isPost()) {
            $form->bind($this->request->getPost(), $viewmodel);
            if($viewmodel->state())
            {
                $this->model->update($viewmodel);
                $this->model->save();
                $this->response->redirect("user/index");
            }
        }
        $this->view->form = $form;
        $this->view->viewmodel = $viewmodel;
    }
    public function deleteAction($id)
    {
        $this->view->disable();
        if(empty($id))
        {
            $this->response->redirect("user/index");

        }
        $this->model->delete($id);
        $this->model->save();
        $this->response->redirect("user/index");
    }

    public function createAction()
    {
        $form = new Forms\CreateUserForm();
        $viewmodel = new ViewModels\UsersViewModel();

        if($this->request->isPost())
        {
            $form->bind($this->request->getPost(), $viewmodel);
            $user = $this->model->get(new Users())
                ->findOneBy(array(
                            'username' => $viewmodel->username
                        ));
            if(!empty($user))
            {
                $viewmodel->setState(false , "Username already exist.");
            }

            if($viewmodel->state())
            {
                $viewmodel->password= $this->security->hash($viewmodel->password);
                $this->model->create($viewmodel);
                $this->model->save();
                $this->response->redirect("user/index");
            }
        }

        $this->view->form = $form;
        $this->view->viewmodel = $viewmodel;
    }
}