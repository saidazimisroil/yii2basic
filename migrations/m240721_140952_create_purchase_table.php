<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchase}}`.
 */
class m240721_140952_create_purchase_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purchase}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'payment' => $this->decimal(10, 2)->notNull(),
            'product_id' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->notNull(),
        ]);

        // Create foreign key relations
        $this->addForeignKey(
            'fk-purchase-product_id',
            '{{%purchase}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-purchase-currency_id',
            '{{%purchase}}',
            'currency_id',
            '{{%currency}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-purchase-product_id', '{{%purchase}}');
        $this->dropForeignKey('fk-purchase-currency_id', '{{%purchase}}');
        $this->dropTable('{{%purchase}}');
    }
}
