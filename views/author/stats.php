<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var array $stats */

$this->title = "Year stats";
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    </p>
    <table class="table">
        <tr>
            <th>
                Author
            </th>
            <th>Count</th>
        </tr>
        <?php foreach ($stats as $stat): ?>
            <tr>
                <td>
                    <?= Html::a($stat['full_name'], ['/catalog/author', 'id' => $stat['author_id']]); ?>
                </td>
                <td>
                    <?= $stat['count']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
