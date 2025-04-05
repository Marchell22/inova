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
                    <?= Html::a('tindakan', ['tindakan/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Obat', ['obat/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Pegawai', ['pegawai/index'], ['class' => 'list-group-item list-group-item-action']) ?>
                    <?= Html::a('Tindakan', ['tindakan/index'], ['class' => 'list-group-item list-group-item-action active']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Daftar Tindakan</h5>
                </div>
                <div class="card-body">
                    <p>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createTindakanModal">
                            Tambah Tindakan
                        </button>
                    </p>

                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tindakan as $i => $d): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= Html::encode($d->kode) ?></td>
                                    <td><?= Html::encode($d->nama) ?></td>
                                    <td><?= Html::encode($d->harga) ?></td>

                                    <td>
                                        <?= Html::button('Edit', [
                                            'class' => 'btn btn-warning btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#editTindakanModal',
                                            'data-id' => $d->id,
                                            'data-kode' => $d->kode,
                                            'data-nama' => $d->nama,
                                            'data-harga' => $d->harga,
                                        ]) ?>

                                        <?= Html::button('Delete', [
                                            'class' => 'btn btn-danger btn-sm',
                                            'data-bs-toggle' => 'modal',
                                            'data-bs-target' => '#deleteTindakanModal',
                                            'data-id' => $d->id,
                                            'data-nama' => $d->nama,
                                        ]) ?>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tambah Tindakan -->
<div class="modal fade" id="createTindakanModal" tabindex="-1" aria-labelledby="createTindakanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php \yii\widgets\Pjax::begin(['id' => 'form-tindakan']); ?>
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="createTindakanModalLabel">Tambah Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <?= \yii\helpers\Html::beginForm(['tindakan/create'], 'post') ?>
                <div class="mb-3">
                    <label for="kode-tindakan" class="form-label">Kode</label>
                    <input type="text" name="kode" class="form-control" id="kode-tindakan" required>
                </div>
                <div class="mb-3">
                    <label for="nama-tindakan" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama-tindakan" required>
                </div>
                <div class="mb-3">
                    <label for="harga-tindakan" class="form-label">Harga</label>
                    <input type="number" step="0.01" name="harga" class="form-control" id="harga-tindakan" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                <?= \yii\helpers\Html::endForm() ?>
            </div>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
</div>
<!-- Modal Edit Tindakan -->
<div class="modal fade" id="editTindakanModal" tabindex="-1" aria-labelledby="editTindakanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?php \yii\widgets\Pjax::begin(['id' => 'form-edit-tindakan']); ?>
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="editTindakanModalLabel">Edit Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <?= \yii\helpers\Html::beginForm(['tindakan/update'], 'post') ?>
                <input type="hidden" name="id" id="edit-tindakan-id">
                <div class="mb-3">
                    <label for="edit-kode-tindakan" class="form-label">Kode</label>
                    <input type="text" name="kode" class="form-control" id="edit-kode-tindakan" required>
                </div>
                <div class="mb-3">
                    <label for="edit-nama-tindakan" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="edit-nama-tindakan" required>
                </div>
                <div class="mb-3">
                    <label for="edit-harga-tindakan" class="form-label">Harga</label>
                    <input type="number" step="0.01" name="harga" class="form-control" id="edit-harga-tindakan" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <?= \yii\helpers\Html::endForm() ?>
            </div>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>
</div>
<?php
$this->registerJs(<<<JS
    $('#editTindakanModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        $('#edit-tindakan-id').val(button.data('id'));
        $('#edit-kode-tindakan').val(button.data('kode'));
        $('#edit-nama-tindakan').val(button.data('nama'));
        $('#edit-harga-tindakan').val(button.data('harga'));
    });
JS);
?>

<!-- Modal Hapus tindakan -->
<div class="modal fade" id="deleteTindakanModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus tindakan <strong id="namatindakanHapus"></strong>?</p>
                <input type="hidden" id="tindakanIdHapus">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="hapustindakanBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs(<<<JS
$('#deleteTindakanModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var nama = button.data('nama');

    $('#tindakanIdHapus').val(id);
    $('#namatindakanHapus').text(nama);
});

$('#hapustindakanBtn').on('click', function () {
    var id = $('#tindakanIdHapus').val();

    $.ajax({
        url: '/tindakan/delete?id=' + id,
        type: 'POST',
        success: function (response) {
            if (response.success) {
                $('#deletetindakanModal').modal('hide');
                location.reload(); // atau update table via JS
            } else {
                alert('Gagal menghapus data.');
            }
        },
        error: function () {
            alert('Terjadi kesalahan saat menghapus data.');
        }
    });
});
JS);
?>