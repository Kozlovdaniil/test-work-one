<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Book $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="book-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'file')->fileInput() ?>
    <?= $form->field($model, 'author_ids')->widget(\kartik\select2\Select2::class, [
        'model' => $model,
        'attribute' => 'author_ids',
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Author::find()->all(), 'id', 'full_name'),
        'options' => [
            'multiple' => true,
        ],

    ]); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
