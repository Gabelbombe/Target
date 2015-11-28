<?php
Namespace Document\Controller\Search
{
    USE Document\Model\Loader;

    Class Index Extends Loader
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

            echo $this->text ."\n";

            exit;
        }

        public function matches()
        {
            $index = array_count_values(explode(' ', $this->text));

            if (isset($index[$this->params['find']])) 
            {
                $this->count = $index[$this->params['find']];
            }
        }
    }
}