<?php
Namespace Document\Controller\Search
{
    USE Document\Model\Loader;

    Class Brute Extends Loader
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

            echo "\n{$this->count} matches of '{$this->params['find']}' found.'\n\n";
        }

        /**
         * only does exact matches
         */
        public function matches()
        {
            foreach (explode(' ', $this->text) AS $value)
            {
                if ($value == $this->params['find']) $this->count++;
            }
        }
    }
}