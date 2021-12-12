<meta http-equiv="refresh" content="60, index.php">
<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache');
$row = 1000;
if (($handle = fopen("ip-log.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p>Visit From:</p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}
    ?>
<a name="lastvisit"></a></p>
