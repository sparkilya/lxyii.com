<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\Books */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Edit a book';
$this->params['breadcrumbs'][] = $this->title;

?>

<? if(isset($success)): ?>

<div class="alert alert-success" role="alert">
  Book was edited successfully. 
  
  <?
  $customUrl = Yii::$app->getUrlManager()->createUrl(['/', 'id' => $model['id']]);
  echo Html::a('Back to all books', $customUrl, [
      'class' => 'btn btn-primary',
      'role' => 'button',
      'title' => 'Back to all books'
  ]);
  
  ?>
</div>

<? else: ?>

<div class="site-editbook">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'name')->textInput(['value' => $data['name']])->label('Name') ?>

                <?= Html::beginTag('div', ['class' => 'form-group field-mail-cc']) ?>
                <?= Html::label('Authors:', 'Authors', ['class' => 'control-label']) ?>
                <?= Html::textInput('Books[authors]', '', ['id' => 'books-authors', 'class' => 'form-control']) ?>
                <?= Html::endTag('div') ?>

                <div class="load-authors"></div>

                <?= $form->field($model, 'pages')->textInput(['value' => $data['pages']])->label('Number of pages') ?>

                <?= $form->field($model, 'year')->textInput(['value' => $data['year']])->label('Year pubished') ?>

                <div class="form-group">
                    <?= Html::submitButton('Edit', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<? endif; ?>