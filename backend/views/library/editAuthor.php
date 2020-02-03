<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Authors */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Edit an author';
$this->params['breadcrumbs'][] = $this->title;
?>

<? if(isset($success)): ?>

<div class="alert alert-success" role="alert">
  Author was edited successfully. 
  <?
  $customUrl = Yii::$app->getUrlManager()->createUrl(['authors', 'id' => $model['id']]);
  echo Html::a('Back to all authors', $customUrl, [
      'class' => 'btn btn-primary',
      'role' => 'button',
      'title' => 'Back to all authors'
  ]);
  
  ?>
</div>

<? else: ?>

<div class="site-addbook">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'editauthor-form']); ?>

                <?= $form->field($model, 'name')->textInput(['value' => $data['name']]) ?>

                <?= $form->field($model, 'dob')->textInput(['value' => $data['dob']]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Edit', ['class' => 'btn btn-primary', 'name' => 'addauthor-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<? endif; ?>