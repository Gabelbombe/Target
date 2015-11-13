<?php
Namespace Retail\Controller
{
    USE Retail\Model\Database AS Database;

    Class Index Extends \SlimController\SlimController
    {
        public function indexAction()
        {
            $db = New Database();
            $this->render('home/index', [
                'output' => $db->query(),
            ]);
        }
    }
}
