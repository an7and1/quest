<?php
#получаю данные из формы
$name = filter_var(trim($_POST['name']),FILTER_SANITIZE_STRING);
$psw = filter_var(trim($_POST['psw']),FILTER_SANITIZE_STRING);
$phone = filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
#форматирую номер для соответстсвия int(9)
$format=substr($phone,5,2).substr($phone,9,3).substr($phone,13,4);
$phone = intval($format);
#шифрую пароль
$psw = md5($psw."wdaefsf453sf"); #солю хэш
#вызываю подключение к БД
$mysql = new mysqli('localhost','mysql','mysql','register-bd');
#проверяю наличие в таблице user_registration введенного телефона
$result = $mysql->query("SELECT * FROM `user_registration` WHERE `PHONE`='$phone'");
$user = $result->fetch_assoc();
if (count((array)$user) != 0) {
    echo "Такой пользователь уже зарегистрирован";
    exit();
}
#передаю данные в БД и возвращаюсь на index.html
$mysql->query("INSERT INTO `user_registration` ( `NAME`, `PHONE`, `PASS`) VALUES ('$name', '$phone', '$psw')");
header('Location: /');
