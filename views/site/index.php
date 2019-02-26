<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model, 'keyWord')->textInput(['autofocus' => true]) ?>

    <div class="form-group">
        <a href="/console.php?r=pars">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
        </a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
