<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "facturas_status".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $color
 *
 * @property Facturas[] $facturas
 */
class FacturasStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facturas_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'color' => 'Color',
        ];
    }

    /**
     * Gets query for [[Facturas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFacturas()
    {
        return $this->hasMany(Facturas::className(), ['status_id' => 'id']);
    }
}
