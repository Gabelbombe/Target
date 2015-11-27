<?php
Namespace Document\Controller\Search
{
    USE Document\Model\Loader;

    Class Brute Extends Loader
    {
        public function __construct($file)
        {
            parent::__construct($file);

            var_export($this);
        }
    }
}