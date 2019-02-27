<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
//use yii\bootstrap\Html;
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div>
        id: <?= $info['id'] ?> <br>
        keyword: <?= $info['name'] ?> <br>
        count: <?= $info['count'] ?> <br>
    </div>
    <div class="row">
        <div class="col-lg-5">
    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model, 'keyWord')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <a href="/console.php?r=pars">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </a>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
