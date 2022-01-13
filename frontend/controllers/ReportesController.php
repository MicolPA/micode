<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Clientes;
use frontend\models\Transacciones;
use frontend\models\TransaccionesDetalle;

class ReportesController extends \yii\web\Controller
{
    public function actionIndex($desde=null, $hasta=null)
    {
        if ($desde > $hasta OR $desde > date("Y-m-d")) {
            Yii::$app->session->setFlash('fail', "La fecha inicial debe ser menor a la final o menor a la fecha actual.");
            $desde = null;
            $hasta = null;
        }
        if (!$desde) {
            $desde = date("d-m-Y",strtotime(date("d-m-Y")." - 6 month")); 
        }
        if (!$hasta) {
            $hasta = date("d-m-Y");
        }
        $from = date("Y-m-d",strtotime($desde)); 
        $hasta = date("Y-m-d",strtotime($hasta)); 
        // exit;
        $meses = $this->get_meses($from, $hasta);
        $importes['ingresos'] = $this->obtener_ingresos_range(1, $from, $hasta);
        $importes['gastos_produccion'] = $this->obtener_ingresos_range(2, $from, $hasta);
        $importes_ganancias = $this->get_ganancias($from, $hasta);
        $data = $this->get_informes_totales($from, $hasta);
        // exit;
        return $this->render('index-old',[
            'desde' => $desde,
            'hasta' => $hasta,
            'data' => $data,
            'meses' => $meses,
            'importes' => $importes,
            'importes_ganancias' => $importes_ganancias,
        ]);
    }

    function get_informes_totales($desde, $hasta){

        $data['ingresos'] = Transacciones::find()->where(['tipo_id' => 1])
        ->andWhere(['>=', 'DATE(fecha_pago)', $desde])
        ->andWhere(['<=', 'DATE(fecha_pago)', $hasta])
        ->sum('total');

        $data['gastos'] = Transacciones::find()
        ->andWhere(['>=', 'fecha_pago', $desde])
        ->andWhere(['<=', 'fecha_pago', $hasta])
        ->andWhere(['in', 'tipo_id', array(2,3)])
        ->andWhere(['colaborador' => 0])->sum('total');

        $data['clientes'] = Clientes::find()
        ->andWhere(['>=', 'date', $desde])
        ->andWhere(['<=', 'date', $hasta])
        ->count();

        $data['colaboradores'] = Transacciones::find()
        ->andWhere(['>=', 'fecha_pago', $desde])
        ->andWhere(['<=', 'fecha_pago', $hasta])
        ->andWhere(['in', 'tipo_id', array(2,3)])
        ->andWhere(['>', 'colaborador', 0])->sum('total');

        $data['ganancias'] = $data['ingresos'] - $data['gastos'];
        return $data;
    }

    function get_importes_tipos(){

        $from = date("d-m-Y",strtotime(date("d-m-Y")." - 6 month")); 

        $data[1] = 0;
        $data[2] = 0;
        $data[3] = 0;

        $transacciones = Transacciones::find()->where(['>=', 'MONTH(fecha_pago)', $from])->all();

        foreach ($transacciones as $trans) {
            
            $data[$trans->tipo_id] += $trans->total;
        }

        return $data;

    }

