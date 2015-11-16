<?php error_reporting(-1); ini_set('error_reporting', E_ALL);

require '../Barren/Map.php';

$barren = New \Barren\Map([[0, 0], [10, 50]]);

$barren->setCoords('{"48 192 351 207", "48 392 351 407", "120 52 135 547", "260 52 275 547"}');





function formatCoords($coords)
{

}

$mapArray  = buildAtlas($map);
$mapCoords = formatCoords($coords);

function graph($mapArray, $mapCoords)
{

}
















function buildMap($map)
{
    $xx = '';
    $xy = '';

    $xy .= '+';
    foreach (range($map[0][0], $map[1][1]) AS $point) {
        $xy .= '-';
    }
    $xy .= "+\n";
    foreach (range($map[0][1], $map[1][0]) AS $point) {
        $xx .= '|';
        foreach (range($map[0][0], ($map[1][1])) AS $point) $xx .= ' ';
        $xx .= "|\n";
    }
    echo $xy . $xx . $xy;
}