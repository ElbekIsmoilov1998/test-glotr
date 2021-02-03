<?php
use yii\helpers\Url;



/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
    <a href="<?= \yii\helpers\Url::to(['/site/create'])?>" class="btn btn-primary">Создать задачу</a>
    <?php  if(Yii::$app->user->identity):?>
        <div class="row">
        <!-- Задача который должен выполнить -->


            <div class="col-md-6" style="margin-top:20px;">
                <div class = "panel panel-danger">
                    <div class = "panel-heading">
                        <h3 class = "panel-title">Задача к вам <span style="font-size:20px; text-transform: uppercase;  "><?php echo Yii::$app->user->identity->username  ?></span></h3>
                    </div>
                    
                    <div class = "panel-body">
                        <?php foreach($user_list as $item):?>
                                <a style="" href="<?= \yii\helpers\Url::to(['/site/list/?id=' . $item['id']])?>" class="list-group-item list-group-item-action " aria-current="true"><?php echo $item->title ?>
                                
                                <span style="float:right;"><?php echo (($item->status == 0) ? '<span class="label label-danger">Не выполнено</span>' : (($item->status == 1) ?  '<span class="label label-success">Выполнено</span>' : '<span class="label label-warning">В процессе</span>'));?></span>
                                    
                                </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        <!-- Задача который вы создали -->


            <div class="col-md-6" style="margin-top:20px;">
                <div class = "panel panel-primary">
                    <div class = "panel-heading">
                        <h3 class = "panel-title">Задача который вы создали <span style="font-size:20px; text-transform: uppercase;  "><?php echo Yii::$app->user->identity->username  ?></span></h3>
                    </div>
                    
                    <div class = "panel-body">
                        <?php foreach($user_list_created as $item):?>
                                <a style="" href="<?= \yii\helpers\Url::to(['/site/list/?id=' . $item['id']])?>" class="list-group-item list-group-item-action " aria-current="true"><?php echo $item->title ?>
                                
                                <span style="float:right;"><?php echo (($item->status == 0) ? '<span class="label label-danger">Не выполнено</span>' : (($item->status == 1) ?  '<span class="label label-success">Выполнено</span>' : '<span class="label label-warning">В процессе</span>'));?></span>
                                    
                                </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>

        <?php endif;?> 

     <div class="row">
     <div class="col-md-6">
                <div class="list-group">
                <h1>Users</h1>
                    <?php foreach($model as $item):?>
                        <a href="<?= \yii\helpers\Url::to(['/site/user/?id=' . $item['id']])?>" class="list-group-item list-group-item-action" aria-current="true"><?php echo $item->username ?>
                        <span style="float:right;"><?php echo ($item->status == 10 ? '<span class="label label-success">Активен</span>' : '<span class="label label-danger">Не активен</span>');?></span>
                        </a>
                    <?php endforeach;?>
                        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Vestibulum at eros</a>
               </div>
            </div> 



            <div class="col-md-6">
                <div class="list-group">
                <h1>To Do List</h1>
                
                <?php foreach($list as $item):?>
                        <a style="" href="<?= \yii\helpers\Url::to(['/site/list/?id=' . $item['id']])?>" class="list-group-item list-group-item-action " aria-current="true"><?php echo $item->title ?>
                    
                        <span style="float:right;"><?php echo (($item->status == 0) ? '<span class="label label-danger">Не выполнено</span>' : (($item->status == 1) ?  '<span class="label label-success">Выполнено</span>' : '<span class="label label-warning">В процессе</span>'));?></span>
                        
                    </a>
                    <?php endforeach;?>
               

               </div>
            </div>
          </div>      
        </div>

    </div>
</div>

