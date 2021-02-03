<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
        
        <div class="col-md-12">
            <a href="<?= \yii\helpers\Url::previous()?>" class="btn btn-primary">Назад</a>
            <?php  if(Yii::$app->user->identity):?>
            <a  href="<?= \yii\helpers\Url::to(['/site/update/?id=' . $model['id']])?>" class="btn btn-warning" aria-current="true">Обновить</a>
            <?php endif;?>
            <h4>Сведения о Задаче</h4>
        </div>
            <div class="col-md-6">
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"><?php echo $model->title;?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">id</th>
                            <td><?php echo $model->id;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Названия</th>
                            <td><?php echo $model->title;?></td>
        
                        </tr>
                        <tr>
                            <th scope="row">Работадатель</th>
                            <td><?php echo $model->created_by;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Выполняющий</th>
                            <td><?php echo $model->completed_by;?></td>
                        </tr>

                        <tr>
                            <th scope="row">Задача</th>
                            <td><?php echo $model->content;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Статус</th>
                            <td><?php echo (($model->status == 0) ? '<span class="label label-danger">Не выполнено</span>' : (($model->status == 1) ?  '<span class="label label-success">Выполнено</span>' : '<span class="label label-warning">В процессе</span>'));?></td>
                        </tr>
                        <tr>
                            <th scope="row">Created date</th>
                            <td><?php echo $model->date;?></td>
                        </tr>

                    </tbody>
                    </table>
            </div>       
            <div class="col-md-6">
                <div class = "panel panel-danger">
                    <div class = "panel-heading">
                        <h3 class = "panel-title"><span style="color:black;">Названия:  </span><?php echo $model->title;?></h3>
                    </div>
                    
                    <div class = "panel-body">
                    <?php echo $model->content;?>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    

</div>
