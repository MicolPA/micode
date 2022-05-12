<?php

use yii\db\Migration;

/**
 * Class m220512_014601_createTableConfig
 */
class m220512_014601_createTableConfig extends Migration
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

        $this->createTable('{{%configuracion}}', [
            'id' => $this->primaryKey(),
            'empresa' => $this->string()->notNull(),
            'favicon' => $this->string()->notNull(),
            'logo_general_url' => $this->string(),
            'logo_general_tipo' => $this->string(),
            'logo_factura_url' => $this->string(),
            'codigo_factura' => $this->string(),
            'color_pie_factura' => $this->string(),
            'color_precio_total_factura' => $this->string(),
            'texto_pie_factura' => $this->string(),
            'direccion' => $this->string(),
            'telefono' => $this->string(),
            'impuestos' => $this->string(),
            'rnc' => $this->string(),
            'ncf' => $this->string(),
            'sello_url' => $this->string(),
            'correo' => $this->string(),
            'color_texto_factura' => $this->string(),
            'nota_factura' => $this->string(),
            'codigo_cotizacion' => $this->string(),
            'tasa_dolar' => $this->float(),
        ], $tableOptions);

        $this->addColumn('{{%clientes}}', 'direccion', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas_detalle}}', 'cantidad', $this->integer()->defaultValue(null));
        $this->addColumn('{{%facturas_detalle}}', 'total', $this->float()->defaultValue(null));


        $this->addColumn('{{%transacciones}}', 'factura_id', $this->integer()->defaultValue(null));
        // $this->addColumn('{{%transacciones}}', 'impuestos', $this->string()->defaultValue(null));
        $this->addColumn('{{%transacciones}}', 'tasa_dolar', $this->float()->defaultValue(null));
        $this->addColumn('{{%transacciones}}', 'pagada', $this->integer()->defaultValue(null));
        $this->addColumn('{{%transacciones}}', 'cliente_nombre', $this->string()->defaultValue(null));


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220512_014601_createTableConfig cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220512_014601_createTableConfig cannot be reverted.\n";

        return false;
    }
    */
}
