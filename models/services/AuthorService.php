<?php

namespace app\models\services;

use app\models\AuthorBook;
use app\models\Book;
use yii\db\Query;
use yii\debug\models\search\Db;
use yii\web\UploadedFile;

class AuthorService
{
    public function getYearStats($year, $count = 10)
    {
        $c = \Yii::$app->getDb();
        $command = $c->createCommand("select count(b.id) as count, ab.author_id, a.full_name from book as b 
    left join book_catalog.author_book ab on b.id = ab.book_id 
    left join author as a on a.id = ab.author_id 
    where b.year = '{$year}' 
    GROUP BY (author_id) 
    order by count desc 
    limit {$count}");
        return $command->queryAll();

    }
}