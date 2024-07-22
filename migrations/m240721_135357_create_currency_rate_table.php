<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency_rate}}`.
 */
class m240721_135357_create_currency_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency_rate}}', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer()->notNull(),
            'rate' => $this->decimal(10, 2)->notNull(),
            'date' => $this->date()->notNull(),
        ]);

        // Create foreign key relation
        $this->addForeignKey(
            'fk-currency_rate-currency_id',
            '{{%currency_rate}}',
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
        $this->dropForeignKey('fk-currency_rate-currency_id', '{{%currency_rate}}');
        $this->dropTable('{{%currency_rate}}');
    }
}
