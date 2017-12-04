<?php
/* M Tafaquh Fiddin Al Islami | 2110151035 */
namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id_order
 * @property string $date
 * @property integer $customer_id
 *
 * @property Customer $customer
 * @property OrderItem $orderItem
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'customer_id'], 'required'],
            [['customer_id'], 'integer'],
            [['date'], 'string', 'max' => 100],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id_customer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_order' => Yii::t('app', 'Id Order'),
            'date' => Yii::t('app', 'Date'),
            'customer_id' => Yii::t('app', 'Customer ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id_customer' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['order_id' => 'id_order']);
    }
}
