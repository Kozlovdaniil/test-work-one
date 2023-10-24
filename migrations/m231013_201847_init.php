<?php

use yii\db\Migration;

/**
 * Class m231013_201847_init
 */
class m231013_201847_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'name' => $this->string(),
            'role' => $this->smallInteger(1)->defaultValue(0),
            'phone' => $this->string(),
            'auth_key' => $this->string()
        ]);

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'year' => $this->integer(4)->notNull(),
            'description' => $this->text(),
            'isbn' => $this->string(),
            'photo' => $this->string()
        ]);

        $this->createTable('{{%user_book}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'book_id' => $this->integer()
        ]);

        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'full_name' => $this->string()
        ]);

        $this->createTable('{{%author_book}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer(),
            'book_id' => $this->integer()
        ]);

        $this->createTable('{{%user_author}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'author_id' => $this->integer()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
        $this->dropTable('{{%book}}');
        $this->dropTable('{{%user_book}}');
        $this->dropTable('{{%author}}');
        $this->dropTable('{{%author_book}}');
        $this->dropTable('{{%user_author}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231013_201847_init cannot be reverted.\n";

        return false;
    }
    */
}
