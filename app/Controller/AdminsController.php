<?php

    App::uses("AppController","Controller");

    class AdminsController extends AppController
    {
        public $name = "Admins"; //TANUSHREE - KM#1COMMIT#2 - Set the name variable
        public $uses = array("User");

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

        // CHECKING THE LOGINS
        public function login()
        {
            $this -> log("AdminsController -> login() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData,LOG_DEBUG);

            if(!empty($requestData))
            {
                $userName = $requestData["userName"];
                $passWord = $requestData["passWord"];

                $userDetails = $this -> User -> find
                (
                    "first", array
                    (
                        "conditions" => array
                        (
                            "User.user_name" => $userName,
                            "User.pass" => $passWord,
                            "User.status" => "active"
                        )
                    )
                );
                
                $this -> log($userDetails,LOG_DEBUG);
            }

            $this -> log("AdminsController -> login() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        // CHECKING THE LOGOUTS
        public function logout()
        {
            $this -> redirect
            (
                array
                (
                    "controller" => "admins"
                )
            );
        }

        //+TANUSHREE - KM1#COMMIT#2 - Storing the navbar elements into the database
        /**
         * Stores the navbar links into the database
         *
         * @return void
         * @throws NotFoundException When the view file could not be found
         *	or MissingViewException in debug mode.
        */

        public function setNavbar()
        {
            if(!empty($_POST["navbarJSON"]))
            {

            }
            else 
            {
                $existingNavbarElements = $this -> getNavbar();
                $this -> set("existingNavbarElements", $existingNavbarElements);
            }
        }
        //-TANUSHREE - KM1#COMMIT#2 - Storing the navbar elements into the database
    }

?>