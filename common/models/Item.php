<?php
/* M Tafaquh Fiddin Al Islami | 2110151035 */
namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "item".
 *
 * @property integer $id
 * @property string $image
 * @property string $name
 * @property integer $price
 * @property integer $item_category
 * @property integer $created_at
 * @property string $created_by
 * @property integer $updated_at
 * @property string $updated_by
 *
 * @property ItemCategory $itemCategory
 * @property OrderItem $orderItem
 */
class Item extends \yii\db\ActiveRecord
{
    public $file1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * @inheritdoc
     */
    
    public function behaviors()
    {
        return[
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function BeforeSave($a){
        if(parent::BeforeSave($a)){
            if(Yii::$app->request->isPost){
                $this->file1 = UploadedFile::getInstance($this,'file1');
                    if($this->file1 && $this->validate()){
                        $this->file1->saveAs('upload/'.$this->file1->baseName.'.'.$this->file1->extension);
                        $this->image = 'upload/'.$this->file1->baseName.'.'.$this->file1->extension;
                        return true;
                    
                    }else{
                        $this->addError('file1', 'kesalahan 1');
                        return false;
                    }
            }else{
                $this->addError('file1', 'kesalahan 2');
                return false;
            }
        }else{
            $this->addError('file1', 'kesalahan 3');
            return false;
        }
        
    }

    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['file1'],'file','extensions'=>'jpg, png, gif, jpeg'],
            [['image'],'safe'],
            [['name'], 'string', 'max' => 255],
            [['item_category'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::className(), 'targetAttribute' => ['item_category' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image' => 'Image',
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'item_category' => Yii::t('app', 'Item Category'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'item_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItem()
    {
        return $this->hasOne(OrderItem::className(), ['item_id' => 'id']);
    }
}
