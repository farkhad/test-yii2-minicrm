<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * Ticket model
 *
 * @property integer $id
 * @property string $name
 * @property string $client_name
 * @property string $product_name
 * @property string $phone
 * @property string $comment
 * @property integer $price
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Ticket extends ActiveRecord
{
    const STATUS_ACCEPTED = 1;
    const STATUS_DECLINED = 2;
    const STATUS_DEFECT = 3;

    public static function getStatusOptions()
    {
        return [
            self::STATUS_ACCEPTED => Yii::t('app', 'Accepted'),
            self::STATUS_DECLINED => Yii::t('app', 'Declined'),
            self::STATUS_DEFECT => Yii::t('app', 'Defect'),
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Ticket Name'),
            'client_name' => Yii::t('app', 'Client Name'),
            'product_name' => Yii::t('app', 'Product'),
            'comment' => Yii::t('app', 'Commentary'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
            'phone' => Yii::t('app', 'Phone'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ticket}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACCEPTED],
            ['status', 'in', 'range' => array_keys(static::getStatusOptions())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
}
