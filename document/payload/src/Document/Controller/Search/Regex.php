<?php
Namespace Document\Controller\Search
{
    USE Document\Model\Loader;

    Class Regex Extends Loader
    {
        private $params = [],
                $count  = 0;

        public function __construct($params)
        {
            $this->params = $params;
            $this->load($this->params['file']);
            $this->strip();

            if (isset($this->params['file']) && ! empty($this->params['strip']))
            {
                $this->strip(explode(',', $this->params['strip']));
            }

            if (isset($this->params['common']))
            {
                $this->removeCommonWords();
            }

            $this->matches();

            //echo "\n{$this->count} matches of '{$this->params['find']}' found.'\n\n";
        }

        public function matches()
        {
            preg_match_all("/\s{$this->params['find']}\s/", $this->text, $matches); ## fakes a word block

            $this->count = count($matches [0]);
        }
    }
}