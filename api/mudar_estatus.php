<?php
include '../conexao/conexao.php';

$id_tarefa = $_GET['id_tarefa'];

$sql = "UPDATE tarefas SET estatus_tarefa = 'Concluido' WHERE id_tarefa = :id_tarefa";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_tarefa', $id_tarefa);
$stmt->execute();

header("Location: ../index.php");
exit;


