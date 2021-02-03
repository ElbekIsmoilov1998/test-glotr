<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\User;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model common\models\ToDoList */

$this->title = 'Обновить текущую задачу';

?>
<div class="to-do-list-create">

<div class="body-content">
        <div class="row">
        
        <div class="col-md-12">
            <a href="<?= \yii\helpers\Url::previous()?>" class="btn btn-primary">Назад</a>
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
                            <td><?php echo $user_gave->username;?></td>
                        </tr>
                        <tr>
                            <th scope="row">Выполняющий</th>
                            <td><?php echo $user_get->username;?></td>
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
                    <div class = "panel panel-danger">
                    <div class = "panel-heading">
                        <h3 class = "panel-title"><span style="color:black;">Названия:  </span><?php echo $model->title;?></h3>
                    </div>
                    
                    <div class = "panel-body">
                    <?php echo $model->content;?>
                    </div>
                </div>
            </div> 
            

<?php  if($model->created_by == Yii::$app->user->identity->id or $model->completed_by == Yii::$app->user->identity->id ):?>

<div class="to-do-list-form col-md-6">
<h1><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => ' form-control btn btn-success']) ?>
        </div>

        
        <?= $form->field($model, 'status')->dropDownList(
            [ 
                '0' => 'Не выполнено', 
                '1'=> 'Выполнено',
                '2'=> 'В процессе',
             ],
             ['prompt' => 'Выберите статус...'])->label(false) ?>

        <?= $form->field($model, 'title')->textInput(['rows' => 1, 'placeholder' => "Названия задачи"]) ?>

        
        <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

        
        <?php  if($model->created_by == Yii::$app->user->identity->id ):?>


            <?= $form->field($model, 'completed_by')->dropDownList(ArrayHelper::map($users,'id','username'),['prompt'=>'Выберите соотрудника']);?>


        <?php elseif($model->completed_by == Yii::$app->user->identity->id ): ?>


            <?= $form->field($model, 'completed_by')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>


        <?php endif;?> 


        <?= $form->field($model, 'content')->textarea(['rows' => 5, 'placeholder' => "Контент задачи"]) ?>


        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
            'name' => 'check_issue_date',
            'language' => 'ru',
            'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Дата началы задачи...'],
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
                'todayHighlight' => true,
                'autoclose' => true,

            ]
        ]);?>


        <?= $form->field($model, 'completed_date')->widget(DatePicker::classname(), [
            'name' => 'check_issue_date',
            'language' => 'ru',
            'value' => date('d-M-Y', strtotime('+2 days')),
            'options' => ['placeholder' => 'Дата выполнения ...'],
            'pluginOptions' => [
                'format' => 'dd-M-yyyy',
                'todayHighlight' => true,
                'autoclose' => true,

            ]
        ]);?>






        <?php ActiveForm::end(); ?>
</div>

<?php else:?> 
    <div class="col-md-6">
        <div class = "panel panel-danger">
            <div class = "panel-heading">
                <h3 class = "panel-title">Ошибка аутентификации</h3>
            </div>
            
            <div class = "panel-body">
                Надо залогиноваться чтобы добавить Задачу
            </div>
        </div>
    </div>

<?php endif;?>        
        </div>
    </div>
</div>



