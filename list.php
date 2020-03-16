<?php 
require_once('models/users.class.php');

$Users = new Users();
$news = $Users->get_all();

?>
<p><a href="addNews.php">Добавить новый город</a></p>
<table>
	<tr>
		<th>№ п/п</th>
		<th>Заголовок</th>
<!--		<th>Операции</th>-->
	</tr>

	<?php
	$i = 1;
	foreach($news as $item):
	?>

		<tr>
			<td><? echo $i++?></td>
			<td><a href="item.php?id=<?php echo $item['id']?>"><? echo $item['name']?></a>
            </td>
<!--			<td>-->
<!--				<a href="edit.php?id=--><?php //echo $req['id']?><!--">edit</a>-->
<!--			</td>-->
		</tr>

	<?php endforeach;?>
</table>

