<?php
class Request
{
	private $errors = []; // массив ошибок

	public function isPost()
	{
		return $_SERVER['REQUEST_METHOD'] == 'POST';
	}

	public function required($nameInput)
	{
		$inputData = $_POST[$nameInput] ?? '';
		$data = $this->clearData($inputData);
		if(empty($data))
		{
			$this->errors[$nameInput][] = 'Поле обазятельно к заполнению';
		}
    }
	public function getErrors()
	{
		return $this->errors;
	}
	/**
	* данный метод очищает входящий текст от концевых пробелов и тегов
	* @param String $text
	* @param String
	*/
	public function clearData($text)
	{
        $text=trim(strip_tags($text));

		return $text;
	}
	/**
	* метод проверяет минимальное количество введенных символов.
	* @param String $inputTitle - имя поля, которое проверяется
	* @param int $min - минимальное количество символов
	*/
	public function min($inputTitle, $min)
	{
        $inputData = $_POST[$inputTitle] ?? '';
        $inputData = $this->clearData($inputData);
        if(mb_strlen(($inputData))<$min){

            $this->errors[$inputTitle][] = "Запись должна быть больше {$min} ";
        }
	}
	/**
	* метод проверяет максимальное количество введенных символов.
	* @param String $inputTitle - имя поля, которое проверяется
	* @param int $max - максимальное количество символов
	*/
	public function max($inputTitle, $max)
	{
        $inputData = $_POST[$inputTitle] ?? '';
        $inputData = $this->clearData($inputData);
        if(mb_strlen(($inputData))>$max){
            $this->errors[$inputTitle][] = "Запись должна быть меньше {$max}";
        }
	}
}
