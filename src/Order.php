<?php

namespace Justin;

use Exception;
use GuzzleHttp\Exception\RequestException;
use Justin\Contracts\iOrder;
use Justin\Data;
use Justin\Exceptions\JustinApiException;

/**
 *
 * Class Order
 *
 */
class Order extends Justin implements iOrder
{

    /**
     *
     * API
     *
     * @var STRING
     *
     */
    private $api = 'http://195.201.72.186/';
    /**
     *
     * DATA ORDER
     *
     * @var ARRAY
     *
     */
    private $data = [];
    /**
     *
     * INIT CLASS
     *
     * @param STRING $language
     *
     * @param BOOLEAN $sandbox
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function __construct($language = 'UA', $sandbox = false, $version = 'v2', $timeout = 60, $connect_timeout = 60, $timezone = 'UTC')
    {

        parent::__construct(

            $language, $sandbox, $version, $timeout, $connect_timeout, $timezone

        );

        return $this
            ->urlOrder()
            ->orderVersion();

    }
    /**
     *
     * URL ORDER
     *
     * @return OBJECT
     *
     */
    private function urlOrder()
    {

        if (!$this->sandbox) {

            $this->api = $this->api . 'api_pms/hs/api/';

        } else {

            $this->api = $this->api . 'api_test/hs/api/';

        }

        return $this;

    }
    /**
     *
     * SET ORDER VERSION API
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function orderVersion($version = 'v1')
    {

        $this->api = $this->api . "{$version}/documents/orders";

        return $this;

    }
    /**
     *
     * CREATE ORDER
     * СОЗДАНИЕ ЗАКАЗА НА ДОСТАВКУ
     * СТВОРЕННЯ ЗАМОВЛЕННЯ НА ДОСТАВКУ
     *
     * @param ARRAY $data
     *
     * @return ARRAY
     *
     */
    public function create($data = [])
    {

        $response = [];
        ##
        # SET DATA
        if ($data) {

            $this->data = $data;

        }
        $this->data = [

            'api_key' => $this->key,

            'data'    => $this->data,

        ];
        #
        try {

            $request = $this->client->post(

                $this->api,

                [

                    'auth' => [

                        $this->auth_login,

                        $this->auth_password,

                    ],

                    'body' => json_encode(

                        $this->data

                    ),

                ]

            );

            $response = json_decode(

                $request->getBody()->getContents(),

                true

            );

            if ($response['result'] == 'error') {

                throw new JustinApiException(

                    'Error API: ' . json_encode(

                        $response

                    )

                );

            }

        } catch (RequestException $exception) {

            switch ($exception->getCode()) {

                case 401:

                    throw new JustinAuthException(

                        'Unauthorized. Please check correct login or password(401)'

                    );

                    break;
                case 502:

                    $error = 'Server response failed. Await!(502)';

                    break;
                default:

                    $error = $exception->getResponse()->getBody()->getContents();

                    break;

            }

            throw new JustinApiException(

                $error

            );

        } catch (Exception $exception) {

            throw new JustinException(

                $exception

            );

        }

        return new Data(

            $response

        );

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

        $this->data['number'] = $number;

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

            $this->data['date'] = date('Ymd');

        } else {

            $this->data['date'] = date('Y-m-d');

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

        $this->data['sender_city_id'] = $cityID;

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

        $this->data['sender_company'] = $val;

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

        $this->data['sender_contact'] = $contact;

        return $this;

    }
    /**
     *
     * SET RECEIVER
     * УКАЗЫВАЕМ ФИО ПОЛУЧАТЕЛЯ
     * ВКАЗУЄМО ПІП ОТРИМУВАЧА
     *
     * @param STRING $val
     *
     * @return OBJECT
     *
     */
    public function receiver($val)
    {

        $this->data['receiver'] = $val;

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

        $this->data['receiver_contact'] = $val;

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

        $this->data['sender_phone'] = $phone;

        return $this;

    }
    /**
     *
     * SET ADDRESS RECEIPT
     * УКАЗЫВАЕМ АДРЕС ПОЛУЧАТЕЛЯ ЗАКАЗА
     * ВКАЗУЄМО АДРЕСУ ОТРИМУВАЧА ЗАМОВЛЕННЯ
     *
     * @param STRING $address
     *
     * @return OBJECT
     *
     */
    public function addressReceipt($address)
    {

        $this->data['sender_pick_up_address'] = $address;

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

        $this->data['pick_up_is_required'] = $pickup;

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

        $this->data['sender_branch'] = $id;

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

        $this->data['receiver_phone'] = $phone;

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

        $this->data['count_cargo_places'] = $count;

        return $this;

    }
    /**
     *
     * SET RECEIVER BRANCH ID
     * УКАЗЫВАЕМ НОМЕР ОТДЕЛЕНИЯ ДОСТАВКИ
     * ВКАЗУЄМО НОМЕР ВІДДІЖЕННЯ ДОСТАВКИ
     *
     * @param STRING
     *
     * @return OBJECT
     *
     */
    public function receiverBranchID($id)
    {

        $this->data['branch'] = $id;

        return $this;

    }
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

