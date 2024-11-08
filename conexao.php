<?php
$host = 'localhost';
$tarefa = 'root';
$senha = '';
$banco = 'tarefas';

$conn = mysqli_connect($host, $tarefa, $senha, $banco) 
or die('Não foi possível conectar');
?>