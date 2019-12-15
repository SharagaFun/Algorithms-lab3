<?php
//maximum cost path problem
fscanf(STDIN, "%d %d\n", $n, $nn);
$i=0;
do 
{
    $tmp = explode(" ", trim(fgets(STDIN)));
    $i++;
    $bot['y'] = array_search('S', $tmp);
}
while ($bot['y'] === false);
$bot ['x'] = $i;
$arr[0] = str_replace('S', 0, array_slice($tmp, $bot['y']));
for(; $i<$n; $i++)
{
    $tmp = explode(" ", trim(fgets(STDIN)));
    array_push($arr, array_slice($tmp, $bot['y']));
}
$costs = array_fill(0, count($arr), array_fill(0, count($arr[0]), 0));
for ($i = 0; $i < count($arr); $i++)
    for ($j = 0; $j < count($arr[0]); $j++)
    {
        $t1 = 0; $t2 = 0;
        if ($j > 0)
            $t1 = $costs[$i][$j - 1];
        if ($i > 0)
            $t2 = $costs[$i - 1][$j];
        $costs[$i][$j] = max ($t1, $t2) + $arr[$i][$j];
    }

$px = count($arr)-1; $py = count($arr[0]);
$xes = []; $ys = [];
while ($px||$py)
{
    ((!$py || $costs[$px-1][$py] >= $costs[$px][$py-1]) && $px) ? $px-- : $py--;
    array_unshift ($xes, $px + $bot['x'] - 1);
    array_unshift ($ys, $py + $bot['y']);
}
echo "Path:\n";
for ($i=0; $i<count($xes); $i++)
    echo "($xes[$i],$ys[$i]) ";
echo "\nCoins: ".$costs[count($costs) -1][count($costs[0]) - 1];
