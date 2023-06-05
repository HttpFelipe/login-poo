<?php
//Função que remove espaços em branco e caracteres especiais. Garante um input válido e evita possíveis injeções de script no input.
function validInput($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>