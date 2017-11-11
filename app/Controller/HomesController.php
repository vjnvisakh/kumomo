<?php

    App::uses('AppController', 'Controller');

    class HomesController extends Controller
    {
        public function isAlive()
        {
            echo "Homes is alive at ".date("d-M-Y h:i:s");
            exit();
        }
    }

?>