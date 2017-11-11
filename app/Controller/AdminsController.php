<?php

    App::uses("AppController","Controller");

    class AdminsController extends AppController
    {
        public function isAlive()
        {
            echo "Admins alive at ".date("d-M-Y h:i:s");
            exit();
        }

        // LOGIN PAGE OF THE ADMIN
        public function index()
        {
            $this -> layout = "main_admin";
        }
    }

?>