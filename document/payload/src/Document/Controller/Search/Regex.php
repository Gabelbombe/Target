<?php
Namespace Document\Controller\Search
{
    USE Document\Model\Loader;

    Class Regex Extends Loader
    {
        private $params = [];

        public function __construct($params)
        {
            $this->params = $params;
            $this->load($this->params['file']);

            if (isset($this->params['file']) && ! empty($this->params['strip']))
            {
                $this->strip(explode(',', $this->params['strip']));
            }

//            print_r($this);
        }
    }
}