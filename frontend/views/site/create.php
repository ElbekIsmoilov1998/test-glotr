<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use common\models\User;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;


/* @var $this yii\web\View */
/* @var $model common\models\ToDoList */

$this->title = 'Создать новую задачу';

?>
<div class="to-do-list-create">

    
    <div class="col-md-6">
                <div class="list-group">
                <h1>Список всех задач</h1>
                    <?php foreach($list as $item):?>
                        <a href="<?= \yii\helpers\Url::to(['/site/list/?id=' . $item['id']])?>" class="list-group-item list-group-item-action" aria-current="true">
                        <?php echo $item->title ?>
                        <span style="float:right;"><?php echo (($item->status == 0) ? '<span class="label label-danger">Не выполнено</span>' : (($item->status == 1) ?  '<span class="label label-success">Выполнено</span>' : '<span class="label label-warning">В процессе</span>'));?></span>
                        <span class="label label-success" style="padding:5px 20px;"><?php echo $item->completed_by ?></span>    
                    </a>
                    <?php endforeach;?>
               </div>
    </div> 


<?php  if(Yii::$app->user->identity):?>

    <div class="to-do-list-form col-md-6">
    <h1><?= Html::encode($this->title) ?></h1>
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'title')->textInput(['rows' => 1, 'placeholder' => "Названия задачи"])->label(false) ?>

            <?= $form->field($model, 'created_by')->hiddenInput(['value' => Yii::$app->user->identity->id])->label(false) ?>

            <?= $form->field($model, 'completed_by')->dropDownList(ArrayHelper::map($users,'id','username'),['prompt'=>'Выберите соотрудника'])->label(false);?>

            <?= $form->field($model, 'content')->textarea(['rows' => 3, 'placeholder' => "Контент задачи"])->label(false) ?>

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
            ])->label(false);?>

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
            ])->label(false);?>

            <?= $form->field($model, 'status')->dropDownList(
                [ 
                    '0' => 'Не выполнено', 
                    '1'=> 'Выполнено',
                    '2'=> 'В процессе',
                 ],
                 ['prompt' => 'Выберите статус...'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

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





<?php
$js = <<<JS
    $('form').on('beforeSubmit', function(){
       var data = $(this).serialize();
        $.ajax({
            url: '/site/create',
            type: 'POST',
            data: data,
            success: function(res){
                
            },
            error: function(){
                
            }
        });
        return false;
    });
JS;
 
$this->registerJs($js);
?>
