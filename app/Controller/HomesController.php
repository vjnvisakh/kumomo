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
			$this -> layout = "";
        }
    }

    
?>