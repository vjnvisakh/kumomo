<?php

    App::uses("AppController", "Controller");

    class HomesController extends AppController
    {
		//+TANUSHREE - KM1#COMMIT#2 - Set the name, uses variables
        public $name = "Homes";
        public $uses = array("Category"); 
		//+TANUSHREE - KM1#COMMIT#2 - Set the name, uses variables

        public function isAlive()
        {
            echo "Homes is alive at " . date("d-M-Y h:i:s");
            exit();
        }

        public function index()
        {
			header('Content-Type: text/html; charset=utf-8');
			//header("Content-Type: text/plain; charset=ISO-8859-1");
            $this -> layout = "main";

			//+TANUSHREE - KM1#COMMIT#2 - Getting the navbar elements from the database
			$navbarElements = $this -> getNavbar();    
			$this -> log($navbarElements, "LOG_DEBUG");
			$this -> set("navbarElements", $navbarElements);

			//print_r($navbarElements);
			//exit();
			//-TANUSHREE - KM1#COMMIT#2 - Getting the navbar elements from the database
        }
    }

    
?>