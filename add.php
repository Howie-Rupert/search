<?php
include  __DIR__.'/sdk/lib/XS.php';
$db = include __DIR__.'/db.php';
$xs = new XS('article');
$index = $xs->index;
$index -> clean();
$sql = "select id,title,desn from articles";
$data = $db->query($sql)->fetchAll();
foreach($data as $item){
    $doc = new XSDocument($item);
    $index -> add($doc);
}

$index->flushIndex();

echo "ok\n";