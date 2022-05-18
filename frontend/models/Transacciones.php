<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "transacciones".
 *
 * @property int $id
 * @property int $tipo_id
 * @property int $servicio_extra_id
 * @property int|null $cliente_id
 * @property int|null $total
 * @property string|null $fecha_pago
 * @property string|null $date
 * @property string|null $concepto
 *
 * @property Clientes $cliente
 * @property TiposImportes $tipo
 * @property ServiciosExtras $servicioExtra
 * @property TransaccionesDetalle[] $transaccionesDetalles
 */
class Transacciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transacciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_id', 'servicio_extra_id', 'cliente_id', 'total'], 'integer'],
            [['fecha_pago', 'date', 'concepto'], 'safe'],
            [['fecha_pago', 'tipo_id', 'total'], 'required'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::className(), 'targetAttribute' => ['cliente_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposImportes::className(), 'targetAttribute' => ['tipo_id' => 'id']],
            [['servicio_extra_id'], 'exist', 'skipOnError' => true, 'targetClass' => ServiciosExtras::className(), 'targetAttribute' => ['servicio_extra_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_id' => 'Tipo importe',
            'servicio_extra_id' => 'Servicio',
            'cliente_id' => 'Cliente',
            'total' => 'Total',
            'fecha_pago' => 'Fecha Pago',
            'date' => 'Date',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TiposImportes::className(), ['id' => 'tipo_id']);
    }

    /**
     * Gets query for [[ServicioExtra]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServicioExtra()
    {
        return $this->hasOne(ServiciosExtras::className(), ['id' => 'servicio_extra_id']);
    }

    /**
     * Gets query for [[TransaccionesDetalles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransaccionesDetalles()
    {
        return $this->hasMany(TransaccionesDetalle::className(), ['transaccion_id' => 'id']);
    }

    function saveTransaccion($factura, $type=1){
        $config = Configuracion::findOne(1);
        $model = Transacciones::find()->where(['factura_id' => $factura->id])->one();
        if (!$model) {
            $model = new Transacciones();
        }elseif($model and $type == 2){
            $model->delete();
            return true;
        }

        $monto_total = FacturasDetalle::find()->where(['factura_id' => $factura->id])->sum('total');
        // $monto_total = $factura->total;
        // echo $monto_total;
        if ($factura->impuestos) {
            echo "AQUI";
            $model->impuestos = $factura->impuestos;
            $itbis = ($model->impuestos * $monto_total ) / 100;
            $monto_total = $monto_total + $itbis; 
        }
        if ($factura->moneda == "USD") {
            $model->tasa_dolar = $config['tasa_dolar'];
            $monto_total = $monto_total * $model->tasa_dolar;
        }
        // echo $monto_total.PHP_EOL;

        $model->tipo_id = 1;
        $model->cliente_id = $factura->cliente_id;
        $model->total = $monto_total;
        $model->fecha_pago = $factura->fecha_pagada ? $factura->fecha_pagada : $factura->date;
        $model->pagada = $factura->pagada;
        $model->date = $factura->date;
        $model->concepto = "Factura - $factura->asunto";
        $model->user_id = $factura->user_id;
        $model->cliente_nombre = $factura->cliente_nombre;
        $model->factura_id = $factura->id;
        // $model->total = $monto_total;
        if (!$model->save()) {
            print_r($model->errors);
            exit;
        }
        return $model;

    }


    function registrarDetalleTransaccion($post, $cuentas, $model, $colaborador_id=null){

        foreach ($cuentas as $cuenta) {

            if (isset($post['cuenta'][$cuenta->id]) or (isset($post['colaborador_amount']) and $cuenta->id == 3)) {
                if ($post['cuenta'][$cuenta->id]) {

                    if ($model->tipo_id == 1) {
                        $cuenta->dinero_total = (float)$cuenta->dinero_total + (float)$post['cuenta'][$cuenta->id];
                    }else{
                        $cuenta->dinero_total = (float)$cuenta->dinero_total - (float)$post['cuenta'][$cuenta->id];
                    }
                    if (isset($post['colaborador_amount']) and $cuenta->id == 3) {
                        $cuenta->dinero_total = $cuenta->dinero_total - $post['colaborador_amount'];
                        
                    }

                    $cuenta->dinero_total = (string)$cuenta->dinero_total;
                    $cuenta->save();

                    $transaccion = TransaccionesDetalle::find()->where(['transaccion_id' => $model->id, 'tarjeta_id' => $cuenta->id])->one();

                    if (!$transaccion) {
                        $transaccion = new TransaccionesDetalle();
                        $transaccion->tarjeta_id = $cuenta->id;
                        $transaccion->transaccion_id = $model->id;
                    }
                    
                    $transaccion->fecha_pago = $model->fecha_pago;
                    $transaccion->cliente_id = $model->cliente_id;
                    $transaccion->total = $post['cuenta'][$cuenta->id];
                    $transaccion->tipo_id = $model->tipo_id;
                    $transaccion->user_id = Yii::$app->user->identity->id;
                    $transaccion->date = date("Y-m-d H:i:s");
                    $transaccion->save();
                    

                }
            }

        }
        if (isset($post['colaborador_amount'])) {
            $this->registrarImporteColaborador($colaborador_id, $post['colaborador_amount'], $model);
        }

    }

    function registrarImporteColaborador($colaborador_id, $amount, $model){
        if ($amount) {
            $transaccion = new TransaccionesDetalle();
            $transaccion->tarjeta_id = null;
            $transaccion->transaccion_id = $model->id;
            $transaccion->fecha_pago = $model->fecha_pago;
            $transaccion->total = $amount;
            $transaccion->tipo_id = $model->tipo_id;
            $transaccion->colaborador_id = $colaborador_id;
            $transaccion->user_id = Yii::$app->user->identity->id;
            $transaccion->date = date("Y-m-d H:i:s");
            if (!$transaccion->save()) {
                print_r($transaccion->errors);
                exit;
            }
        }
    }
}
