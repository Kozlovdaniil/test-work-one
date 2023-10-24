<?php

use app\models\Book;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var \app\models\Author $author */
/** @var bool|\app\models\UserAuthor $subscribed */

$this->title = $author->full_name . ' books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if ($subscribed):?>
    <?=Html::a('Unsubscribe', ['/catalog/unsubscribe', 'id' => $author->id]);?>
    <?php else:?>
    <?=Html::a('Subscribe', ['/catalog/subscribe', 'id' => $author->id]);?>
    <?php endif;?>


    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(
                Html::img($model->photo)
                . '<br>'
                . Html::encode($model->title),
                ['view', 'id' => $model->id]
            );
        },
    ]) ?>


</div>
