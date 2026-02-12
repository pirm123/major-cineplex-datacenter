<?php
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$excelFile = __DIR__ . '/data.xlsx';
$tableName = 'movies';
$outputSql = __DIR__ . '/output.sql';

$sheet = IOFactory::load($excelFile)->getActiveSheet();
$rows  = $sheet->toArray(null, true, true, true);

// header
$rawHeaders = array_shift($rows);
$headers = [];
$cols = [];

foreach ($rawHeaders as $k => $h) {
    if (trim($h) === '') continue;

    $safe = strtolower(preg_replace('/[^a-z0-9]+/i', '_', $h));
    $safe = trim($safe, '_');
    if ($safe === '3d') $safe = 'is_3d';

    $headers[] = $safe;
    $cols[] = $k;
}

$sql = "INSERT INTO `$tableName` (`" . implode("`,`", $headers) . "`) VALUES\n";
$values = [];

foreach ($rows as $row) {
    $vals = [];
    foreach ($cols as $c) {
        $v = $row[$c] ?? null;
        $vals[] = ($v === null || $v === '') ? 'NULL' : "'" . addslashes($v) . "'";
    }
    $values[] = '(' . implode(',', $vals) . ')';
}

$sql .= implode(",\n", $values) . ";\n";
file_put_contents($outputSql, $sql);

echo "OK\n";
