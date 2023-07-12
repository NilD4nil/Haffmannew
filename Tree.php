<?php

class tree{
    public $symbols;
    public $count;
    public $right_child;
    public $left_child;

    public function __construct($symbols, $count, $left_child = null, $right_child = null){
        $this -> symbols = $symbols;
        $this -> count = $count;
        $this -> left_child = $left_child;
        $this -> right_child = $right_child;

    }
    public function get_code($letter, &$code = ''){
        if(!$this -> is_leaf()){
            if(mb_strpos($this -> left_child -> symbols, $letter) !== false){
                $code .= '1';
                $this -> left_child -> get_code($letter, $code);
            }
            else{
                $code .= '0';
                $this -> right_child -> get_code($letter, $code);
            }
        }
    }
    public function get_letter(&$array_code){
        if (!$this -> is_leaf()){
            $code = array_shift($array_code);
            if($code == '1'){
                return $this -> left_child -> get_letter($array_code);
            }
            else{
                return $this -> right_child -> get_letter($array_code);
            }
        }
        return $this -> symbols;
    }
    private function is_leaf(){
        return $this -> left_child === null and $this -> right_child == null;
    }
}