<?php
$fp = fsockopen ("test.mosquitto.org", 1883, $errno, $errstr, 10);
if (!$fp) {
echo "$errstr ($errno)\n";
}else
{
echo "fsockopen Is Working Perfectly.";
}
fclose ($fp);
?>
