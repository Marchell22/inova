<?php

namespace app\controllers;

use Yii;
use app\models\Obat;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ObatController extends Controller
{
    public function actionIndex()
    {
        $obat = Obat::find()->all();
        $model = new Obat();
       return $this->render('index',['model' => $model, 'obat' => $obat]);
    }
    public function actionCreateObat()
    {
        $model = new Obat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Data obat berhasil ditambahkan.');
        } else {
            Yii::$app->session->setFlash('error', 'Gagal menambahkan obat.');
        }

        return $this->redirect(['obat/index']);
    }
    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');
        $obat = Obat::findOne($id);

        if ($obat && $obat->delete()) {
            Yii::$app->session->setFlash('success', 'Obat berhasil dihapus.');
        } else {
            Yii::$app->session->setFlash('error', 'Gagal menghapus obat.');
        }

        return $this->redirect(['obat/index']);
    }
    public function actionUpdate($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = Obat::findOne($id);

        if ($model && $model->load(Yii::$app->request->post(), '') && $model->save()) {
            return ['success' => true];
        }

        return [
            'success' => false,
            'errors' => $model->getErrors(),
        ];
    }
}
