<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%link_ab}}`.
 */
class m200202_125441_create_link_ab_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%link_ab}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer(),
            'author_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%link_ab}}');
    }
}
