<?php

namespace app\models\repositories;

use app\models\AuthorBook;
use app\models\Book;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class BookRepository
{

    public function getModel(int $id): false|Book
    {
        $model = Book::findOne($id);
        if (!$model) {
            return false;
        }
        $model->author_ids = ArrayHelper::map($model->authors, 'id', 'id');

        return $model;
    }

    public function save(array $request, $id = null): bool
    {
        $book = Book::findOne($id);
        if (!$book) {
            $book = new Book();
        }
        if (!$book->load($request)) {
            return false;
        }

        if ($file = UploadedFile::getInstance($book, 'file')) {
            $file_name = "/uploads/" . time() . '.' . $file->extension;
            $file->saveAs(\Yii::getAlias("@webroot{$file_name}"));
            $book->photo = $file_name;
        }

        if (!$book->save()) {
            return false;
        }

        AuthorBook::deleteAll(['book_id' => $book->id]);
        if ($book->author_ids) {
            foreach ($book->author_ids as $author) {
                $model = new AuthorBook();
                $model->author_id = $author;
                $model->book_id = $book->id;
                $model->save();
            }
        }

        return true;
    }

}