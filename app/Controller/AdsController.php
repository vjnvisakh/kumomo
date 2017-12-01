<?php

    App::uses("AppController","Controller");

    class AdsController extends AppController
    {
        public $name = "Ads"; //TANUSHREE - KM#1COMMIT#2 - Set the name variable
        public $uses = array("Article","Ad","User","Category","ArticlesToCategory");

        public function isAlive()
        {
            echo "Ads alive at ".date("d-M-Y h:i:s");
            exit();
        }

        public function registerClick()
        {
            if(!empty($_POST["adId"]))
            {
                $adQuery = " UPDATE ads SET clicks = clicks + 1 WHERE id = " . $_POST["adId"];
                $adResult = $this -> Ad -> query($adQuery);
            }

            echo json_encode(1);
            exit();
        }

    }

?>