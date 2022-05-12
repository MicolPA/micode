<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "configuracion".
 *
 * @property int $id
 * @property string $empresa
 * @property string $favicon
 * @property string $logo_general_url
 * @property string|null $logo_factura_url
 * @property string|null $codigo_factura
 * @property string|null $color_pie_factura
 * @property string|null $color_precio_total_factura
 * @property string|null $texto_pie_factura
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $impuestos
 * @property string|null $rnc
 * @property string|null $ncf
 */
class Configuracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'configuracion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['empresa'], 'required'],
            [['empresa', 'codigo_factura', 'color_pie_factura', 'color_precio_total_factura', 'texto_pie_factura', 'direccion', 'telefono', 'impuestos', 'rnc', 'ncf', 'color_texto_factura', 'nota_factura'], 'string', 'max' => 255],
            [['logo_general_tipo', 'correo', 'tasa_dolar', 'codigo_cotizacion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa' => 'Empresa',
            // 'favicon' => 'Favicon',
            // 'logo_general_url' => 'Logo General Url',
            // 'logo_factura_url' => 'Logo Factura Url',
            'codigo_factura' => 'Código Factura (Prefijo)',
            'color_pie_factura' => 'Color Pie',
            'color_precio_total_factura' => 'Color Precio Total',
            'texto_pie_factura' => 'Texto Pie',
            'direccion' => 'Dirección',
            'telefono' => 'Teléfono',
            'impuestos' => 'Impuestos (%)',
            'rnc' => 'RNC',
            'ncf' => 'NCF',
            'logo_general_tipo' => 'Tipo de logo'
        ];
    }
}
