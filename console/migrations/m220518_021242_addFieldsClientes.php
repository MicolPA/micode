<?php

use yii\db\Migration;

/**
 * Class m220518_021242_addFieldsClientes
 */
class m220518_021242_addFieldsClientes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%clientes}}', 'rnc', $this->string()->defaultValue(null));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220518_021242_addFieldsClientes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220518_021242_addFieldsClientes cannot be reverted.\n";

        return false;
    }
    */
}
