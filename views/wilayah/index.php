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
                    <?= Html::a('Dashboard', ['dashboard/admin'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pengguna', ['dashboard/akunpengguna'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Wilayah', ['wilayah/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                    <?= Html::a('Obat', ['obat/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pegawai', ['pegawai/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Keamanan', ['security/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Wilayah</h5>
                </div>
                <div class="card-body">
                    <p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createWilayahModal">
                            Tambah Wilayah
                        </button>
                    </p>

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Wilayah</th>
                                <th>Kode</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($wilayah as $i => $d): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= Html::encode($d->nama) ?></td>
                                    <td><?= Html::encode($d->kode) ?></td>

                                    <td>
                                        <?= Html::button('Edit', [
                                            'class' => 'btn btn-warning btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#editWilayahModal',
                                            'data-id' => $d->id,
                                            'data-kode' => $d->kode,
                                            'data-nama' => $d->nama,
                                        ]) ?>

                                        <?= Html::button('Delete', [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#deleteWilayahModal',
                                            'data-id' => $d->id,
                                            'data-nama' => $d->nama,
                                        ]) ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Wilayah -->
<div class="modal fade" id="createWilayahModal" tabindex="-1" aria-labelledby="createWilayahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createWilayahLabel">Tambah Wilayah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="wilayah-nama" class="form-label">Nama Wilayah</label>
                    <input type="text" class="form-control" id="wilayah-nama" placeholder="Contoh: Jakarta Selatan">
                </div>
                <div class="mb-3">
                    <label for="wilayah-kode" class="form-label">Kode Wilayah</label>
                    <input type="text" class="form-control" id="wilayah-kode" placeholder="Contoh: JKS">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveWilayahBtn">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editWilayahModal" tabindex="-1" aria-labelledby="editWilayahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editWilayahModalLabel">Edit Wilayah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="editWilayahId">

                <div class="mb-3">
                    <label for="editWilayahKode" class="form-label">Kode Wilayah</label>
                    <input type="text" class="form-control" id="editWilayahKode">
                </div>

                <div class="mb-3">
                    <label for="editWilayahNama" class="form-label">Nama Wilayah</label>
                    <input type="text" class="form-control" id="editWilayahNama">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="saveWilayahChanges">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Wilayah -->
<div class="modal fade" id="deleteWilayahModal" tabindex="-1" aria-labelledby="deleteWilayahLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteWilayahLabel">Konfirmasi Hapus Wilayah</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Apakah yakin ingin menghapus wilayah <strong id="wilayahNamaHapus"></strong>?</p>
                <input type="hidden" id="wilayahIdHapus">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="hapusWilayahBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<JS
$('#saveWilayahBtn').on('click', function() {
    let nama = $('#wilayah-nama').val();
    let kode = $('#wilayah-kode').val();

    $.ajax({
        url: '/wilayah/create',
        method: 'POST',
        data: {
            nama: nama,
            kode: kode,
            _csrf: yii.getCsrfToken()
        },
        success: function(response) {
            if (response.success) {
                alert('Wilayah berhasil ditambahkan');
                $('#createWilayahModal').modal('hide');
                location.reload();
            } else {
                alert('Gagal menyimpan: ' + JSON.stringify(response.errors));
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat menyimpan.');
        }
    });
});
JS);
?>

<?php
$this->registerJs(<<<JS
$('#deleteWilayahModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const id = button.data('id');
    const nama = button.data('nama');
    console.log("Hapus wilayah ID: ", id)

    $('#wilayahIdHapus').val(id);
    $('#wilayahNamaHapus').text(nama);
});

$('#hapusWilayahBtn').on('click', function() {
    const id = $('#wilayahIdHapus').val();


    $.ajax({
        url: '/wilayah/delete?id=' + id,
        method: 'POST',
        data: {
            _csrf: yii.getCsrfToken()
        },
        success: function(response) {
            if (response.success) {
                alert('Wilayah berhasil dihapus.');
                $('#deleteWilayahModal').modal('hide');
                location.reload();
            } else {
                alert('Gagal menghapus wilayah.');
            }
        },
        error: function() {
            alert('Terjadi kesalahan saat menghapus data.');
        }
    });
});
JS);
?>

<?php
$this->registerJs(<<<JS
$('#editWilayahModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);
    const id = button.data('id');
    const kode = button.data('kode');
    const nama = button.data('nama');

    console.log('Edit wilayah id:', id);

    $('#editWilayahId').val(id);
    $('#editWilayahKode').val(kode);
    $('#editWilayahNama').val(nama);
});

$('#saveWilayahChanges').on('click', function () {
    const id = $('#editWilayahId').val();
    const kode = $('#editWilayahKode').val();
    const nama = $('#editWilayahNama').val();

    $.ajax({
        url: '/wilayah/update?id=' + id,
        method: 'POST',
        data: {
            kode: kode,
            nama: nama
        },
        success: function (response) {
            if (response.success) {
                alert('Wilayah berhasil diperbarui!');
                $('#editWilayahModal').modal('hide');
                location.reload();
            } else {
                alert('Gagal memperbarui wilayah.');
                console.log(response.errors);
            }
        },
        error: function () {
            alert('Terjadi kesalahan server.');
        }
    });
});
JS);
?>