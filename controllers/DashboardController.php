<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class DashboardController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'admin'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'], // Hanya untuk pengguna yang sudah login
                    ],
                    [
                        'actions' => ['admin'],
                        'allow' => true,
                        'roles' => ['admin'], // Hanya untuk admin
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->hasRole('admin');
                        }
                    ],
                    
                ],
            ],
        ];
    }

    /**
     * Dashboard index action.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->hasRole('admin')) {
            return $this->redirect(['dashboard/admin']);
        }

        return $this->render('index');
    }
    public function actionAdmin()
    {
        if (!Yii::$app->user->identity->hasRole('admin')) {
            throw new ForbiddenHttpException('Anda tidak memiliki akses ke halaman ini.');
        }

        return $this->render('admin');
    }
}
