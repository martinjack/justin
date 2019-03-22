<?php

namespace Justin\Contracts;

/**
 *
 * Interface iOrder
 *
 * @package Justin
 *
 */
interface iOrder
{

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
    public function __construct($language = 'UA', $sandbox = false, $version = 'v2', $timeout = 60, $connect_timeout = 60, $timezone = 'UTC');
    /**
     *
     * SET ORDER VERSION API
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function orderVersion($version = 'v1');
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
    public function create($data = []);
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
    public function setNumber($number);
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
    public function setDate($format = true);
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
    public function senderCityID($cityID);
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
    public function sender($val);
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
    public function senderContact($contact);
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
    public function receiver($val);
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
    public function receiverContact($val);
    /**
     *
     * SET SENDER PHONE
     * УКАЗЫВАЕМ ТЕЛЕФОН ОТПРАВИТЕЛЯ
     * ВКАЗУЄМО ТЕЛЕФОН ВІДРАВНИКА
     *
     * @return OBJECT
     *
     */
    public function senderPhone($phone);
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
    public function addressReceipt($address);
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
    public function requirePickup($pickup = false);
    /**
     *
     * SET SENDER BRANCH ID
     * УКАЗЫВАЕМ НОМЕР ОТДЕЛЕНИЯ ОТПРАВИТЕЛЯ
     * ВКАЗУЄМО НОМЕР ВІДДІЛЕННЯ ВІДПРАВНИКА
     *
     * @return OBJECT
     *
     */
    public function senderBranchID($id);
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
    public function receiverPhone($phone);
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
    public function countPlace($count);
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
    public function receiverBranchID($id);
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
    public function weight($weight);
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
    public function volume($volume);
    /**
     *
     * SET COST DECLARED
     * УКАЗЫВАЕМ СТОИМОСТЬ ЗАКАЗА, ЧТО ДЕКЛАРИРУЕТСЯ
     * ВКАЗУЄМО ВАРТІСТЬ ЗАМОВЛЕННЯ, ЩО ДЕКЛАРУЄТЬСЯ
     *
     * @return OBJECT
     *
     */
    public function costDeclared($cost);
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
    public function deliveryAmount($amount = 0);
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
    public function deliveryPay($pay = false);
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
    public function deliveryPayer($payer = 0);
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
    public function requireDelivery($delivery);
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
    public function redeliveryAmount($amount);
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
    public function redeliveryPay($pay = false);
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
    public function redeliveryPayer($payer = 0);
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
    public function orderAmount($amount);
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
    public function orderPay($pay = false);
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
    public function comment($val);
}
