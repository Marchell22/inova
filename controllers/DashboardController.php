<?php

namespace app\controllers;

use app\models\User;
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
    public function actionAkunpengguna()
    {
        $users = User::find()->all();
        $model = new User();
        return $this->render('akunpengguna', ['users' => $users,  'model' => $model,]);
    }
    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');

        if (!$id) {
            throw new \yii\web\BadRequestHttpException('Missing required parameter: id');
        }

        $model = User::findOne($id);
        if ($model !== null) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'Pengguna berhasil dihapus.');
        } else {
            Yii::$app->session->setFlash('error', 'Pengguna tidak ditemukan.');
        }

        return $this->redirect(['dashboard/akunpengguna']);
    }
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            // Generate hash dari password
            $model->password_hash = Yii::$app->security->generatePasswordHash($model->password);

            // Optional: generate auth_key, dll
            $model->auth_key = Yii::$app->security->generateRandomString();

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Pengguna berhasil ditambahkan.');
                return $this->redirect(['akunpengguna']);
            }
        }
        // Jika tidak redirect, pastikan $model dikirim ke view
        return $this->redirect(['dashboard/akunpengguna']);
    }
    public function actionUpdate($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = User::findOne($id);

        if (!$model) {
            return ['success' => false, 'message' => 'User tidak ditemukan.'];
        }

        $request = Yii::$app->request;

        // Ambil data dari AJAX request (POST)
        $model->username = $request->post('username');
        $model->email = $request->post('email');
        $model->fullname = $request->post('fullname');
        $model->status = $request->post('status');
        $model->updated_at = time();

        $password = $request->post('password');
        if (!empty($password)) {
            $model->password_hash = Yii::$app->security->generatePasswordHash($password);
        }

        if ($model->save()) {
            return ['success' => true, 'message' => 'User berhasil diperbarui.'];
        }

        return [
            'success' => false,
            'message' => 'Gagal memperbarui data.',
            'errors' => $model->getErrors()
        ];
    }
}
