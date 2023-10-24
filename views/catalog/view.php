<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Book $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::img($model->photo); ?><br>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'year',
            'description:ntext',
            'isbn',
            ['label' => 'Authors',
                'value' => function (\app\models\Book $model) {
                    $authors = [];
                    foreach ($model->authors as $author) {
                        $authors[] = Html::a($author->full_name, ['/catalog/author', 'id' => $author->id]);
                    }
                    return implode("<br>", $authors);
                },
                'format' => 'raw'
            ]
        ],
    ]) ?>

</div>
