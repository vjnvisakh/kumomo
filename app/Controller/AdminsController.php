<?php

    App::uses("AppController","Controller");

    class Admins extends AppController
    {
        public function isAlive()
        {
            echo "Admins alive at ".date("d-M-Y h:i:s");
            exit();
        }
    }

?>