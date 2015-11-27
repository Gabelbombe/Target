<?php
Namespace Document\Model
{
    Class Loader
    {
        public  $text = null;

        // REF: https://en.wikipedia.org/wiki/Most_common_words_in_English
//        private $junk = [ 'the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I', 'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at', 'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she', 'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what', 'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'go', 'me', 'when', 'make', 'can', 'like', 'time', 'no', 'just', 'him', 'know', 'take', 'people', 'into', 'year', 'your', 'good', 'some', 'could', 'them', 'see', 'other', 'than', 'then', 'now', 'look', 'only', 'come', 'its', 'over', 'think', 'also', 'back', 'after', 'use', 'two', 'how', 'our', 'work', 'first', 'well', 'way', 'even', 'new', 'want', 'because', 'any', 'these', 'give', 'day', 'most', 'us', ];

        protected function load($file)
        {
            if (! file_exists($file) || 0 === filesize($file)) Throw New \Exception('File does not exist or is empty');

            $this->text = file_get_contents($file);

            return $this;
        }

        public function strip(array $terms = [])
        {
            $terms = $this->rcTrim($terms);
            $this->text = str_replace($terms, '', $this->text);
            $this->common(); // removes crap
            $this->common($this->junk);


            print_r($this);
            return $this;
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

        private function common(array $strip = [])
        {
            $this->text = preg_replace('/\s\s+/i', ' ', $this->text);           // replace whitespace
            $this->text = trim($this->text);                                    // trim the string
            $this->text = preg_replace('/[^a-zA-Z0-9 -]/', '', $this->text);    // only take alphanumerical characters, but keep the spaces and dashes too...
            $this->text = strtolower($this->text);                              // make it lowercase

            preg_match_all('/\b.*?\b/i', $this->text, $matchWords);

            $matchWords = $matchWords[0];

            foreach ($matchWords AS $key => $item)
            {
                if (empty($item) || in_array(strtolower($item), $strip) || 3 >= strlen($item))

                    unset($matchWords[$key]);
            }

            $wordCountArr = [];

            if (is_array($matchWords))
            {
                foreach ($matchWords AS $key => $val)
                {
                    $val = strtolower($val);

                    if (isset($wordCountArr[$val]))

                        $wordCountArr[$val]++;

                    else { $wordCountArr[$val] = 1; }
                }
            }

            arsort($wordCountArr);
            $wordCountArr = array_slice($wordCountArr, 0, 10);

            return $wordCountArr;
        }
    }
}