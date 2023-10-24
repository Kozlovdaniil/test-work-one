<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author_book".
 *
 * @property int $id
 * @property int|null $author_id
 * @property int|null $book_id
 */
class AuthorBook extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author_book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'book_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'book_id' => 'Book ID',
        ];
    }
}
