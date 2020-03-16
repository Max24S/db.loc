<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <form style="width: 100%" method="post" onsubmit="sendData();return false;" id="formNews" >
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label">Название новости</label>
                <div class="col-md-10">
                    <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value=""
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="date" class="col-md-2 col-form-label">Дата публикации</label>
                <div class="col-md-10">
                    <input
                        type="date"
                        class="form-control"
                        id="date"
                        name="date"
                        value=""
                    >
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 col-form-label">Cтатус</label>
                <div class="col-md-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="publish_in_index" id="publish_in_index_draft" value="draft" checked>
                        <label class="form-check-label" for="publish_in_index_draft">
                            Черновик
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="publish_in_index" id="publish_in_index_published" value="published">
                        <label class="form-check-label" for="publish_in_index_published">
                            Опубликована
                        </label>
                    </div>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="category" class="col-md-2 col-form-label">Раздел новости</label>
                <div class="col-md-10">
                    <select id="category" class="form-control" name="category">
                        <option disabled selected>Выберете категорию из списка..</option>
                        <option value="1">Спорт</option>
                        <option value="2">Культура</option>
                        <option value="3">Политика</option>
                        <option value="4">Наука</option>
                        <option value="5">Финансы</option>
                    </select>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="content" class="col-md-2 col-form-label">Текст новости</label>
                <div class="col-md-10">
                    <textarea
                        name="content"
                        id="content"
                        class="form-control"
                        cols="30"
                        rows="10"></textarea>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <label for="annotation" class="col-md-2 col-form-label">Автор</label>
                <div class="col-md-10">
                    <textarea
                            name="annotation"
                            id="annotation"
                            class="form-control"
                            cols="30"
                            rows="10"></textarea>
                    <div class="invalid-feedback"></div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9">
                    <input type="hidden" name="action" value='add'>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
                <div class="col-md-3">
                    <div class="alert alert-success">Форма валидна</div>
                </div>
            </div>
        </form>
<style>
    .error{border-color:red;}
</style>
<script type="text/javascript">

    function DateNow(){
        let form = '#formNews';
        let date=new Date();
        $("#date",form).val(`${date.getFullYear()}-${(date.getMonth()<10? '0' : '')+date.getMonth()}-${(date.getDate()<10? '0' : '')+date.getDate()}`);
    }
    $(function() {
        DateNow();
    });
    function sendData()
    {
        let form = '#formNews';
        let dataForm = $(form).serialize();
        $('*', form).removeClass('error');

        $('.invalid-feedback').empty(); //очищает тексты ошибок
        $.ajax({
            url: 'server.php', //адрес куда отправятся данные
            type: 'POST',
            dataType: 'json', //в каком формате ожитается ответ от сервера
            data: dataForm, //данные с формы
            success: function(responce){
                //метод, который выполняется при успешном ответе от сервера
                if(responce.status == 'ok')
                {
                    document.location.href='list.php'
                }
                else
                {
                    for( key in responce ){
                        $('[name="'+key+'"]', form).addClass('error');
                        $('[name="'+key+'"]').siblings('.invalid-feedback').html( responce[key].join('<br>')  ).show();
                    }
                }

            }
        })
    }
</script>
    </div>
</div>
</body>
</html>