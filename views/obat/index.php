<?php
/* @var $this yii\web\View */

use app\models\User;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap5\ActiveForm;

$this->title = 'Admin Dashboard';
$this->params['breadcrumbs'][] = $this->title;

// Get total users count
$totalUsers = \app\models\User::find()->count();
?>
<div class="dashboard-admin">
    <div class="jumbotron text-center bg-transparent mt-4">
        <h1 class="display-4">Admin Dashboard</h1>
        <p class="lead">Selamat datang di panel admin, <?= Html::encode(Yii::$app->user->identity->fullname ?: Yii::$app->user->identity->username) ?>!</p>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Admin Menu</h5>
                </div>
                <div class="list-group list-group-flush">
                    <?= Html::a('Dashboard', ['dashboard/admin'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pengguna', ['dashboard/akunpengguna'], ['class' => 'list-group-item list-group-item-action ']) ?>
                    <?= Html::a('Wilayah', ['wilayah/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Obat', ['obat/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                    <?= Html::a('Database', ['db/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Keamanan', ['security/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Obat</h5>
                </div>
                <div class="card-body">
                    <p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
                            Tambah Obat
                        </button>
                    </p>

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Fullname</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>