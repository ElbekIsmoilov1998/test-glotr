<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-md-4">
            <table class="table table-striped">
            <a href="<?= \yii\helpers\Url::previous()?>" class="btn btn-primary">Назад</a>
            <h4>Сведения о User</h4>
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col"><?php echo $model->username;?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">id</th>
                            <td><?php echo $model->id;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Username</th>
                            <td><?php echo $model->username;?></td>
        
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td><?php echo $model->email;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Status</th>
                            <td><?php echo ($model->status == 10 ? '<span class="label label-success">Активен</span>' : '<span class="label label-danger">Не активен</span>');?></td>
                        </tr>
                        <tr>
                            <th scope="row">Created date</th>
                            <td><?php echo $model->created_at;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Updated date</th>
                            <td><?php echo $model->updated_at;?></td>
                        </tr>
                    </tbody>
                    </table>
            </div>        
        </div>

    </div>
</div>
