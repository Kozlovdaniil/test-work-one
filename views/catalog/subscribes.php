<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\UserAuthor $subscribes */

$this->title = "My subscribes";
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table">
        <tr>
            <th>
                Author
            </th>
        </tr>
        <?php foreach ($subscribes as $subscribe): ?>
            <tr>
                <td>
                    <?= Html::a($subscribe->author->full_name, ['/catalog/author', 'id' => $subscribe->author_id]); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
