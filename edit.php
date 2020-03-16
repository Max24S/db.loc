<?php
require_once('models/news.class.php');

$cityClass = new News();

$id = $_GET['id'];

$city = $cityClass->get_one(['id'=>$id]);

if(!$city){

	echo 'Такой записи не существует в базе данных'; die;

}

?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</head>
<body>

	<form id="formCity" onsubmit="sendData(); return false;">
		<div>
			<p>
				<label>Название</label>
				<input type="text" required="" value="<? echo $city['name']?>" name="city">
			</p>

			<p>
				<input type="hidden" name="action" value='edit'>
				<input type="hidden" name="id" value='<? echo $city['id']; ?>'>
				<input type="submit" value="Сохранить">
			</p>

		</div>
	</form>
	<p><a href="list.php">Вернуться к списку</a></p>

<script>

    function sendData()
    {
        let formId = '#formCity';

        $('.invalid-feedback').empty(); //очищает тексты ошибок
        $.ajax({
            url: 'server.php', //адрес куда отправятся данные
            type: 'POST',
            dataType: 'json', //в каком формате ожитается ответ от сервера
            data: $(formId).serialize(), //данные с формы
            success: function(responce){
                //метод, который выполняется при успешном ответе от сервера
                if(responce.status == 'ok')
                {
                    document.location.href='list.php'
                }

            }
        })
    }
	// }
</script>
</body>
</html>