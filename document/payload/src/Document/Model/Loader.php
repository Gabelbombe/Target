<?php
Namespace Document\Model
{
    Class Loader
    {
        public  $text = null;

        // REF: https://en.wikipedia.org/wiki/Most_common_words_in_English
        private $junk = [ 'is', 'the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I', 'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at', 'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she', 'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what', 'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'go', 'me', 'when', 'make', 'can', 'like', 'time', 'no', 'just', 'him', 'know', 'take', 'people', 'into', 'year', 'your', 'good', 'some', 'could', 'them', 'see', 'other', 'than', 'then', 'now', 'look', 'only', 'come', 'its', 'over', 'think', 'also', 'back', 'after', 'use', 'two', 'how', 'our', 'work', 'first', 'well', 'way', 'even', 'new', 'want', 'because', 'any', 'these', 'give', 'day', 'most', 'us', ];

        protected function load($file)
        {
            if (! file_exists($file) || 0 === filesize($file)) Throw New \Exception('File does not exist or is empty');

            $this->text = file_get_contents($file);

            return $this;
        }

        public function strip(array $terms = [])
        {
            $this->common($this->rcLower($terms));

            return $this;
        }

        public function removeCommonWords()
        {
            $this->common($this->junk);
            unset($this->junk);
        }

        /**
         * Recursively trims members of an array.
         *
         * @param $input
         * @return array|string
         */
        protected function rcTrim($input)
        {
            return (is_array($input)) ? array_map(__METHOD__, $input) : trim($input);
        }

        /**
         * Recursively lowercase members of an array.
         *
         * @param $input
         * @return array|string
         */
        protected function rcLower($input)
        {
            return (is_array($input)) ? array_map(__METHOD__, $input) : strtolower($input);
        }

        private function common(array $strip = [])
        {
            $this->text = trim(preg_replace('/\s+/i', ' ', $this->text));
            $this->text = preg_replace('/[^A-Za-z0-9 -]/', '', $this->text);
            $this->text = strtolower($this->text);

            if (! empty($strip))
            {
                $blocks = explode(' ', $this->text);
                $blocks = array_diff($blocks, $strip);

                $this->text = implode(' ', $blocks);
            }
        }
    }
}