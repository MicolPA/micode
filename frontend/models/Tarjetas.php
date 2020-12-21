<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tarjetas".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $dinero_total
 *
 * @property TransaccionesDetalle[] $transaccionesDetalles
 */
class Tarjetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarjetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'dinero_total'], 'string', 'max' => 255],
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
            'dinero_total' => 'Dinero Total',
        ];
    }

    /**
     * Gets query for [[TransaccionesDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionesDetalles()
    {
        return $this->hasMany(TransaccionesDetalle::className(), ['tarjeta_id' => 'id']);
    }
}
