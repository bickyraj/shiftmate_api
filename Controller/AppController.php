<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	//public $components = array('Session','Auth');
     /*public $components = array(   'Session',
                                   'RequestHandler',
          );
     */
      public $components = array(
        'Session',
        'RequestHandler',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            )
        ),
        'Cookie'
    );

      public $uses = array('User');

       public function beforeFilter(){

        $this->response->header('Access-Control-Allow-Origin', '*');
        // $this->response->header('Location', 'http://shiftmate.com.au');
        // set cookie options
        $this->Cookie->key = 'qSI232qs*&sXOw!adre@34SAv!@*(XSL#$%)asGb$@11~_+!@#HKis~#^';
        $this->Cookie->httpOnly = true;

        $this->Auth->allow();

    }

	//var $timeStart = null;
	//public $method;
	
	/*public function beforeFilter(){
            if($this->RequestHandler->isPost()):
            $this->method="POST";
            elseif ($this->RequestHandler->isGet()): 
            $this->method="GET";
            elseif($this->RequestHandler->isPut()):
            $this->method="PUT";            
            endif;
            parent::beforeFilter();
    }*/
}
