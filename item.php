<?php
require_once('models/news.class.php');

//$Users = new Users();
//$news = $Users->get_all();
$NewsClass = new News();
$id = $_GET['id'];
$news = $NewsClass->get_one(['id'=>$id]);
if(!$news){

    echo 'Такой записи не существует в базе данных'; die;

}
?>

<div>
    id:<?php echo $news['id']?>
    name:<?php echo $news['name']?>
    date:<?php echo $news['date_published']?>
    status:<?php echo $news['status']?>
    category:<?php echo $news['category']?>
    text:<?php echo $news['text']?>
    author:<?php echo $news['author']?>
</div>
<td>
    <a href="/edit.php?id=<?php echo $news['id']?>">edit</a>
</td>
