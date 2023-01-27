<?php
namespace backend\modules\ticket\models;

use common\models\Ticket;
use Yii;
use yii\base\Model;

class TicketForm extends Model
{
    public $id;
    public $name;
    public $client_name;
    public $phone;
    public $comment;
    public $product_name;
    public $price;
    public $status;
    public $created_at;
    public $updated_at;

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

    public function rules()
    {
        return [
            [['client_name', 'product_name', 'status'], 'required'],
            [['name', 'phone', 'comment', 'price'], 'default'],
            ['price', 'integer'],
            ['status', 'default', 'value' => Ticket::STATUS_ACCEPTED],
            ['status', 'in', 'range' => array_keys(Ticket::getStatusOptions())],
        ];
    }

    public function save($ticket)
    {
        if (!$this->validate()) {
            return null;
        }

        $ticket->name = $this->name;
        $ticket->client_name = $this->client_name;
        $ticket->phone = $this->phone;
        $ticket->product_name = $this->product_name;
        $ticket->price = $this->price;
        $ticket->comment = $this->comment;
        $ticket->status = $this->status;
        return $ticket->save();
    }
}

