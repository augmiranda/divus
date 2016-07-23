
<?php

foreach (Yii::$app->session->getAllFlashes() as $key => $message):
?>
 <div class="alert alert-<?=$key?>" role="alert"><?=$message?></div>
<?php
endforeach;
?>

<table class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class="col-md-5">Nome</th>
                  <th class="col-md-3">Matricula</th>
                  <th class="col-md-3">Data de Nascimento</th>
                  <th class="col-md-1"></th>
                </tr>
              </thead>
              <tbody>
                  
                <?php
                foreach($alunos as $aluno):
                ?>
                  
                <tr>
                  <td><?= $aluno['alun_nome'] ?></td>
                  <td><?= $aluno['alun_matricula'] ?></td>
                  <td><?= Yii::$app->formatter->asDate($aluno['alun_data_nascimento']); ?></td>
                  <td class="text-center">
                    <div class="btn-group" role="group" aria-label="...">
                        <a href="<?= \yii\helpers\Url::to(['exercicio/delete', 'id' => $aluno['alun_codigo']]); ?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </div>
                  </td>
                </tr>
                
                <?php

                endforeach;

                ?>
                                  
                
              </tbody>
            </table>