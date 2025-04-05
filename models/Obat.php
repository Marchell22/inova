<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "obat".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 * @property float $harga
 * @property string $created_at
 * @property string $updated_at
 */
class Obat extends ActiveRecord
{
    public static function tableName()
    {
        return 'obat';
    }

    public function rules()
    {
        return [
            [['kode', 'nama', 'harga'], 'required'],
            [['kode'], 'string', 'max' => 20],
            [['nama'], 'string', 'max' => 100],
            [['harga'], 'number'],
            [['kode'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode Obat',
            'nama' => 'Nama Obat',
            'harga' => 'Harga',
            'created_at' => 'Dibuat Pada',
            'updated_at' => 'Diubah Pada',
        ];
    }
}
