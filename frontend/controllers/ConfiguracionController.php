<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Configuracion;
use frontend\models\ConfiguracionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ConfiguracionController implements the CRUD actions for Configuracion model.
 */
class ConfiguracionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Configuracion models.
     * @return mixed
     */
    public function actionIndexOld()
    {
        $searchModel = new ConfiguracionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Configuracion model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Configuracion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionIndex()
    // {
    //     $model = $this->findModel(1);
    //     if (!$model) {
    //         $model = new Configuracion();
    //         $model->id = 1;
    //     }

    //     if ($model->load(Yii::$app->request->post())) {

    //         $model->impuestos = str_replace("%", '', $model->impuestos);
    //         $model->impuestos = str_replace(",", '.', $model->impuestos);
    //         $model = $this->saveImages($model);

    //         $model->save(false);
    //         // print_r($model->errors);
    //         // exit;
    //         return $this->redirect(['index']);
    //         Yii::$app->session->setFlash('success', "Configuración actualizada correctamente");
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //         'name' => 'Configuración de la empresa',
    //         'template' => '_form',
    //     ]);
    // }
    public function actionFacturacion()
    {
        if (!$model = $this->findModel(1)) {
            $model = new Configuracion();
            $model->id = 1;
        }

        if ($model->load(Yii::$app->request->post())) {

            $model->impuestos = str_replace("%", '', $model->impuestos);
            $model->impuestos = str_replace(",", '.', $model->impuestos);
            $model = $this->saveImages($model);
            $model->save(false);
            return $this->redirect(['facturacion']);
            Yii::$app->session->setFlash('success', "Configuración actualizada correctamente");
        }

        return $this->render('create', [
            'model' => $model,
            'template' => '_facturacion',
            'name' => 'Configuración de facturación'
        ]);
    }


    public function actionEmpresa()
    {
        if (!$model = $this->findModel(1)) {
            $model = new Configuracion();
            $model->id = 1;
        }

        if ($model->load(Yii::$app->request->post())) {

            $model = $this->saveImages($model);
            $model->save(false);
            return $this->redirect(['empresa']);
            Yii::$app->session->setFlash('success', "Configuración actualizada correctamente");
        }

        return $this->render('create', [
            'model' => $model,
            'template' => '_empresa',
            'name' => 'Configuración de la empresa'
        ]);
    }


    function saveImages($model){

        $path = "images/empresa/";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $empresa = str_replace(".", '-', $model->empresa);
        $empresa = str_replace(" ", '-', mb_strtolower($empresa));

        if (UploadedFile::getInstance($model, 'logo_general_url')) {
            $model->logo_general_url = UploadedFile::getInstance($model, 'logo_general_url');
            $imagen = $path . 'logo-' . $empresa . '-'. time() .".". $model->logo_general_url->extension;
            $model->logo_general_url->saveAs($imagen);
            $model->logo_general_url = "/frontend/web/".$imagen;
        }

        if (UploadedFile::getInstance($model, 'favicon')) {
            $model->favicon = UploadedFile::getInstance($model, 'favicon');
            $imagen = $path . 'favicon-' . $empresa . '-'. time() .".". $model->favicon->extension;
            $model->favicon->saveAs($imagen);
            $model->favicon = "/frontend/web/".$imagen;
        }

        if (UploadedFile::getInstance($model, 'logo_factura_url')) {
            $model->logo_factura_url = UploadedFile::getInstance($model, 'logo_factura_url');
            $imagen = $path . 'logo-factura-' . $empresa . '-'. time() .".". $model->logo_factura_url->extension;
            $model->logo_factura_url->saveAs($imagen);
            $model->logo_factura_url = "/frontend/web/".$imagen;
        }

        if (UploadedFile::getInstance($model, 'sello_url')) {
            $model->sello_url = UploadedFile::getInstance($model, 'sello_url');
            $imagen = $path . 'sello-' . $empresa . '-'. time() .".". $model->sello_url->extension;
            $model->sello_url->saveAs($imagen);
            $model->sello_url = "/frontend/web/".$imagen;
        }

        return $model;

    }

    function actionLimpiarCampo($campo=null){

        $model = $this->findModel(1);
        if ($model and $campo) {
            $model["$campo"] = null;
            $model->save();
            Yii::$app->session->setFlash('success', "Removido correctamente");
        }
        return $this->redirect(Yii::$app->request->referrer); 


    }

    /**
     * Updates an existing Configuracion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel(1);
        if (!$model) {
            $model = new Configuracion();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Configuracion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Configuracion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Configuracion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Configuracion::findOne($id)) !== null) {
            return $model;
        }

        // throw new NotFoundHttpException('The requested page does not exist.');
    }
}
