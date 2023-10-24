<?php

use yii\db\Migration;

/**
 * Class m231023_202737_add_fk
 */
class m231023_202737_add_fk extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('author_book_fk1', '{{%author_book}}', 'author_id', '{{%author}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('author_book_fk2', '{{%author_book}}', 'book_id', '{{%book}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_author_fk1', '{{%user_author}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('user_author_fk2', '{{%user_author}}', 'author_id', '{{%author}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('author_book_fk1', '{{%author_book}}');
        $this->dropForeignKey('author_book_fk2', '{{%author_book}}');
        $this->dropForeignKey('user_author_fk1', '{{%user_author}}');
        $this->dropForeignKey('user_author_fk2', '{{%user_author}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231023_202737_add_fk cannot be reverted.\n";

        return false;
    }
    */
}
