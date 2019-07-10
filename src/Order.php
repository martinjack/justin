<?php

namespace Justin;

use Exception;
use Justin\Contracts\iOrder;
use Justin\Data;
use Justin\Exceptions\JustinOrderException;

/**
 *
 * Class Order
 *
 * @package Justin
 *
 */
class Order extends Filter implements iOrder
{

    /**
     *
     * ORDER API
     *
     * @var ARRAY
     *
     */
    protected $orderApi = [

        0 => 'https://api.justin.ua',

    ];
    /**
     *
     * DATA ORDER
     *
     * @var ARRAY
     *
     */
    protected $dataOrder = [];
    /**
     *
     * CARGO LIST
     *
     * @var ARRAY
     *
     */
    private $cargoList = [];
    /**
     *
     * AMOUNT CARGO
     *
     * @var INTEGER
     *
     */
    private $amountCargo = 0;
    /**
     *
     * SET ORDER VERSION API
     *
     * @param BOOLEAN $sandbox
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function orderVersion($sandbox = false, $version = 'v1')
    {

        if (!$sandbox) {

            $this->orderApi[1] = "api_pms/hs/api/${version}";

        } else {

            $this->orderApi[1] = "api_pms_demo/hs/api/${version}";

        }

        $this->orderApi[2] = 'documents/orders';

        return $this;

    }
    /**
     *
     * CHECK FIELDS ORDER
     *
     * @throws JustinOrderException
     *
     * @return BOOLEAN
     *
     */
    protected function checkFieldsOrder()
    {
        ##
        # CHECK COD TYPE
        #
        $error = null;

        switch (true) {

            ##
            # CHECK DELIVERY TYPE 1 - C2C
            #
            case (

                    isset($this->dataOrderOrder['data']['cod_transfer_type'])

                    &&

                    !isset($this->dataOrderOrder['data']['delivery_type'])

                ) ? true : false:

                $error = 'Please add field "delivery_type or deliveryType()"';

                break;
            case (

                    isset($this->dataOrder['data']['delivery_type'])

                    &&

                    $this->dataOrder['data']['delivery_type'] == 1

                    &&

                    !isset($this->dataOrder['data']['cod_transfer_type'])

                ) ? true : false:

                $error = 'Please add field "cod_transfer_type or codType()"';

                break;
            ##
            # CHECK COD CARD NUMBER
            #
            case (

                    isset($this->dataOrder['data']['cod_transfer_type'])

                    &&

                    $this->dataOrder['data']['cod_transfer_type'] == 1

                    &&

                    !isset($this->dataOrder['data']['cod_card_number'])

                ) ? true : false:

                $error = 'Please add field "cod_card_number or cardNumber()"';

                break;
            #
            case (

                    isset($this->dataOrder['data']['pick_up_is_required'])

                    &&

                    !$this->dataOrder['data']['pick_up_is_required']

                    &&

                    !isset($this->dataOrder['data']['sender_branch'])

                ) ? true : false:

                $error = 'Please add field "sender_branch or senderBranchID()"';

            case (

                    isset($this->dataOrder['data']['cargo_places_array'])

                ) ? true : false:

                foreach ($this->dataOrder['data']['cargo_places_array'] as $key => $cargo) {

                    if (!isset($cargo['marking'])) {

                        $error = 'Please add field "marking". Cargo: ' . $key;

                    } elseif (!isset($cargo['weight'])) {

                        $error = 'Please add field "weight". Cargo: ' . $key;

                    }

                }

                break;

        }

        if ($error) {

            throw new JustinOrderException(

                $error

            );

        }

        return true;

    }
    /**
     *
     * SET UNIQUE NUMBER
     * УКАЗЫВАЕМ УНИКАЛЬНЫЙ НОМЕР ЗАКАЗА
     * ВКАЗУЄМО УНІКАЛЬНІЙ НОМЕР ЗАМОВЛЕННЯ
     *
     * @param STRING $number
     *
     * @return OBJECT
     *
     */
    public function setNumber($number)
    {

        $this->dataOrder['number'] = $number;

        return $this;

    }
    /**
     *
     * SET DATE
     * УКАЗЫВАЕМ ДАТУ ОФОРМЛЕНИЯ ЗАКАЗА
     * ВКАЗУЄМО ДАТУ ОФОРМЛЕННЯ ЗАМОВЛЕННЯ
     *
     * true = 2019-03-21
     * false = 20190321
     *
     * @param BOOELAN $format
     *
     * @return OBJECT
     *
     */
    public function setDate($format = false)
    {

        if (!$format) {

            $this->dataOrder['date'] = date('Ymd');

        } else {

            $this->dataOrder['date'] = date('Y-m-d');

        }

        return $this;

    }
    /**
     *
     * SET CITY ID
     * УКАЗЫВАЕМ ИД ГОРОДА ОТПРАВИТЕЛЯ
     * ВКАЗУЄМО ІД МІСТА ВІДПРАВНИКА
     *
     * @param STRING $cityID
     *
     * @return OBJECT
     *
     */
    public function senderCityID($cityID)
    {

        $this->dataOrder['sender_city_id'] = $cityID;

        return $this;

    }
    /**
     *
     * SET SENDER
     * УКАЗЫВАЕМ ФИО ИЛИ НАЗВАНИЕ ПРОДАВЕВЦА
     * ВКАЗУЄМО ПІП АБО НАЗВУ ПРОДАВЦЯ
     *
     * @param String $val
     *
     * @return OBJECT
     *
     */
    public function sender($val)
    {

        $this->dataOrder['sender_company'] = $val;

        return $this;

    }
    /**
     *
     * SET SENDER CONTACT
     * УКАЗЫВАЕМ ФИО ОТПРАВИТЕЛЯ
     * ВКАЗУЄМО ПІП ВІДПРАВНИКА
     *
     * @param STRING $contact
     *
     * @return OBJECT
     *
     */
    public function senderContact($contact)
    {

        $this->dataOrder['sender_contact'] = $contact;

        return $this;

    }
    /**
     *
     * SET SENDER PHONE
     * УКАЗЫВАЕМ ТЕЛЕФОН ОТПРАВИТЕЛЯ
     * ВКАЗУЄМО ТЕЛЕФОН ВІДРАВНИКА
     *
     * @return OBJECT
     *
     */
    public function senderPhone($phone)
    {

        $this->dataOrder['sender_phone'] = $phone;

        return $this;

    }
    /**
     *
     * SET SENDER BRANCH ID
     * УКАЗЫВАЕМ НОМЕР ОТДЕЛЕНИЯ ОТПРАВИТЕЛЯ
     * ВКАЗУЄМО НОМЕР ВІДДІЛЕННЯ ВІДПРАВНИКА
     *
     * @return OBJECT
     *
     */
    public function senderBranchID($id)
    {

        $this->dataOrder['sender_branch'] = $id;

        return $this;

    }
    /**
     *
     * SET RECEIVER
     * УКАЗЫВАЕМ НАЗВАНИЕ ИЛИ ФИО ПОЛУЧАТЕЛЯ
     * ВКАЗУЄМО НАЗВУ АБО ПІП ОТРИМУВАЧА
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function receiver($val)
    {

        $this->dataOrder['receiver'] = $val;

        return $this;

    }
    /**
     *
     * SET RECEIVER CONTACT
     * УКАЗЫВАЕМ ФИО КОНТАКТА ПОЛУЧАТЕЛЯ
     * ВКАЗУЄМО ПІП КОНТАКТУ ОТРИМУВАЧА
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function receiverContact($val)
    {

        $this->dataOrder['receiver_contact'] = $val;

        return $this;

    }
    /**
     *
     * SET RECEIVER PHONE
     * УКАЗЫВАЕМ ТЕЛЕФОН ПОЛУЧАТЕЛЯ
     * ВКАЗУЄМО ТЕЛЕФОН ОТРИМУВАЧА
     *
     * @param STRING $phone
     *
     * @return OBJECT
     *
     */
    public function receiverPhone($phone)
    {

        $this->dataOrder['receiver_phone'] = $phone;

        return $this;

    }
    /**
     *
     * SET RECEIVER BRANCH ID
     * УКАЗЫВАЕМ НОМЕР ОТДЕЛЕНИЯ ПОЛУЧАТЕЛЯ
     * ВКАЗУЄМО НОМЕР ВІДДІЖЕННЯ ОТРИМУВАЧА
     *
     * @param STRING
     *
     * @return OBJECT
     *
     */
    public function receiverBranchID($id)
    {

        $this->dataOrder['branch'] = $id;

        return $this;

    }
    /**
     *
     * SET ADDRESS PICKUP ORDER
     * УКАЗЫВАЕМ, АДРЕС ПОЛУЧЕНИЯ (ЗАБОРА) ЗАКАЗА
     * ВКАЗУЄМО, АДРЕСУ ОТРИМАННЯ (ЗАБОРУ) ЗАМОВЛЕННЯ
     *
     * @param STRING $address
     *
     * @return OBJECT
     *
     */
    public function addressPickup($address)
    {

        $this->dataOrder['sender_pick_up_address'] = $address;

        return $this;

    }
    /**
     *
     * SET REQUIRE PICK UP ORDER
     * УКАЗЫВАЕМ, НЕОБХОДИМОСТЬ ЗАБРАТЬ ЗАКАЗ У ОТПРАВИТЕЛЯ
     * ВКАЗУЄМО, НЕОБХІДНІСТЬ ЗАБРАТИ ЗАМОВЛЕННЯ У ВІДПРАВНИКА
     *
     * @param BOOLEAN $pickup
     *
     * @return OBJECT
     *
     */
    public function requirePickup($pickup = false)
    {

        $this->dataOrder['pick_up_is_required'] = $pickup;

        return $this;

    }
    /**
     *
     * SET COUNT CARGO PLACE
     * УКАЗЫВАЕМ КОЛИЧЕСТВО ГРУЗОВЫХ МЕСТ
     * ВКАЗУЄМО КІЛЬКІСТЬ ВАНТАЖНИХ МІСЦЬ
     *
     * @param INTEGER $count
     *
     * @return OBJECT
     *
     */
    public function countPlace($count)
    {

        $this->dataOrder['count_cargo_places'] = $count;

        return $this;

    }
    /**
     *
     * SET ARRAY CARGO PLACE.
     * МАССИВ ДАННЫХ ГРУЗОВЫХ МЕСТ. СОДЕРЖИТ МАРКИРОВКИ И ВГХ КАЖДОГО ВМ
     * МАСИВ ДАНИХ ВАНТАЖНИХ МІСЦЬ. ЗБЕРІГАЄ МАРКУВАННЯ І ВГХ КОЖНОГО ВМ
     *
     * @param ARRAY $list
     *
     * @return OBJECT
     *
     */
    public function cargoList($list = [])
    {

        if ($this->cargoList) {

            $list = $this->cargoList;

        }

        $this->dataOrder['cargo_places_array'] = $list;

        ##
        # SET DEFAULT
        #
        $this->cargoList   = [];
        $this->amountCargo = 0;
        #
        return $this;

    }
    /**
     *
     * SET CARGO MARKING
     * КОД МАРКИРОВКИ ВМ
     * КОД МАРКУВАННЯ ВМ
     *
     * @param STRING $marking
     *
     * @return OBJECT
     *
     */
    public function cargoMarking($marking)
    {

        $this->cargoList[$this->amountCargo]['marking'] = $marking;

        return $this;

    }
    /**
     *
     * SET CARGO WEIGHT
     * ВЕС ВМ , кг
     * ВАГА ВМ, кг
     *
     * @param STRING weight
     *
     * @return OBJECT
     *
     */
    public function cargoWeight($weight)
    {

        $this->cargoList[$this->amountCargo]['weight'] = $weight;

        return $this;

    }
    /**
     *
     * SET CARGO WIDTH
     * ШИРИНА ВМ, см
     * ШИРИНА ВМ, см
     *
     * @param STRING $width
     *
     * @return OBJECT
     *
     */
    public function cargoWidth($width)
    {

        $this->cargoList[$this->amountCargo]['width'] = $width;

        return $this;

    }
    /**
     *
     * SET CARGO HEIGHT
     * ВЫСОТА ВМ, см
     * ВИСОТА ВМ, см
     *
     * @param STRING $height
     *
     * @return OBJECT
     *
     */
    public function cargoHeight($height)
    {

        $this->cargoList[$this->amountCargo]['height'] = $height;

        return $this;

    }
    /**
     *
     * SET CARGO DEPTH
     * ГЛУБИНА ВМ, см
     * ГЛИБИНА ВМ, см
     *
     * @param STRING $depth
     *
     * @return OBJECT
     *
     */
    public function cargoDepth($depth)
    {

        $this->cargoList[$this->amountCargo]['depth'] = $depth;

        return $this;

    }
    /**
     *
     * ADD CARGO IN LIST
     * ДОБАВИТЬ ГРУЗ В СПИСОК
     * ДОДАТИ ВАНТАЖ ДО СПИСКУ
     *
     * @return OBJECT
     *
     */
    public function addCargo()
    {

        $this->amountCargo += 1;

        return $this;

    }
    //
    /**
     *
     * SET WEIGHT ORDER
     * УКАЗЫВАЕМ ВЕС ГРУЗА
     * ВКАЗУЄМО ВАГУ ВАНТАЖУ
     *
     * @param INTEGER $weight
     *
     * @return OBJECT
     *
     */
    public function weight($weight)
    {

        $this->dataOrder['weight'] = $weight;

        return $this;

    }
    /**
     *
     * SET VOLUME
     * УКАЗЫВАЕМ ОБЪЕМ ГРУЗА (м3)
     * ВКАЗУЄМО ОБ’ЄМ ВАНТАЖУ (м3)
     *
     * Length * Wight * Height
     *
     * @param STRING $volume
     *
     * @return OBJECT
     *
     */
    public function volume($volume)
    {

        $this->dataOrder['volume'] = $volume;

        return $this;

    }
    /**
     *
     * SET DELIVERY TYPE
     * ТИП ЗАКАЗА
     * ТИП ЗАМОВЛЕННЯ
     *
     * 0 - B2C
     * 1 - C2C
     * 2 - B2B
     * 3 - C2B
     *
     * @param INTEGER $type
     *
     * @return OBJECT
     *
     */
    public function deliveryType($type = 0)
    {

        $this->dataOrder['delivery_type'] = $type;

        return $this;

    }
    /**
     *
     * SET COD TYPE
     * ФОРМА ВЫДАЧИ COD
     * ФОРМА ВИДАЧІ COD
     *
     * 0 - cast settlement   | наличных расчет    | готівковий розрахунок
     * 1 - cashless payments | безналичный расчет | безготівковий розрахунок
     *
     * @param INTEGER $type
     *
     * @return OBJECT
     *
     */
    public function codType($type)
    {

        $this->dataOrder['cod_transfer_type'] = $type;

        return $this;

    }
    /**
     *
     * SET COD CARD NUMBER
     * НОМЕР БАНКОВСКОЙ КАРТЫ ДЛЯ ВЫДАЧИ COD
     * НОМЕР БАНКІВСЬКОЇ КАРТИ ДЛЯ ВИДАЧІ COD
     *
     * @param STRING $number
     *
     * @return OBJECT
     *
     */
    public function cardNumber($number)
    {

        $this->dataOrder['cod_card_number'] = $number;

        return $this;

    }
    /**
     *
     * SET COST DECLARED
     * УКАЗЫВАЕМ СТОИМОСТЬ ЗАКАЗА, ЧТО ДЕКЛАРИРУЕТСЯ
     * ВКАЗУЄМО ВАРТІСТЬ ЗАМОВЛЕННЯ, ЩО ДЕКЛАРУЄТЬСЯ
     *
     * @return OBJECT
     *
     */
    public function costDeclared($cost)
    {

        $this->dataOrder['declared_cost'] = $cost;

        return $this;

    }
    /**
     *
     * SET DELIVERY AMOUNT
     * УКАЗЫВАЕМ СУММУ ЗА ДОСТАВКУ ЗАКАЗА (ГРН)
     * ВКАЗУЄМО СУМУ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ (ГРН)
     *
     * deliveryPay(true) = РАСЧЕТ БУДЕТ ПРОИЗВОДИТСЯ ПО ТАРИФАМ.
     * deliveryPay(true) = РОЗРАХУНОК БУДЕ ПРОВОДИТЬСЯ ПО ТАРИФАМ.
     *
     * @param INTEGER $amount
     *
     * @return OBJECT
     *
     */
    public function deliveryAmount($amount = 0)
    {

        $this->dataOrder['delivery_amount'] = $amount;

        return $this;

    }
    /**
     *
     * SET DELIVERY PAYMENT
     * УКАЗЫВАЕМ, БУДЕТ ЛИ ОПЛАТА ЗА ДОСТАВКУ ЗАКАЗА
     * ВКАЗУЄМО, ЧИ БУДЕ ОПЛАТА ЗА ДОСТАВКУ ЗАМОВЛЕННЯ
     *
     * @param BOOLEAN $pay
     *
     * @return OBJECT
     *
     */
    public function deliveryPay($pay = false)
    {

        $this->dataOrder['delivery_payment_is_required'] = $pay;

        return $this;

    }
    /**
     *
     * SET DELIVERY PAYER
     * 0 - sender   | отправитель | відправник
     * 1 - receiver | получатель  | одержувач
     *
     * УКАЗЫВАЕМ, КТО ПЛАТЕЛЬЩИК ЗА ДОСТАВКУ ЗАКАЗА
     * ВКАЗУЄМО, ХТО ПЛАТНИК ЗА ДОСТАВКУ ЗАМОВЛЕННЯ
     *
     * @param INTEGER $payer
     *
     * @return OBJECT
     *
     */
    public function deliveryPayer($payer = 0)
    {

        $this->dataOrder['delivery_payment_payer'] = $payer;

        return $this;

    }
    /**
     *
     * SET DELIVERY REQUIRE
     * УКАЗЫВАЕМ, НЕОБХОДИМОСТЬ ДОСТАВКИ ЗАКАЗА
     * ВКАЗУЄМО, НЕОБХІДНІСТЬ ДОСТАВКИ ЗАМОВЛЕННЯ
     *
     * @param BOOLEAN $delivery
     *
     * @return OBJECT;
     *
     */
    public function requireDelivery($delivery = false)
    {

        $this->dataOrder['delivery_is_required'] = $delivery;

        return $this;

    }
    /**
     *
     * SET REDELIVERY AMOUNT
     * УКАЗЫВАЕМ СУММУ КОМИССИИ ЗА ДОСТАВКУ ЗАКАЗА (ГРН)
     * ВКАЗУЄМО СУМУ КОМІСІЇ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ (ГРН)
     *
     * redeliveryPay(true) - РАСЧЕТ БУДЕТ ПРОИЗВОДИТСЯ ПО ТАРИФАМ.
     * redeliveryPay(true) - РОЗРАХУНОК БУДЕ ПРОВОДИТЬСЯ ПО ТАРИФАМ.
     *
     * @param INTEGER $amount
     *
     * @return OBJECT
     *
     */
    public function redeliveryAmount($amount)
    {

        $this->dataOrder['redelivery_amount'] = $amount;

        return $this;

    }
    /**
     *
     * SET REDELIVERY PAYMENT
     * УКАЗЫВАЕМ, БУДЕТ ЛИ ОПЛАТА КОМИССИИ ЗА ЗАКАЗ
     * ВКАЗУЄМО, ЧИ БУДЕ ОПЛАТА КОМІСІЇ ЗА ЗАМОВЛЕННЯ
     *
     * @param BOOLEAN $pay
     *
     * @return OBJECT
     *
     */
    public function redeliveryPay($pay = false)
    {

        $this->dataOrder['redelivery_payment_is_required'] = $pay;

        return $this;

    }
    /**
     *
     * SET REDELIVERY PAYER
     *
     * 0 - sender   | отправитель | відправник
     * 1 - receiver | получатель  | одержувач
     *
     * УКАЗЫВАЕМ, КТО ПЛАТЕЛЬЩИК КОМИССИИ
     * ВКАЗУЄМО, ХТО ПЛАТНИК КОМІСІЇ
     *
     * @param INTEGER $payer
     *
     * @return OBJECT
     *
     */
    public function redeliveryPayer($payer = 0)
    {

        $this->dataOrder['redelivery_payment_payer'] = $payer;

        return $this;

    }
    /**
     *
     * SET ORDER AMOUNT
     * УКАЗЫВАЕМ СУММУ ПЛАТЕЖА ЗА ЗАКАЗ (ГРН).
     * ВКАЗУЄМО СУМУ ПЛАТЕЖУ ЗА ЗАМОВЛЕННЯ (ГРН)
     *
     * @param STRING $amount
     *
     * @return OBJECT
     *
     */
    public function orderAmount($amount)
    {

        $this->dataOrder['order_amount'] = $amount;

        return $this;

    }
    /**
     *
     * SET ORDER PAYMENT
     * УКАЗЫВАЕМ, ЧТО НЕОБХОДИМО ОПЛАТИТЬ ЗА ЗАКАЗ (грн.)
     * ВКАЗУЄМО, ЩО НЕОБХІДНО СПЛАТИТИ ЗА ЗАМОВЛЕННЯ (грн.)
     *
     * @param BOOLEAN $pay
     *
     * @return OBJECT
     *
     */
    public function orderPay($pay = false)
    {

        $this->dataOrder['order_payment_is_required'] = $pay;

        return $this;

    }
    /**
     *
     * SET COMMENT
     * УКАЗЫВАЕМ ОПИСАНИЕ ЗАКАЗА
     * ВКАЗУЄМО ОПИС ЗАМОВЛЕННЯ
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function comment($val)
    {

        $this->dataOrder['add_description'] = $val;

        return $this;

    }
}
