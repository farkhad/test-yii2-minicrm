<?php

namespace frontend\models;

use common\models\Ticket;
use Yii;
use yii\base\Model;

/**
 * TicketForm is the model behind the ticket form.
 */
class TicketForm extends Model
{
    public $client_name;
    public $phone;
    public $comment;
    public $product_name;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_name', 'phone', 'comment', 'product_name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'client_name' => Yii::t('app', 'Client Name'),
            'phone' => Yii::t('app', 'Phone'),
            'comment' => Yii::t('app', 'Commentary'),
            'product_name' => Yii::t('app', 'Product'),
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return null;
        }

        $ticket = new Ticket;
        $ticket->client_name = $this->client_name;
        $ticket->phone = $this->phone;
        $ticket->comment = $this->comment;
        $ticket->product_name = $this->product_name;

        return $ticket->save();
    }
}
