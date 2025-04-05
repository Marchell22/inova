<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Pegawai;
use app\models\User;

/**
 * This is the model class for table "pendaftaran".
 *
 * @property int $id
 * @property string $nama
 * @property string $keluhan
 * @property int $dokter_id
 * @property int $user_id
 * @property string $created_at
 *
 * @property Pegawai $dokter
 * @property User $user
 */
class Pendaftaran extends ActiveRecord
{
    public static function tableName()
    {
        return 'pendaftaran';
    }

    public function rules()
    {
        return [
            [['nama', 'keluhan', 'dokter_id'], 'required'],
            [['keluhan'], 'string'],
            [['dokter_id', 'user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['nama', 'status'], 'string', 'max' => 255],

            // Tindakan dan Obat sebagai opsional
            [['tindakan_id', 'obat_id'], 'integer', 'skipOnEmpty' => true],
            [['tindakan_id', 'obat_id'], 'default', 'value' => null],

            [['harga'], 'number'],
            [['harga'], 'default', 'value' => 0],
            // Foreign key constraints dengan skipOnError dan skipOnEmpty
            [['dokter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::class, 'targetAttribute' => ['dokter_id' => 'id']],
            [['tindakan_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => Tindakan::class, 'targetAttribute' => ['tindakan_id' => 'id']],
            [['obat_id'], 'exist', 'skipOnError' => true, 'skipOnEmpty' => true, 'targetClass' => Obat::class, 'targetAttribute' => ['obat_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama Pasien',
            'keluhan' => 'Keluhan',
            'dokter_id' => 'Dokter',
            'user_id' => 'Didaftarkan Oleh',
            'created_at' => 'Waktu Pendaftaran',
        ];
    }

    public function getDokter()
    {
        return $this->hasOne(Pegawai::class, ['id' => 'dokter_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
    public function getTindakan()
    {
        return $this->hasOne(Tindakan::class, ['id' => 'tindakan_id']);
    }

    public function getObat()
    {
        return $this->hasOne(Obat::class, ['id' => 'obat_id']);
    }
}
