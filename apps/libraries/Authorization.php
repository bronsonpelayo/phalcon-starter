<?php
namespace Libraries;
use Phalcon\Mvc\User\Component;
use Core\Entities\Users;
use Core\Repositories\UsersRepository;

class Authorization extends Component
{
    /**
     * Checks the user credentials
     *
     * @return boolan
     */
    protected  $repo;

    public function __construct()
    {
        $this->repo = new UsersRepository();
    }
    public function byUsername($username, $password)
    {
        $users = new Users();
        $user = $this->repo->get($users)
                ->findOneBy(array(
                    'username' => $username
                ));
        if($user !== false)
        {
            if (!$this->security->checkHash($password, $user->password))
            {
                //$this->registerUserThrottling($user->id);
                //throw new \Exception('Wrong user/password combination');
                $this->remove();
                return false;
            }

            $this->session->set('auth-identity', array(
                'id' => $user->id,
                'name' => $user->firstname
            ));
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isAuthorize()
    {
        if($this->getIdentity() === null)
        {
            return false;
        }else{
            $identity = $this->session->get('auth-identity');
            if(empty($identity['id']))
            {
                return false;
            }
            return true;
        }
    }

    /**
     * void
     */
    public function authorize()
    {
        if(!$this->isAuthorize()) {
            $this->response->redirect('index/logout');
        }
    }
    /**
     * Removes the user identity information from session
     */
    public function remove()
    {
        $this->session->remove('auth-identity');
    }

    /**
     * Returns the current identity
     *
     * @return null|array
     */

    public function getIdentity()
    {
        $identity = $this->session->get('auth-identity');

        if(empty($identity))
        {
            return;
        }

        $user = new Users();
        $user = $this->repo->getbyid($user,$identity['id']);
        if(empty($user))
        {
            return;
        }
        return $this->session->get('auth-identity');
    }
}