    function get_meses($desde, $hasta){

        $mesRange= array();
        $start    = (new \DateTime($desde));
        $end      = (new \DateTime($hasta));
        $interval = \DateInterval::createFromDateString('1 month');
        $period   = new \DatePeriod($start, $interval, $end);

        foreach ($period as $date) {
            $fecha = $date->format('m/Y');
            array_push($mesRange, "'".$fecha."'");
        }
        return $mesRange;

    }
    function get_ganancias($desde, $hasta){

        $start    = (new \DateTime($desde))->modify('first day of this month');
        $end      = (new \DateTime($hasta))->modify('first day of next month');
        $interval = \DateInterval::createFromDateString('1 month');
        $period   = new \DatePeriod($start, $interval, $end);

        $mesRange= array();
        $totalRange= array();

        $c = 0;

        foreach ($period as $date) {

            $c++;
            if ($c == 1) {
                $gastos = Transacciones::find()
                ->where(['MONTH(fecha_pago)' => $date->format('m')])
                ->andWhere(['>=', 'fecha_pago', $desde])->andWhere(['<>', 'tipo_id', 1])
                ->andWhere(['<=', 'fecha_pago', $hasta])
                ->sum('total');

                $ingresos = Transacciones::find()
                ->where(['MONTH(fecha_pago)' => $date->format('m'), 'tipo_id' => 1])
                ->andWhere(['>=', 'fecha_pago', $desde])
                ->andWhere(['<=', 'fecha_pago', $hasta])
                ->sum('total');
            }else{
                $gastos = Transacciones::find()
                ->where(['MONTH(fecha_pago)' => $date->format('m'), 'YEAR(fecha_pago)' => $date->format('Y')])
                ->andWhere(['<>', 'tipo_id', 1])
                ->andWhere(['<=', 'fecha_pago', $hasta])
                ->sum('total');

                $ingresos = Transacciones::find()
                ->where(['MONTH(fecha_pago)' => $date->format('m'),'YEAR(fecha_pago)' => $date->format('Y'), 'tipo_id' => 1])
                ->andWhere(['<=', 'fecha_pago', $hasta])
                ->sum('total');
            }

            
            $count = $ingresos - $gastos; 
            $count = $count > 0 ? $count : 0;
            array_push($mesRange,$date->format('m'));
            array_push($totalRange, $count);

        }
        return $tRange = array('total' => $totalRange, 'meses'=>$mesRange);

    }

    function obtener_ingresos_range($tipo, $desde, $hasta){

        $start    = (new \DateTime($desde))->modify('first day of this month');
        $end      = (new \DateTime($hasta))->modify('first day of next month');
        $interval = \DateInterval::createFromDateString('1 month');
        $period   = new \DatePeriod($start, $interval, $end);

        $mesRange= array();
        $totalRange= array();
        $c = 0;
        foreach ($period as $date) {
            $c++;
            if ($c == 1) {
                $count = Transacciones::find()
                ->where(['MONTH(fecha_pago)' => $date->format('m')])
                ->andWhere(['>=', 'fecha_pago', $desde])->andWhere(['tipo_id' => $tipo])
                ->andWhere(['<=', 'fecha_pago', $hasta])
                ->sum('total');
            }else{
                $count = Transacciones::find()->where(['MONTH(fecha_pago)' => $date->format('m'),'YEAR(fecha_pago)' => $date->format('Y'), 'tipo_id' => $tipo])
                ->andWhere(['<=', 'fecha_pago', $hasta])
                ->sum('total');
            }

            
            $count = $count > 0 ? $count : 0;
            array_push($mesRange, $date->format('m'));
            array_push($totalRange, $count);

        }

        return $tRange = array('total' => $totalRange, 'meses'=>$mesRange);

    }

    function get_importes($from, $tipo=null){

        $mesRange= array();
        $totalRange= array();

        $db = Yii::$app->getDb();

        if ($tipo) {
            $created = $db->createCommand("SELECT sum(total) as Total,MONTH(fecha_pago) as Mes,YEAR(fecha_pago) as YEAR from transacciones where fecha_pago >= '$from' and tipo_id = '$tipo' GROUP BY MONTH(fecha_pago) ORDER by fecha_pago ASC")->queryAll();
        }else{
            $created = $db->createCommand("SELECT sum(total) as Total,MONTH(fecha_pago) as Mes,YEAR(fecha_pago) as YEAR from transacciones where fecha_pago >= '$from' GROUP BY MONTH(fecha_pago) ORDER by fecha_pago ASC")->queryAll();
        }


        foreach ($created as $cr){
                
           $m = date('M', mktime(0, 0, 0, $cr['Mes'], 10)) . ", ".$cr['YEAR'];;
           array_push($mesRange,$m);
           array_push($totalRange,$cr['Total']);
        }

        return $tRange = array('total' => $totalRange, 'meses'=>$mesRange);
    }

}
