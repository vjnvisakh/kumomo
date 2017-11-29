<?php

    App::uses("AppController","Controller");

    class AdminsController extends AppController
    {
        public $name = "Admins"; //TANUSHREE - KM#1COMMIT#2 - Set the name variable
        public $uses = array("Article");

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

        // THE HOME PAGE
        public function home()
        {
            $this -> layout = "";
        }

        // THIS IS USED TO CHECK IF THE ADMIN IS LOGGED IN OR NOT
        public function isLoggedIn()
        {
            return(1);
        }

        // THIS ACTION GETS ALL THE ARTICLES IN THE DATABASE FOR THE ADMIN
        public function getAllArticles()
        {
            $this -> log("AdminsController -> getAllArticles() -> START:".microtime(true),LOG_DEBUG);

            if($this->isLoggedIn())
            {
                $getAllArticles  = "";
                $getAllArticles .= " SELECT * FROM articles ORDER BY ID DESC";
                $allArticles = $this -> Article -> query($getAllArticles);

                $this -> log($allArticles,LOG_DEBUG);

                $tablerows = "";
                $row = 1;

                foreach($allArticles as $article)
                {
                    $tablerows .= "<tr>";
                    $tablerows .= "<td>".$row."</td>";
                    $tablerows .= "<td>".$article["articles"]["title"]."</td>";
                    $tablerows .= "<td>".$article["articles"]["created_by"]."</td>";
                    $tablerows .= "<td>".substr($article["articles"]["content"],0,70).". . .</td>";    
                    $tablerows .= "<td>".$article["articles"]["photo"]."</td>";
                    $tablerows .= "<td>".$article["articles"]["created"]."</td>";
                    $tablerows .= "<td>".ucfirst($article["articles"]["status"])."</td>";
                    $tablerows .= "<td><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a> | <a href='#'><i class='fa fa-eye-slash' aria-hidden='true'></i></a> | <a href='#'><i class='fa fa-pencil' aria-hidden='true'></i></a> </td>";
                    $tablerows .= "</tr>";
                    $row++;
                }

                echo json_encode($tablerows);
            }
            else 
            {
                
            }

            $this -> log("AdminsController -> getAllArticles() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        // THIS ACTION IS USED TO ADD A NEW ARTICLE TO THE DATABASE
        public function addArticle()
        {
            $this -> log("AdminsController -> addArticle() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData,LOG_DEBUG);

            if(!empty($requestData))
            {
                $title = $requestData["ttitle"];
                $category = $requestData["tcat"];
                $pic = $requestData["tpic"];
                $content = $requestData["ttext"];

                $insertArticle  = "";
                $insertArticle .= " INSERT INTO articles(title,content,photo,status,created_by,created,modified)";
                $insertArticle .= " VALUES('".$title."','".$content."','".$pic."','active',1,'".date("Y-m-d")."','".date("Y-m-d")."')";
                $this -> Article -> query($insertArticle);

                echo json_encode(1);
            }
            else 
            {
                
            }
            $this -> log("AdminsController -> addArticle() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }
    }

?>