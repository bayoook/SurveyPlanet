<?php
$s = "saya, anda";
$s = str_replace(' ', '', $s);
$data = explode(',',$s);
echo $s."\n";
print_r ($data);

$_SESSION['time'] = $time;
echo $time;
?>