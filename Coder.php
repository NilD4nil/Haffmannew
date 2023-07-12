<?php
class Coder{
    private $message;
    private $letters;
    private $letter_unique = [];
    private $tree;
    private $table = [];


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
            $this -> letter_unique[] = $letter;
            }
        }
    usort($letter_count, function($a, $b){
        return $b -> count <=> $a -> count;
        });
        while (count($letter_count) > 1){
            $left_child = array_pop($letter_count);
            $right_child = array_pop($letter_count);
            $tree = new Tree(
                $left_child -> symbols . $right_child -> symbols,
                $left_child -> count + $right_child -> count,
                $left_child, $right_child);
            $letter_count[] = $tree;
            usort($letter_count, function($a, $b) {
                return $b->count <=> $a->count;
            });
        }
        $this -> tree = $letter_count[0];
        foreach ($this -> letter_unique as $letter){
            $code = '';
            $this -> tree -> get_code($letter, $code);
            $this -> table[$letter] = ['letter' => $letter, 'code' => $code];
        }
        $result = '';
        foreach ($this -> letters as $letter){
            $result .= $this -> table[$letter]['code'];
        }
        return $result;
    }


    public function decode($set_code)
    {
        $array_code = preg_split("//u",  $set_code,-1, PREG_SPLIT_NO_EMPTY);
        $letter = '';
        while (!empty($array_code)){
            $letter .= $this -> tree -> get_letter($array_code);
        }
        return $letter;
    }
    public function get_table(){
        $str = "
            <table style='border-collapse: collapse '>
            <tr>
            <th style='border: 1px solid black'>Буква</th>
            <th style='border: 1px solid black'>Код</th>
</tr>>
        ";
foreach ($this -> table as $item){
        $str .= "
    <tr>
        <td style='border: 1px solid black'>{$item['letter']}</td>   
        <td style='border: 1px solid black'>{$item['code']}</td>           
    </tr>
        ";
        }
return $str . '</table>';
    }
}