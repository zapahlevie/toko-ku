<?php
/* M Tafaquh Fiddin Al Islami | 2110151035 */
namespace common\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $id_customer
 * @property string $nama
 * @property string $email
 * @property integer $user_id
 *
 * @property User $user
 * @property Order $order
 */
class Customer extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'email'], 'required'],
            [['user_id'], 'integer'],
            [['nama'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 50],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_customer' => Yii::t('app', 'Id Customer'),
            'nama' => Yii::t('app', 'Nama'),
            'email' => Yii::t('app', 'Email'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['customer_id' => 'id_customer']);
    }
}
