<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Clientes".
 *
 * @property integer $idClientes
 * @property string $ci_cliente
 * @property string $nombre
 * @property integer $prioridad
 * @property string $horario_atencion
 * @property integer $telefono
 * @property string $email
 * @property integer $Inmuebles_idInmuebles
 *
 * @property Inmuebles $inmueblesIdInmuebles
 * @property Favoritos[] $favoritos
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ci_cliente', 'nombre', 'prioridad', 'Inmuebles_idInmuebles'], 'required'],
            [['prioridad', 'telefono', 'Inmuebles_idInmuebles'], 'integer'],
            [['ci_cliente'], 'string', 'max' => 8],
            [['nombre'], 'string', 'max' => 500],
            [['horario_atencion'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 100],
            [['Inmuebles_idInmuebles'], 'exist', 'skipOnError' => true, 'targetClass' => Inmuebles::className(), 'targetAttribute' => ['Inmuebles_idInmuebles' => 'idInmuebles']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idClientes' => 'Id Clientes',
            'ci_cliente' => 'Ci Cliente',
            'nombre' => 'Nombre',
            'prioridad' => 'Prioridad',
            'horario_atencion' => 'Horario Atencion',
            'telefono' => 'Telefono',
            'email' => 'Email',
            'Inmuebles_idInmuebles' => 'Inmuebles Id Inmuebles',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInmueblesIdInmuebles()
    {
        return $this->hasOne(Inmuebles::className(), ['idInmuebles' => 'Inmuebles_idInmuebles']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavoritos()
    {
        return $this->hasMany(Favoritos::className(), ['Clientes_idClientes' => 'idClientes']);
    }
}
