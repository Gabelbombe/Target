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

        public function addAction()
        {
            if ($this->request()->isPost())
            {
                $db = New Database(APP_PATH . '/src/config/mysql.ini');
                $db->insert();
            } else {
                $this->render('product/add');

            }
        }

        public function editAction($id = false)
        {
            $db = New Database(APP_PATH . '/src/config/mysql.ini');

            if (false !== $id)
            {
                $this->render('product/edit', [
                    'product' => $db->query(),
                ]);
            } else {
                $this->render('product/edit', [
                    'product' => $db->get($id),
                ]);
            }
        }
    }
}
