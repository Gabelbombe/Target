<?php
Namespace Barren
{
    Class Map
    {
        protected   $map    = [],
                    $coords = [];

        private     $atlas  = [];

        public function __construct($map)
        {
            $this->map = $this->validateMap($map);
            $this->buildAtlas();
        }

        /**
         * Builds the map outline
         */
        protected function buildAtlas()
        {
            // constructs in loop
            for ($x = $this->map[0][0]; $x < $this->map[1][0]; $x++)
            {
                $this->atlas[$x] = array_fill($this->map[0][1], $this->map[1][1], ' ');
            }
            return $this;
        }


        public function plot()
        {
            $caps = '+';
            for ($x = $this->map[0][0]; $x < $this->map[1][1]; $x++) { $caps .= '-'; }
            $caps .= "+\n";

            echo $caps;

                foreach ($this->atlas AS $node => $array)
                {

                    echo '|';
                    foreach ($array AS $point)
                    {
                        echo "$point";
                    }
                    echo "|\n";
                }


            echo $caps;

        }

        /**
         * Turns coordinates into something semi-usable...
         *ww
         * @param $coords
         * @return $this
         * @throws \Exception
         */
        public function setCoords($coords)
        {
            // clean up coordinates
            $coords = substr($coords, 1, -1);
            $coords = str_replace(["'", '"'], '', $coords);

            foreach (explode(',', $coords) AS $set)
            {
                $parts = array_filter(explode(' ', trim($set)));

                if (4 !== count($parts)) Throw New \Exception('Coordinates have to be exactly 4 points...');

                $this->coords[] = [
                    $parts[0],
                    $parts[1],
                    $parts[2],
                    $parts[3],
                ];
            }
            return $this;
        }

        /**
         * Fill coordinates on map
         */
        public function graph()
        {
            if (empty($this->map) || empty($this->coords)) Throw New \Exception('Map and Coords must be set.');

            foreach ($this->coords AS $set)
            {
                if (isset($this->atlas[$set[0]]) && isset($this->atlas[$set[1]]))
                {
                    $this->fillX($set[0], $set[1]);  // 1 -> 3
                    $this->fillY($set[2], $set[3]);  // 5 -> 3
                }
            }
            return $this;
        }

        private function fillX($x, $y)
        {
            for ($i = $x ; $i < $y ; $i++)
            {
                $this->atlas[$y][$i] = '1';
            }
        }

        private function fillY($y, $x)
        {
            for ($i = $y ; $i > $x ; $i--)
            {
                $this->atlas[$i][$x] = '1';
            }
        }

        /**
         * @param $map
         * @throws \Exception
         */
        private function validateMap($map)
        {
            if (2 !== count($map)) Throw New \LogicException('Map must have two sets.');

            foreach ($map AS $plot)
            {
                if (2 !== count($plot)) Throw New \LogicException('Map must have two sets of two.');
            }
            return $map;
        }
    }
}