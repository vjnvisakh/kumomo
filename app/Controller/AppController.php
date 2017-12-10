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
    public $uses = array("Category", "User", "Feedback", "Ad", "Article", "ArticlesToCategory");
	
	/**
     * CULPRIT CAUGHT RED HANDED # 1
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
    
    protected function uploadPhoto($photo, $folderName)
	{
		ini_set("memory_limit", "-1");
  		set_time_limit(0);
		
		if(empty($photo)) 
		{
			return "";
		}

		$photoData = array();
		$typesArray = array
		(
			"jpg", "jpeg", "gif", "png", "bmp", "webp"
		);

        if(!empty($photo["error"])) 
        {
            return "";
        }
                            
        $fileParts = pathinfo($photo["name"]);
        if(!in_array(strtolower($fileParts["extension"]), $typesArray)) 
        {
            return "";
        }

        $imageType = $photo["type"];
        $extensionArray = explode(".", $photo["name"]);
		$extension = array_pop($extensionArray);
            
        $fileName = "kk_" . base64_encode(microtime()) . "_" . rand(1, 10000) . "." . $extension;

		$uploadTarget = "images/" . $folderName . "/";
        $uploadTarget = $uploadTarget . $fileName;
        
        if(move_uploaded_file($photo["tmp_name"], $uploadTarget)) 
        {
            return $fileName;
        }

        return "";
    }
    
    public function getAdContentBySpaces($space = "all")
    {
        if($space == "all")
        {
            $adQuery = "";

            //Displays the newest ads per space
            // $adQuery .= "SELECT * FROM ads WHERE id IN (SELECT MAX(id) AS id FROM ads GROUP BY `position`)";

            //Displays the ads which have the minimum clicks per spaces
            $adQuery .= "SELECT a.* FROM (SELECT `position`, MIN(clicks) AS minclicks FROM ads";
            $adQuery .= " GROUP BY `position`) AS x INNER JOIN ads AS a";
            $adQuery .= " ON a.`position` = x.`position` AND a.clicks = x.minclicks;";
        }
        else
        {
            $adQuery = "";
            $adQuery .= "SELECT * FROM ads as a WHERE `position`= $space ORDER BY id DESC LIMIT 1";
        }

        $adResult = $this -> Ad -> query($adQuery);
        $adList = array();
        if(!empty($adResult))
        {
            foreach($adResult as $ad)
            {
                $ad = $ad["a"];
                $position = intval($ad["position"]);
                $adList[$position] = $ad;
            }
        }

        return $adList;
    }

    public function getArticlesByCategory($category = "all")
    {
        $articleList = array();

        if($category == "all")
        {
            $categoryQuery = "";

            //$categoryQuery = "SELECT id from categories as c where status='active'";

            $categoryQuery .= "SELECT count(*) AS cnt, atoc.category_id FROM articles_to_categories as atoc where atoc.status = 'active'";
            $categoryQuery .= " GROUP BY atoc.category_id ORDER BY cnt";
            $categoryList = $this -> Category -> query($categoryQuery);

            $fetchedArticles = "0";

            //+ VISAKH - 09-Dec-2017 - KM# - To fetch the last update time of the site
            $lastUpdatedOn = "";

            foreach($categoryList as $category)
            {
                $cId = $category["atoc"]["category_id"];

                $articleQuery = "";
                $articleQuery .= " select * from articles as a inner join articles_to_categories as atoc";
                $articleQuery .= " on a.id = atoc.article_id where atoc.category_id = $cId";
                $articleQuery .= " and a.id not in ($fetchedArticles) and a.status='active' order by a.id desc limit 1";

                $articleResult = $this -> Article -> query($articleQuery);

                //  pr($articleQuery);
                 
                if(!empty($articleResult))
                {
                    //+ VISAKH - 09-Dec-2017 - KM#
                    if($lastUpdatedOn == "")
                    {
                        $lastUpdatedOn = $articleResult[0]["a"]["created"];
                    }
                    //- VISAKH - 09-Dec-2017 - KM#

                    // pr($articleResult);
                    $fetchedArticles .= "," . $articleResult[0]["a"]["id"];
                    $articleList[] = $articleResult[0];
                }
            }

            //+ VISAKH - 09-Dec-2017 - KM# TO SET THE LAST UPDATED TIME
            $this -> set("LAST_UPDATED_ON",$lastUpdatedOn);
        }
        else
        {
            //Coming up soon...
        }

        return $articleList;
    }
}
