<?php
include '../conexao/conexao.php';
$id_tarefa = $_GET['id_tarefa'];

$sql = "DELETE FROM tarefas WHERE id_tarefa = :id_tarefa";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':id_tarefa', $id_tarefa);
$stmt->execute();

//header("Location: ../index.php");
