<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Pegawai extends ActiveRecord
{
    public static function tableName()
    {
        return 'pegawai';
    }

    public function rules()
    {
        return [
            [['nip', 'nama'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['nip'], 'string', 'max' => 50],
            [['nama', 'jabatan'], 'string', 'max' => 100],
            [['nip'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nip' => 'NIP',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'created_at' => 'Dibuat',
            'updated_at' => 'Diubah',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => new Expression('CURRENT_TIMESTAMP'),
            ],
        ];
    }
}
