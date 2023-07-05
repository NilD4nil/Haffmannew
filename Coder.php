<?php
class Coder{
    private $message;
    private $letters;


    public function __construct($message)
    {
        $message = trim($message);
        $this -> message = $message;
        $this -> letters = preg_split("//u", mb_strtolower($message), -1, PREG_SPLIT_NO_EMPTY);
    }
    public function encode()
    {
    $letter_count = [];
    foreach ($this -> letters as $letter){
        if (!empty($letter_count[$letter])){
            $letter_count[$letter] -> count++;
            }
        else{
            $letter_count[$letter] = new Tree($letter, 1);
            }
        }
    usort($letter_count, function($a, $b){
        return $b -> count <=> $a -> count;
        });
    var_dump($letter_count);
    }

    public function decode()
    {

    }
}