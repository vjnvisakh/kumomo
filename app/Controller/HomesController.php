<?php

    App::uses("AppController", "Controller");

    class HomesController extends AppController
    {
		//+TANUSHREE - KM1#COMMIT#2 - Set the name, uses variables
        public $name = "Homes";
        public $uses = array("Category","CommentsToArticle"); 
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
            //$articleList = $this -> getArticlesByCategory();

            $this -> set("navbarElements", $navbarElements);
            $this -> set("adList", $adList);
            //$this -> set("articleList", $articleList);
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

        /**
        * This action is used to comment on a article
        * @param - <name> [name of the person who has commented]
        * @param - <email> [email of the person who has commented]
        * @param - <articleId> [article id of the article on which the comments are made]
        * @author - Visakh Vijayan
        * @since - 09-Dec-2017     
        *   
        **/
        public function commentOnArticle()
        {
            $this -> log("HomesController -> commentOnArticle() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;
            $this -> log($requestData,LOG_DEBUG);

            if(!empty($requestData))
            {
                // Arranging the post data into a model
                $commentArr["name"] = $requestData["name"];
                $commentArr["article_id"] = $requestData["articleId"];
                $commentArr["email"] = $requestData["email"];
                $commentArr["comment"] = $requestData["comment"];
                $commentArr["created"] = date("Y-m-d h:i:s");
                $commentArr["status"] = "active";

                // Saving the data into the table
                $this -> CommentsToArticle -> create();
                $this -> CommentsToArticle -> save($commentArr);
            }
            else
            {

            }

            $this -> log("HomesController -> commentOnArticle() -> START:".microtime(true),LOG_DEBUG);
            exit();
        }

        /**
        * This action is used to fetch all the comments related to an article
        * It takes it according to the date last posted on
        * @param - <articleId> [id of the article for which the comments are required]
        * @author - Visakh Vijayan
        * @since - 09-Dec-2017        
        *
        **/
        public function fetchArticleComments()
        {
            $this -> log("HomesController -> commentOnArticle() -> START:".microtime(true),LOG_DEBUG);
            $requestData = $this -> request -> data;            
            $this -> layout = "";

            if(!empty($requestData))
            {
                $articleId = $requestData["articleId"];

                $comments = $this -> CommentsToArticle -> find
                (
                    "all",array
                    (
                        "conditions" => array
                        (
                            "article_id" => $articleId,
                            "status" => "active"
                        ),
                        "order" => array
                        (
                            "created" => "desc"
                        )
                    )
                );

                $this -> set("COMMENTS",$comments);
            }
            else
            {

            }

            $this -> render("/Elements/comment_on_article");
            $this -> log("HomesController -> commentOnArticle() -> END:".microtime(true),LOG_DEBUG);
        }
    }

    
?>