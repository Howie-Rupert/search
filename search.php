<?php
include  __DIR__.'/sdk/lib/XS.php';
$db = include __DIR__.'/db.php';
if(!empty($_GET['kw'])){
    $xs = new XS('article');
    $search = $xs->search;
    $data = $search->search($_GET['kw']);
    $ret = [];
    foreach($data as $item){
        $title = $search->highlight($item->title);
        $id = $item->id;
        $sql = "select * from arts where id=$id";
        $tmp = $db->query($sql)->fetch();
        $tmp['title'] = $title;
        $ret[] = $tmp;
        $sql = "update articles set search_num=search_num+1 where id = $id";
        $db->query($sql);
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>搜索</title>
    <script src="/jquery-1.8.1.min.js"></script>
</head>
<style>
    body{
        font-size:16px;
    }
    em{
            color: red;
            font-style: normal;
            font-weight: bold;
        }
    #b_search{
        width:500px;
        margin:0 auto;
    }
    #search{

    }
    #hots{
        width:50%;
        margin:0 auto;
    }

    .hot {
        float:left;
        margin-bottom:20px;
        width:50%;
    }
    .hotsearch{
        margin:0 auto;
    }
</style>
<body>
<div id="b_search">
    <form style="margin-left:80px;">
        <input type="text" name="kw"  values="<?php echo $_GET['kw']?>">
        <input type="submit" value="搜索">
    </form>
    <?php if(!$_GET['kw']):?>
    <div></div>
    <?php  else:?>
    <div id="search">
        <ul>
            <?php foreach ($ret as $item): ?>
                <li style="list-style:none;">
                    <span><?php echo $item['title'] ?></span>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
            <?php endif;?>
</div>

<hr>
<div style="text-align:center" class="hotsearch">热门搜索</div>    
<?php 
    $sql = "select title from articles order by search_num desc LIMIT 10";
    $hot = $db->query($sql)->fetchall();
?>
<div id="hots">
<ul>
        <?php foreach ($hot as $k => $v): ?>
            <div class="hot">
                <span><?php echo $k+=1,'.',$v['title'] ?></span>
            </div>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>