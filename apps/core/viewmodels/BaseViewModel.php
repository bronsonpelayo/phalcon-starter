<?php

namespace Core\ViewModels;
use Phalcon\Validation;

/**
 * Class BaseViewModel
 * @package Core\ViewModels
 */
class BaseViewModel extends Validation
{
    public $errorcode = 0;
    protected $_messages;
    protected $_message;
    private $_state = true;

    /**
     * @return bool
     */
    protected function validateModel()
    {
        $this->_messages = $this->validate($this);

        if($this->_state)
        {
            if (count($this->_messages) == 0) {
                //$this->_messages = $messages;
                $this->_state = true;
            }else{
                $this->_state = false;
            }
        }

        return $this->_state ;
    }

    /**
     * @param $state
     * @param $message
     */
    public function setState($state, $message)
    {
        if(!is_bool($state))
        {
            die("setSate");
        }
        $this->_message = $message;
        $this->_state = $state;
    }

    /**
     * @return bool
     */
    public function state()
    {
        return $this->validateModel();
    }

    /**
     * @param $field
     * @return string
     */
    public function getMessageFor($field)
    {

        if (count($this->_messages) > 0)
        {
            foreach ($this->getMessages() as $message)
            {
                if($message->getField() === $field)
                {
                    return $message->getMessage();
                }
            }
        }

        return "";
    }

    /**
     * @param $field
     * @return string
     */
    public function getDecoratedMessageFor($field)
    {
        $message = $this->getMessageFor($field) ;
        if(empty($message))
        {
            return "";
        }
        return '<small class="error">'. $message.'</small>';
    }

    /**
     * @return string
     */
    public function getModelMessages()
    {
        $messages = array();
        if(!empty($this->_message))
        {
            array_push($messages,$this->_message) ;
        }

        if (count($this->_messages) > 0)
        {

            foreach ($this->getMessages() as $message)
            {

                array_push($messages,$message->getMessage()) ;
            }
        }

        if(empty($messages))
        {
            return "";
        }

        return  "<ul><li>" . implode("</li><li>", $messages) . "</li></ul>";;
    }

    /**
     * @return string
     */
    public function getDecoratedMessage()
    {
        if(empty($this->_message))
        {
            return "";
        }
        return '<small class="error">'. $this->_message.'</small>';
    }
}