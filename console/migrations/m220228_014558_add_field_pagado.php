<?php

use yii\db\Migration;

/**
 * Class m220228_014558_add_field_pagado
 */
class m220228_014558_add_field_pagado extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%facturas_status}}', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string(),
            'color' => $this->string(),
        ], $tableOptions);


        $this->addColumn('{{%facturas}}', 'subtotal', $this->float()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'impuestos', $this->float()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'factura_code', $this->string()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'factura_url', $this->string()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'pdf_generated', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'comprobante', $this->string()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'nota', $this->text()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'status_id', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'orden_id', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'active', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas}}', 'fecha_registro', $this->dateTime()->defaultValue(null));

        $this->addForeignKey('facturaStatus', '{{%facturas}}', 'status_id', '{{%facturas_status}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220228_014558_add_field_pagado cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220228_014558_add_field_pagado cannot be reverted.\n";

        return false;
    }
    */
}