        $this->data['weight'] = $weight;

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

        $this->data['volume'] = $volume;

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

        $this->data['declared_cost'] = $cost;

        return $this;

    }
    /**
     *
     * SET DELIVERY AMOUNT
     * УКАЗЫВАЕМ, СУММУ ЗА ДОСТАВКУ ЗАКАЗА (ГРН)
     * ВКАЗУЄМО, СУМУ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ (ГРН)
     *
     * deliveryPayment(true) = РАСЧЕТ БУДЕТ ПРОИЗВОДИТСЯ ПО ТАРИФАМ.
     * deliveryPayment(true) = РОЗРАХУНОК БУДЕ ПРОВОДИТЬСЯ ПО ТАРИФАМ.
     *
     * @param INTEGER $amount
     *
     * @return OBJECT
     *
     */
    public function deliveryAmount($amount = 0)
    {

        $this->data['delivery_amount'] = $amount;

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

        $this->data['delivery_payment_is_required'] = $pay;

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

        $this->data['delivery_payment_payer'] = $payer;

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
    public function requireDelivery($delivery)
    {

        $this->data['delivery_is_required'] = $delivery;

        return $this;

    }
    /**
     *
     * SET REDELIVERY AMOUNT
     * УКАЗЫВАЕМ, СУММУ КОМИССИИ ЗА ДОСТАВКУ ЗАКАЗА (ГРН)
     * ВКАЗУЄМО, СУМУ КОМІСІЇ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ (ГРН)
     *
     * redeliveryPayment(true) - РАСЧЕТ БУДЕТ ПРОИЗВОДИТСЯ ПО ТАРИФАМ.
     * redeliveryPayment(true) - РОЗРАХУНОК БУДЕ ПРОВОДИТЬСЯ ПО ТАРИФАМ.
     *
     * @param INTEGER $amount
     *
     * @return OBJECT
     *
     */
    public function redeliveryAmount($amount)
    {

        $this->data['redelivery_amount'] = $amount;

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

        $this->data['redelivery_payment_is_required'] = $pay;

        return $this;

    }
    /**
     *
     * SET REDELIVERY PAYER
     *
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
    public function redeliveryPayer($payer = 0)
    {

        $this->data['redelivery_payment_payer'] = $payer;

        return $this;

    }
    /**
     *
     * SET ORDER AMOUNT
     * УКАЗЫВАЕМ СУММА ПЛАТЕЖА ЗА ЗАКАЗ (ГРН).
     * ВКАЗУЄМО СУМА ПЛАТЕЖУ ЗА ЗАМОВЛЕННЯ (ГРН)
     *
     * @param STRING $amount
     *
     * @return OBJECT
     *
     */
    public function orderAmount($amount)
    {

        $this->data['order_amount'] = $amount;

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

        $this->data['order_payment_is_required'] = $pay;

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

        $this->data['add_description'] = $val;

        return $this;

    }
}
