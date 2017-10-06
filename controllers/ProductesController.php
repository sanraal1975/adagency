<?php

namespace app\controllers;

use Yii;
use app\models\Productes;
use app\models\Categories;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductesController implements the CRUD actions for Productes model.
 */
class ProductesController extends SiteController
{

    public function init()
    {
        parent::init();
        $this->layout="/main.php";
        if(array_key_exists('isUser',$_SESSION)) { $this->layout="/main2.php"; }
    }

    /**
     * @inheritdoc
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
     * Lists all Productes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Productes::find(),
        ]);

        $categories = new ActiveDataProvider([
            'query' => Categories::find(),
        ]);

        $llista_categories=array();
        foreach ($categories->getModels() as $key => $value) 
        {
            $llista_categories[$value->id]=$categories->getModels()[$key]->descripcio;
        }

        foreach ($dataProvider->getModels() as $key => $value) 
        {
            $dataProvider->getModels()[$key]->categoria_fk=$llista_categories[$dataProvider->getModels()[$key]->categoria_fk];
            if($dataProvider->getModels()[$key]->stock) { $dataProvider->getModels()[$key]->stock='Disponible'; } else { $dataProvider->getModels()[$key]->stock='No Disponible'; }
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Productes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model=$this->findModel($id);
        $categories = new ActiveDataProvider([
            'query' => Categories::find(),
        ]);
        $llista_categories=array();
        foreach ($categories->getModels() as $key => $value) 
        {
            $llista_categories[$value->id]=$categories->getModels()[$key]->descripcio;
        }
        $model->categoria_fk=$llista_categories[$model->categoria_fk];

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Productes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Productes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Productes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Productes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
