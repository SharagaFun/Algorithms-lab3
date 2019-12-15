<?php
function visittown(&$visited, &$cost, &$path, &$i, &$arr, &$city, &$city2)
{
    $cost += $arr[$city][$city2];
    array_push($path[$i], $city);
    $visited[$city] = 1;
}
function noway(&$path, &$costs, &$i)
{
    $path[$i] = [];
    $costs[$i] = 0;
}

fscanf(STDIN, "%d\n", $n);
for ($i = 0;$i < $n;$i++) $arr[$i] = explode(" ", trim(fgets(STDIN)));
$mc = PHP_INT_MAX;
for ($i = 0;$i < $n;$i++)
{
    $path[$i] = [];
    $city = $i;
    $visited = [];
    $cost = 0;
    $used = array_fill(0, $n, 0);
    $used[$s] = 1;
    $flag = true;
    for ($j = 0;$j < $n - 1;$j++)
    {
        $minpath = PHP_INT_MAX;
        $nextcity = NULL;
        for ($k = 0;$k < $n;$k++)
        {
            if (!$visited[$k] && $arr[$city][$k] < $minpath && $arr[$city][$k])
            {
                $minpath = $arr[$city][$k];
                $nextcity = $k;
            }
        }
        if ($nextcity !== NULL)
        {
            visittown($visited, $cost, $path, $i, $arr, $city, $nextcity);
            $city = $nextcity;
        }
        else
        {
            noway($path, $costs, $i);
            $flag = false;
            break;
        }
    }
    if ($arr[$city][$i])
    {
        visittown($visited, $cost, $path, $i, $arr, $city, $i);
    }
    else
    {
        noway($path, $costs, $i);
        $flag = false;
    }
    if ($flag)
    {
        array_push($path[$i], $i);
        $costs[$i] = $cost;
    }
}
$mincost = PHP_INT_MAX;
$i = 0;
foreach ($costs as $cost)
{
    if ($cost && $cost < $mincost)
    {
        $mincost = $cost;
        $mini = $i;
    }
    $i++;
}
if (isset($mini))
{
    echo "Path:\n";
    foreach ($path[$mini] as $p) echo "$p ";
    echo "\nCost: $mincost";
}
else echo "Lost";
