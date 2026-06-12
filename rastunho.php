<form action='mudar_estatus.php' method='get'>
    <input type='text' value='{$linha[' id_tarefa']}' name='id_tarefa'>
    <input type='checkbox' name='estatus_tarefa' value='Concluido' onchange='this.form.submit()'>
</form>