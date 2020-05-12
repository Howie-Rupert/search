<?php
include  __DIR__.'/sdk/lib/XS.php';
$db = include __DIR__.'/db.php';
$xs = new XS('article');
$index = $xs->index;

$sql = "select aid from article_xs_id where id=1 ";
$lastid = $db->query($sql)->fetch()['aid'];

$sql = "select id,title,desn from articles where id > $lastid order by id asc";
$data = $db->query($sql)->fetchAll();
foreach($data as $item){
    $doc = new XSDocument($item);
    $index -> add($doc);
    $lastid = $item['id'];
}

$index->flushIndex();

$sql = "update article_xs_id set aid=$lastid where id=1";
$db->exec($sql);
echo "ok\n";