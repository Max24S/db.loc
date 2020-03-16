<?php
require_once('models/users.class.php');

//$Users = new Users();
//$news = $Users->get_all();
$NewsClass = new Users();
$id = $_GET['id'];
$news = $NewsClass->get_one(['id'=>$id]);
if(!$news){

    echo 'Такой записи не существует в базе данных'; die;

}
?>

<div>
    <?php echo $news['id']?>
</div>
<td>
    <a href="/edit.php?id=<?php echo $news['id']?>">edit</a>
</td>
<div>
    <?php echo $news['date_published']?>
</div>