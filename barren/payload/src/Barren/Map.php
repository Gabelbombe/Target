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
        }

        /**
         * Builds the map outline
         */
        public function buildAtlas()
        {
            // constructs in loop
            for ($xx = $this->map[0][0]; $xx < $this->map[1][1]; $xx++)
            {
                // fill with empty...
                $this->atlas[$xx] = array_fill($this->map[0][1], $this->map[1][0], false);
            }
            return $this;
        }

        /**
         * Turns coordinates into something semi-usable...
         *
         * @param $coords
         * @return $this
         * @throws \Exception
         */
        public function setCoords($coords)
        {
            // clean up coordinates
            $coords = substr($coords, 1, -1);
            $coords = preg_replace("/[^0-9]+/", "", html_entity_decode($coords, ENT_QUOTES));
            foreach (explode(',', $coords) AS $set)
            {
                $parts = explode(' ', $set);
                if (4 !== count($parts)) Throw New \Exception('Coordinates have to be exactly 4 points...');

                $this->coords[] = [
                    [$parts[0], $parts[1]],
                    [$parts[2], $parts[3]],
                ];
            }
            return $this;
        }


        public function graph()
        {
            if (empty($this->map) || empty($this->coords)) Throw New \Exception('Map and Coords must be set.');

            
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