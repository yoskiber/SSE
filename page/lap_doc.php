<?php

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="Data-Beasiswa.docx"');
header('Cache-Control: max-age=0');

ob_start();
include_once('perhitungan.php');
$htmlContent = ob_get_clean();

$doc = new DOMDocument();
$doc->loadHTML($htmlContent);
$containerTable = $doc->getElementById('table-wrap');
$containerTable->setAttribute('style', 'text-align: center');
$doc->getElementById('table-user')
	->setAttribute('Border', '1');

$resultContainer = $doc->saveHTML($containerTable);

echo $resultContainer;

