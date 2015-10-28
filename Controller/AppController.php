<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
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
    public $components = array(
        'Session',
        'Auth' => array(
            'loginAction' => '/users/login',
            'authError' => 'Ban phai dang nhap',
            'flash' => array(
                'element' => 'default',
                'key' => 'auth',
                'params' => array('class' => 'alert alert-danger')
            ),
            'loginRedirect' => '/books/index',
			'logoutRedirect' => 'users/login'
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('menu', 'view', 'index', 'lastest_books', 'add_to_cart', 'view_cart', 'empty_cart', 'update', 'remove','get_keyword','search');
        $this->set('user_info', $this->get_user());
    }

    public function get_user() {
        if($this->Auth->login()) {
            return $this->Auth->user();
        }
    }

}
