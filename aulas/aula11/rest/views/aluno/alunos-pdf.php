<h1>Listagem de alunos matriculados</h1>

<?php
foreach($alunos as $aluno):
?>

    <?= $aluno['alun_codigo'] ?> - <?= $aluno['alun_nome'] ?> <br>

<?php
endforeach;
?>