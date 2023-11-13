<?php

use MathParser\StdMathParser;
use MathParser\Interpreting\Evaluator;
require 'vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

    try{
        $expression = $_POST["evalstr"];
        $result = $expression;
        $parser = new StdMathParser();
    
        // Generate an abstract syntax tree
        $AST = $parser->parse($expression);
        
        // Do something with the AST, e.g. evaluate the expression:
        $evaluator = new Evaluator();
        
        $value = $AST->accept($evaluator);
        
        $data = array(
            'result' => $result,
            'result2' => $value
        );
        echo json_encode($data);
    }
    catch(Exception $e){
        $data = array('error' => $e->getMessage());
        echo json_encode($data);
    };
}
?>