<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

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
                    <?= Html::a('<i class="fa fa-tachometer-alt mr-2"></i> Dashboard', ['dashboard/admin'], ['class' => 'list-group-item list-group-item-action active']) ?>
                    <?= Html::a('<i class="fa fa-users mr-2"></i> Pengguna', ['dashboard/akunpengguna'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('<i class="fa fa-cog mr-2"></i> Pengaturan', ['setting/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('<i class="fa fa-chart-bar mr-2"></i> Laporan', ['report/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('<i class="fa fa-database mr-2"></i> Database', ['db/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('<i class="fa fa-shield-alt mr-2"></i> Keamanan', ['security/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 text-white bg-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Total Pengguna</h6>
                                    <h2 class="card-text"><?= $totalUsers ?></h2>
                                </div>
                                <div class="h1"><i class="fa fa-users"></i></div>
                            </div>
                            <?= Html::a('Lihat Detail', ['user/index'], ['class' => 'btn btn-outline-light btn-sm mt-3']) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Pengguna Aktif</h6>
                                    <h2 class="card-text"><?= $totalUsers ?></h2>
                                </div>
                                <div class="h1"><i class="fa fa-user-check"></i></div>
                            </div>
                            <?= Html::a('Lihat Detail', ['user/active'], ['class' => 'btn btn-outline-light btn-sm mt-3']) ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-4 text-white bg-danger">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title">Admin</h6>
                                    <h2 class="card-text">1</h2>
                                </div>
                                <div class="h1"><i class="fa fa-user-shield"></i></div>
                            </div>
                            <?= Html::a('Lihat Detail', ['user/admin'], ['class' => 'btn btn-outline-light btn-sm mt-3']) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Aktivitas Terbaru</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Pengguna</th>
                                    <th>Aktivitas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= date('Y-m-d H:i:s') ?></td>
                                    <td><?= Yii::$app->user->identity->username ?></td>
                                    <td>Login ke sistem</td>
                                    <td><span class="badge bg-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td><?= date('Y-m-d H:i:s', strtotime('-5 minutes')) ?></td>
                                    <td>user1</td>
                                    <td>Registrasi pengguna baru</td>
                                    <td><span class="badge bg-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td><?= date('Y-m-d H:i:s', strtotime('-20 minutes')) ?></td>
                                    <td>user2</td>
                                    <td>Update profil</td>
                                    <td><span class="badge bg-success">Sukses</span></td>
                                </tr>
                                <tr>
                                    <td><?= date('Y-m-d H:i:s', strtotime('-1 hour')) ?></td>
                                    <td>unknown</td>
                                    <td>Percobaan login gagal</td>
                                    <td><span class="badge bg-danger">Gagal</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <?= Html::a('Lihat Semua Aktivitas', ['log/index'], ['class' => 'btn btn-outline-primary']) ?>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="card-title mb-0">Tindakan Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <?= Html::a('<i class="fa fa-user-plus mr-2"></i> Tambah Pengguna', ['user/create'], ['class' => 'btn btn-outline-primary w-100']) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <?= Html::a('<i class="fa fa-database mr-2"></i> Backup Database', ['db/backup'], ['class' => 'btn btn-outline-success w-100']) ?>
                        </div>
                        <div class="col-md-4 mb-3">
                            <?= Html::a('<i class="fa fa-cog mr-2"></i> Pengaturan Sistem', ['setting/system'], ['class' => 'btn btn-outline-danger w-100']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>