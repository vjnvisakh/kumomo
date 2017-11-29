<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
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

	
class AppController extends Controller 
{
	//+TANUSHREE - KM1#COMMIT#2 - Set the name, uses variables, Added the getNavbar function
    public $name = "App";
    public $uses = array("Category", "User", "Feedback", "Ad", "Article");
	
	/**
	 * This method returns the list of navbar links from the database
	 *
	 * @return array of Navbar links
	 */

    public function getNavbar()
    {
        $navbarQuery = "";
        $navbarQuery .= "SELECT id, parent_id, title, link, position FROM categories";
        $navbarQuery .= " WHERE status = 'active' order by parent_id, position";

        $navbarResult = $this -> Category -> query($navbarQuery);

        return $navbarResult;
	}
	//-TANUSHREE - KM1#COMMIT#2 - Set the name, uses variables, Added the getNavbar function
}
