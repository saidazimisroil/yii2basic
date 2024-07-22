<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%current_product_price}}`.
 */
class m240721_140641_create_current_product_price_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%current_product_price}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
        ]);

        // Create foreign key relations
        $this->addForeignKey(
            'fk-current_product_price-product_id',
            '{{%current_product_price}}',
            'product_id',
            '{{%product}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-current_product_price-currency_id',
            '{{%current_product_price}}',
            'currency_id',
            '{{%currency}}',
            'id',
            'CASCADE'
        );

        // Insert default data
        $this->batchInsert('{{%current_product_price}}', ['product_id', 'currency_id', 'price'], [
            [1, 1, 10000], // Ticket in RUB
            [1, 2, 10000 / 75], // Ticket in USD assuming 1 USD = 75 RUB
            [2, 1, 5000], // Consultation in RUB
            [2, 2, 5000 / 75], // Consultation in USD assuming 1 USD = 75 RUB
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-current_product_price-product_id', '{{%current_product_price}}');
        $this->dropForeignKey('fk-current_product_price-currency_id', '{{%current_product_price}}');
        $this->dropTable('{{%current_product_price}}');
    }
}
