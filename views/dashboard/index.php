<?php
/* @var $this yii\web\View */

$this->title = 'Dashboard User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-index">
    <div class="jumbotron text-center bg-transparent mt-5">
        <h1 class="display-4">Dashboard</h1>
        <p class="lead">Selamat datang di panel dashboard.</p>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Profil
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Informasi Profil</h5>
                        <p>Username: <?= Yii::$app->user->identity->username ?></p>
                        <p>Email: <?= Yii::$app->user->identity->email ?></p>
                        <p>Nama: <?= Yii::$app->user->identity->fullname ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Aktivitas
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Aktivitas Terbaru</h5>
                        <p>Anda login pada: <?= date('d-m-Y H:i:s') ?></p>
                        <!-- Tambahkan informasi aktivitas lainnya disini -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>