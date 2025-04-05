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
       return $this->render('index');
    }

}
