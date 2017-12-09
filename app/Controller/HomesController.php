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

        // THIS ACTION IS USED TO VIEW THE ARTICLE
        public function article($articleId)
        {   
            $this -> layout = "article_layout";

            $getArticles  = "";
            $getArticles .= " SELECT * FROM articles WHERE id = $articleId";
            $article = $this -> Article -> query($getArticles);

            $this -> set("ID",$article[0]["articles"]["id"]);
            $this -> set("TITLE",$article[0]["articles"]["title"]);
            $this -> set("CONTENT",$article[0]["articles"]["content"]);
            $this -> set("CREATED",$article[0]["articles"]["created"]);
            $this -> set("PIC",$article[0]["articles"]["photo"]);
        }

        // THIS ACTION IS USED TO FETCH THE RELATED ARTICLES FOR AN ARTICLE
        public function fetchRelatedArticles()
        {
            $this -> log("HomesController -> fetchRelatedArticles() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;

            if(!empty($requestData))
            {
                $id = $requestData["id"];

                $getCategory  = "";
                $getCategory .= " SELECT category_id FROM articles_to_categories WHERE article_id = $id";
                $categoryId = $this -> Article -> query($getCategory);

                $categoryId = $categoryId[0]["articles_to_categories"]["category_id"];

                // SELECT THE RELATED ARTICLES
                $getArticles  = " SELECT * FROM articles a INNER JOIN articles_to_categories atc";
                $getArticles .= " ON a.id = atc.article_id and atc.category_id = $categoryId";
                $getArticles .= " AND a.id <> $id";

                $articles = $this -> Article -> query($getArticles);

                $articlesArray = [];
                $i = 0;

                $temp = "";

                foreach($articles as $article)
                {
                    $temp .= "<div>";
                    $temp .= "<h2>".$article["a"]["title"]."</h2>";
                    // $articlesArray[$i]["id"] = $article["a"]["id"];
                    // $articlesArray[$i]["title"] = $article["a"]["title"];
                    // $articlesArray[$i]["content"] = $article["a"]["content"];
                    // $articlesArray[$i]["photo"] = $article["a"]["photo"];
                    // $articlesArray[$i]["photo_caption"] = $article["a"]["photo_caption"];                    
                    $temp .= "</div>";
                    $i++;
                }

                echo json_encode($temp);
            }

            $this -> log("HomesController -> fetchRelatedArticles() -> START:".microtime(true),LOG_DEBUG);
            exit();
        }
    }

    
?>