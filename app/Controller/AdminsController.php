<?php

    App::uses("AppController","Controller");

    class AdminsController extends AppController
    {
        public $name = "Admins"; //TANUSHREE - KM#1COMMIT#2 - Set the name variable
        public $uses = array("Article","Ad","User","Category","ArticlesToCategory");

        public function isAlive()
        {
            echo "Admins alive at ".date("d-M-Y h:i:s");
            exit();
        }

        // LOGIN PAGE OF THE ADMIN
        public function index()
        {
            $this -> layout = "";
        }

        // CHECKING THE LOGINS
        public function login()
        {
            $this -> log("AdminsController -> login() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData,LOG_DEBUG);

            if(!empty($requestData))
            {
                $userName = $requestData["user"];
                $passWord = $requestData["pass"];

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
                
                if(!empty($userDetails))
                {
                    $this -> redirect(array("action" => "home"));
                }
                else 
                {
                    $this -> redirect(array("action" => "index"));    
                }                
            }
            
            $this -> log("AdminsController -> login() -> END:".microtime(true),LOG_DEBUG);            
        }

        // CHECKING THE LOGOUTS
        public function logout()
        {
            $this -> redirect
            (
                array
                (
                    "controller" => "admins",
                    "action" => "index"
                )
            );
        }

        // THE HOME PAGE
        public function home()
        {
            $this -> layout = "";

            $categories = $this -> getNavbar();
            $this -> set("categories", $categories);
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
                    if(!empty($article["articles"]["photo"]))
                    {
                        $tablerows .= "<td><a href='" . $this -> webroot . "images/articles/";
                        $tablerows .= $article["articles"]["photo"] . "'target=_blank>Click here to view image</a></td>";
                    } 
                    else 
                    {
                        $tablerows .= "<td>No image was attached</td>";
                    }
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
            $this -> log($requestData,  LOG_DEBUG);
            $this -> log($_FILES, LOG_DEBUG);

            if(!empty($requestData))
            {
                $articleData = json_decode($requestData["articleJSON"], true);
                
                $title = $articleData["title"];
                $categories = $articleData["categories"];
                $content = $articleData["content"];
                $caption = $articleData["caption"];

                $article["Article"]["title"] = $title;
                $article["Article"]["content"] = $content;

                $article["Article"]["photo"] = $this -> uploadPhoto($_FILES["tpic"], "articles");
                $article["Article"]["photo_caption"] = $caption;
                $article["Article"]["status"] = "active";

                $article["Article"]["created_by"] = 1;
                $article["Article"]["created"] = date("Y-m-d");
                $article["Article"]["modified"] = date("Y-m-d");

                $this -> log($article, LOG_DEBUG);
                
                $this -> Article -> create();
                $this -> Article -> save($article);

                $articleId = $this -> Article -> id;

                $index = 0;

                foreach($categories as $categoryId)
                {
                    $aToC[$index]["ArticlesToCategory"]["article_id"] = $articleId;
                    $aToC[$index]["ArticlesToCategory"]["category_id"] = $categoryId;

                    $index++;
                }

                $this -> ArticlesToCategory -> create();
                $this -> ArticlesToCategory -> saveMany($aToC);

                echo json_encode(1);
            }
            else 
            {
                
            }
            $this -> log("AdminsController -> addArticle() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }
        

        // ADD AN ADVERTISEMENT
        public function addAdvertisement()
        {
            $this -> log("AdminsController -> addAdvertisement() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData, LOG_DEBUG);
            $this -> log($_FILES, LOG_DEBUG);

            if(!empty($requestData))
            {
                $advertData = json_decode($requestData["advertJSON"], true);
                
                $alt = $advertData["alt"];
                $link = $advertData["link"];
                $position = $advertData["position"];

                $advert["Ad"]["alt"] = $alt;
                $advert["Ad"]["link"] = $link;

                $advert["Ad"]["photo"] = $this -> uploadPhoto($_FILES["tadPic"], "ads");
                $advert["Ad"]["position"] = $position;
                $advert["Ad"]["status"] = "active";

                $advert["Ad"]["clicks"] = 0;
                $advert["Ad"]["created"] = date("Y-m-d");
                $advert["Ad"]["modified"] = date("Y-m-d");

                $this -> log($advert, LOG_DEBUG);
                
                $this -> Ad -> create();
                $this -> Ad -> save($advert);
                
                // $talt = $requestData["talt"];
                // $tlink = $requestData["tlink"];
                // $tpos = $requestData["tpos"];
                // //$tpic = $requestData["tpic"];
                // $tpic = '';

                // $insertAd  = "";
                // $insertAd .= " INSERT INTO ads(alt,photo,link,clicks,position,status,created,modified)";
                // $insertAd .= " VALUES('".$talt."','".$tpic."','".$tlink."',0,$tpos,'active','".date("Y-m-d")."','".date("Y-m-d")."')";
                // $this -> Ad -> query($insertAd);

                echo json_encode(1);
            }
            else 
            {
                
            }

            $this -> log("AdminsController -> addAdvertisement() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        // THIS ACTION GETS ALL THE ADVERTISEMENTS IN THE DATABASE FOR THE ADMIN
        public function getAllAdvertisements()
        {
            $this -> log("AdminsController -> getAllAdvertisements() -> START:".microtime(true),LOG_DEBUG);

            if($this->isLoggedIn())
            {
                $getAllAdvertisements  = "";
                $getAllAdvertisements .= " SELECT * FROM ads ORDER BY ID DESC";
                $allAdvertisements = $this -> Ad -> query($getAllAdvertisements);

                $this -> log($allAdvertisements,LOG_DEBUG);

                $tablerows = "";
                $row = 1;

                foreach($allAdvertisements as $advertisement)
                {
                    $tablerows .= "<tr>";
                    $tablerows .= "<td>".$row."</td>";
                    $tablerows .= "<td>".$advertisement["ads"]["alt"]."</td>";
                    $tablerows .= "<td><a target='blank' href='".$advertisement["ads"]["link"]."'>".$advertisement["ads"]["link"]."</a></td>";    
                    if(!empty($advertisement["ads"]["photo"]))
                    {
                        $tablerows .= "<td><a href='" . $this -> webroot . "images/ads/";
                        $tablerows .= $advertisement["ads"]["photo"] . "'target=_blank>Click here to view image</a></td>";
                    } 
                    else 
                    {
                        $tablerows .= "<td>No image was attached</td>";
                    }
                    $tablerows .= "<td>".$advertisement["ads"]["position"]."</td>";
                    $tablerows .= "<td>".$advertisement["ads"]["clicks"]."</td>";                    
                    $tablerows .= "<td>".ucfirst($advertisement["ads"]["status"])."</td>";
                    $tablerows .= "<td>".$advertisement["ads"]["created"]."</td>";                    
                    $tablerows .= "<td><a href='#'><i class='fa fa-trash-o' aria-hidden='true'></i></a> | <a href='#'><i class='fa fa-eye-slash' aria-hidden='true'></i></a> | <a href='#'><i class='fa fa-pencil' aria-hidden='true'></i></a> </td>";
                    $tablerows .= "</tr>";
                    $row++;
                }

                echo json_encode($tablerows);
            }
            else 
            {
                
            }

            $this -> log("AdminsController -> getAllAdvertisements() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        // TO GET THE STATISTICS 
        public function stats()
        {
            $this -> log("AdminsController -> stats() -> START:".microtime(true),LOG_DEBUG);

            if($this->isLoggedIn())
            {
                $models = ["Article","Ad","Category","User"];
                $counters[0] = 'SELECT count(id) cnt FROM articles';
                $counters[1] = 'SELECT count(id) cnt FROM ads';
                $counters[2] = 'SELECT count(id) cnt FROM categories';
                $counters[3] = 'SELECT count(id) cnt FROM users';                

                for($i=0;$i<4;$i++)
                {
                    $counters[$i] = $this -> $models[$i] -> query($counters[$i]);
                }

                $this -> log($counters,LOG_DEBUG);
                echo json_encode($counters);
            }
            else 
            {
                $this -> redirect(array("action" => "index"));    
            }

            $this -> log("AdminsController -> stats() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        // ADD NEW CATEGORIES
        public function addCategory()
        {
            $this -> log("AdminsController -> stats() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData,LOG_DEBUG);

            if($this->isLoggedIn())
            {
                $parentId = $requestData["parent"];
                $title = $requestData["title"];
                $link = "";
                $position = 1;                

                $insertCategory  = "";
                $insertCategory .= " INSERT INTO categories(parent_id,title,link,position,status,created,modified)";
                $insertCategory .= " VALUES($parentId,'".$title."','".$link."',$position,'active','".date("Y-m-d")."','".date("Y-m-d")."')";
                $this -> Category -> query($insertCategory);
                
                echo json_encode(1);
            }
            else 
            {
                
            }

            $this -> log("AdminsController -> stats() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        // GET ALL THE CATEGORIES
        public function getAllCategories()
        {
            $this -> log("AdminsController -> getAllCategories() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData,  LOG_DEBUG);

            if($this->isLoggedIn())
            {
                $getAllCategories = " SELECT * FROM categories WHERE parent_id = 0 ORDER BY ID DESC";

                $categories = $this -> Category -> query($getAllCategories);

                $temp = "<ul class='list-group'>";

                foreach($categories as $category)
                {
                    $temp .= "<li class='list-group-item'><i class='fa fa-folder' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;".$category["categories"]["title"]."<a href='#' onclick='delCat(".$category["categories"]["id"].")' style='cursor:pointer;float:right'><i class='fa fa-minus-circle' aria-hidden='true'></i></a><a href='#' onclick='getAllSubCategories(".$category["categories"]["id"].")' style='cursor:pointer;float:right'><i class='fa fa-plus-square' aria-hidden='true'>&nbsp;&nbsp;&nbsp;</i></a></li>";
                }

                $temp .= "</ul>";

                echo json_encode($temp);
            }
            else 
            {
                $this -> redirect(array("action" => "index"));    
            }

            $this -> log("AdminsController -> getAllCategories() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        // TO DELETE A CATEGORY
        public function deleteCategory()
        {
            $this -> log("AdminsController -> getAllCategories() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData,  LOG_DEBUG);

            if($this->isLoggedIn())
            {
                $id = $requestData["id"];
                $deleteCat = " DELETE FROM categories WHERE id = $id OR parent_id = $id";
                $this -> Category -> query($deleteCat);
            }
            else 
            {
                $this -> redirect(array("action" => "index"));
            }

            $this -> log("AdminsController -> getAllCategories() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }

        public function getAllSubCategories()
        {
            $this -> log("AdminsController -> getAllCategories() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;

            if($this->isLoggedIn())
            {
                $catId = $requestData["id"];

                $getSubs = " SELECT * FROM categories WHERE parent_id = $catId";
                $subs = $this -> Category -> query($getSubs);

                $temp = "<ul class='list-group'>";

                foreach($subs as $sub)
                {   
                    $temp .= "<li class='list-group-item'><i class='fa fa-file-o' aria-hidden='true'></i>&nbsp;&nbsp;&nbsp;".$sub["categories"]["title"]."<a href='#' onclick='delSubCat(".$sub["categories"]["id"].")' style='cursor:pointer;float:right'><i class='fa fa-minus-circle' aria-hidden='true'></i></a></li>";
                }

                $temp .= "</ul>";
                
                echo json_encode($temp);
            }

            $this -> log("AdminsController -> getAllCategories() -> END:".microtime(true),LOG_DEBUG);
            exit();
        }
    }

?>