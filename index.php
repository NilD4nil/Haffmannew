<?php
require 'autoload.php';
if (!empty($_POST['message'])){
    $text = $_POST['message'];
    $coder = new Coder($text);
    $encode = $coder -> encode();
    $decode = $coder -> decode($encode);
}
?>
<form method="post">
    <label for="">Запишите фразу:</label>
    <br>
    <textarea name="message" id="textarea"></textarea>
    <input type="submit" value="Отправить">
</form>
<div>
    <?= (!empty($encode)) ? $encode : ''; ?>
    <br>
    <?= (!empty($decode)) ? $decode : ''; ?>
    <br>
    <?= (!empty($encode)) ? $coder -> get_table() : ""; ?>
</div>