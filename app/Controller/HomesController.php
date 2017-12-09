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
			$this -> layout = "";
			$navbarElements = $this -> getNavbar();    
            $adList = $this -> getAdContentBySpaces();
            $articleList = $this -> getArticlesByCategory();

            $this -> set("navbarElements", $navbarElements);
            $this -> set("adList", $adList);
            $this -> set("articleList", $articleList);
			// print_r($navbarElements);
			// exit();
        }
    }

    
?>