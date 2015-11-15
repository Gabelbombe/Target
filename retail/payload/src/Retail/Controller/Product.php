<?php
Namespace Retail\Controller
{
    USE Retail\Model\Database AS Database;

    Class Product Extends \SlimController\SlimController
    {
        public function getAction($id)
        {
            $db = New Database(APP_PATH . '/src/config/mysql.ini');

            $this->render('product/get', [
                'product' => $db->get($id),
            ]);
        }

        public function addAction($id)
        {
            $db = New Database(APP_PATH . '/src/config/mysql.ini');

            $this->render('product/add', [
                'product' => $db->get($id),
            ]);
        }

        public function editAction($id = false)
        {
            $db = New Database(APP_PATH . '/src/config/mysql.ini');

            $this->render('product/edit', [
                'product' => $db->get($id),
            ]);
        }
    }
}
