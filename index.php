<?php
require 'autoload.php';
if (!empty($_POST['message'])){
    $text = $_POST['message'];
    $coder = new Coder($text);
    $coder -> encode();
}
?>
<form method="post">
    <label for="">Запишите фразу:</label>
    <br>
    <textarea name="message" id="textarea"></textarea>
    <input type="submit" value="Отправить">
</form>