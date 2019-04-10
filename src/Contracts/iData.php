<?php

namespace Justin\Contracts;

/**
 *
 * Interface iData
 *
 * @package Justin\Contracts
 *
 */
interface iData
{
    /**
     *
     * INIT CLASS
     *
     * @param ARRAY $rawData
     *
     * @return OBJECT
     *
     */
    public function __construct($raw);
    /**
     *
     * GET DATA
     * ДАННЫЕ
     * ДАННІ
     *
     * @throws JustinDataException
     *
     * @return ARRAY
     *
     */
    public function getData();
    /**
     *
     * GET RAW
     * СЫРЬЕ
     * СИРОВИНА
     *
     * @throws JustinDataException
     *
     * @return ARRAY
     *
     */
    public function getRaw();
    /**
     *
     * GET STATUS
     * ПОЛУЧИТЬ СТАТУС ОТВЕТА
     * ОТРИМАТИ СТАТУС ВІДПОВІДІ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function getStatus();
    /**
     *
     * GET RESULT
     * ПОЛУЧИТЬ РЕЗУЛЬТАТ
     * ОТРИМАТИ РЕЗУЛЬТАТ
     *
     * @return STRING | NULL
     *
     */
    public function getResult();
    /**
     *
     * GET CODE ERROR API
     * КОД ОШИБКИ API
     * КОД ПОМИЛКИ API
     *
     * @return INTEGER | NULL
     *
     */
    public function getError();
    /**
     *
     * GET ERRORS
     * СПИСОК ОШИБОК
     * СПИСОК ПОМИЛОК
     *
     * @return ARRAY | NULL
     *
     */
    public function getErrors();
    /**
     *
     * GET MESSAGE API
     * СООБЩЕНИЕ API
     * ПОВІДОМЛЕННЯ API
     *
     * @return STRING | NULL
     *
     */
    public function getMessage();
    /**
     *
     * TOTAL RECORDS
     * КОЛИЧЕСТВО ЗАПИСЕЙ
     * КІЛЬКІСТЬ ЗАПИСІВ
     *
     * @return INTEGER | NULL
     *
     */
    public function totalRecords();
    /**
     *
     * FIELDS
     * ПОЛЯ С ДАННЫМИ
     * ПОЛЯ З ДАНИМИ
     *
     * @return ARRAY
     *
     */
    public function fields();
    /**
     *
     * FIRST ITEM
     * ВЕРНУТЬ ПЕРВЫЙ ЭЛЕМЕНТ МАССИВА
     * ПОВЕРНУТИ ПЕРШИЙ ЕЛЕМЕНТ МАСИВУ
     *
     * @return OBJECT
     *
     */
    public function first();
    /**
     *
     * LAST ITEM
     * ВЕРНУТЬ ПОСЛЕДНИЙ ЭЛЕМЕНТ МАССИВА
     * ПОВЕРНУТИ ОСТАННІЙ ЕЛЕМЕНТ МАСИВУ
     *
     * @return OBJECT
     *
     */
    public function last();
    /**
     *
     * SET NODE OWNER
     * ОПИСАНИЕ КОМПАНИИ-ХОЗАИНА ОТДЕЛЕНИЯ
     * ОПИС КОМПАНІЇ-ВЛАСНИКА ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function owner();
    /**
     *
     * SET NODE REGION
     * ОПИСАНИЕ ОБЛАСТИ ОТДЕЛЕНИЯ
     * ОПИС ОБЛАСТІ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function region();
    /**
     *
     * SET NODE CITY
     * ОПИСАНИЕ НАСЕЛЕННОГО ПУНКТА ОТДЕЛЕНИЯ
     * ОПИС НАСЕЛЕНОГО ПУНКТУ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function city();
    /**
     *
     * SET NODE LOCALITY
     * ОПИСАНИЕ РАЙОНА ОТДЕЛЕНИЯ
     * ОПИС РАЙОНУ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function locality();
    /**
     *
     * SET NODE KNOT
     * СВЯЗЬ С ОТДЕЛЕНИЕМ
     * СВЯЗОК З ВІДДІЛЕННЯМ
     *
     * @return OBJECT | NULL
     *
     */
    public function knot();
    /**
     *
     * SET NODE DIRECTION
     * НАПРАВЛЕНИЕ
     * НАПРЯМОК
     *
     * @return OBJECT | NULL
     *
     */
    public function direction();
    /**
     *
     * SET NODE DEPART
     * ОСНОВНЫЕ ДАННЫЕ ОТДЕЛЕНИЯ
     * ОСНОВНІ ДАНІ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function depart();
    /**
     *
     * SET NODE TYPE DEPART
     * ОПИСАНИЕ ТИПА ОТДЕЛЕНИЯ
     * ОПИС ТИПУ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function typeDepart();
    /**
     *
     * SET NODE AREA REGION
     * ОПИСАНИЕ ОБЛАСТНОГО РЕГИОНА
     * ОПИС ОБЛАСНОГО РЕГІОНУ
     *
     * @return OBJECT | NULL
     *
     */
    public function areaRegion();
    /**
     *
     * SET NODE STREET
     * ОПИСАНИЕ УЛИЦЫ ОТДЕЛЕНИЯ
     * ОПИС ВУЛИЦЫ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function street();
    /**
     *
     * SET NODE COUNTERPART
     * ИНФОРМАЦИЯ ПРО ПРОДАВЦА
     * ІНФОРМАЦІЯ ПРО ТОРГОВЦЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function counterpart();
    /**
     *
     * SET NODE ORDER
     * ВНУТРЕННИЙ НОМЕР ЗАКАЗА В СИСТЕМЕ
     * ВНУТРІШНІЙ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
     *
     * @return OBJECT | NULL
     *
     */
    public function order();
    /**
     *
     * SET NODE STATUS ORDER
     * ВНУТРЕННИЙ НОМЕР СТАТУСА ЗАКАЗА В СИСТЕМЕ
     * ВНУТРІШНІЙ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
     *
     * @return OBJECT | NULL
     *
     */
    public function statusOrder();
    /**
     *
     * SET NODE SENDER ID
     * ИНФОРМАЦИЯ ПРО ОТПРАВИТЕЛЯ
     * ІНФОРМАЦІЯ ПРО ВІДПРАВНИКА
     *
     * @return OBJECT | NULL
     *
     */
    public function senderID();
    /**
     *
     * GET UUID
     * ПОЛУЧИТЬ УНИКАЛЬНЫЙ ИД
     * ОТРИМАТИ УНІКАЛЬНИЙ ІД
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getUUID();
    /**
     *
     * GET CODE
     * ПОЛУЧИТЬ КОД
     * ОТРИМАТИ КОД
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getCode();
    /**
     *
     * GET DESCRIPTION
     * ОПИСАНИЕ
     * ОПИС
     *
     * @return STRING | ARRAY
     *
     */
    public function getDescr();
    /**
     *
     * GET SCOATOU
     * КОД КОАТУУ
     *
     * @param STRING $type
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getSCOATOU($type = 'SCOATOU');
    /**
     *
     * GET REGION SCOATOU
     * ПОЛУЧИТЬ КОАТУУ ОБЛАСТИ
     * ОТРИМАТИ КОАТУУ ОБЛАСТІ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getRegionSCOATOU();
    /**
     *
     * GET CITY SCOATUO
     * ПОЛУЧИТЬ КОАТУУ ГОРОДА
     * ОТРИМАТИ КОАТУУ МІСТА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getCitySCOATOU();
    /**
     *
     * GET LOCALITY SCOATOU
     * ПОЛУЧИТЬ КОАТУУ ГОРОДА
     * ОТРИМАТИ КОАТУУ МІСТА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getLocalitySCOATOU();
    /**
     *
     * GET AREA REGION SCOATOU
     * ПОЛУЧИТЬ КОАТУУ ОБЛАСТНОГО РАЙОНА
     * ОТРИМАТИ КОАТУУ ОБЛАСНОГО РАЙОНУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getAreaRegionSCOATOU();
    /**
     *
     * GET TYPE
     * ПОЛУЧИТЬ ТИП
     * ОТРИМАТИ ТИП
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function type();
    /**
     *
     * GET BRANCH ID
     * ПОЛУЧИТЬ ИД ФИЛИАЛА
     * ОТРИМАТИ ІД ФІЛІАЛУ
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function branchID();
    /**
     *
     * GET ADDRESS
     * ПОЛУЧИТЬ АДРЕС ФИЛИАЛА
     * ОТРИМАТИ АДРЕСУ ФІЛІАЛУ
     *
     * @return STRING | NULL
     *
     */
    public function getAddress();
    /**
     *
     * GET POSITION
     * МЕСТОПОЛОЖЕНИЕ ОТДЕЛЕНИЯ
     * МІСЦЕ РОЗТАШУВАННЯ ВІДДІЛЕННЯ
     *
     * @return ARRAY | NULL
     *
     */
    public function getPosition();
    /**
     *
     * GET WEIGHT LIMIT
     * МАКСИМАЛЬНЫЙ ВЕС ОТПРАВЛЕНИЯ ДЛЯ ОТДЕЛЕНИЯ
     * МАКСИМАЛЬНА ВАГА ВІДПРАВЛЕННЯ ДЛЯ ВІДДІЛЕННЯ
     *
     * @return INTEGER | NULL
     *
     */
    public function getWeightLimit();
    /**
     *
     * GET QUERE VISIT
     * ПОРЯДКОВЫЙ НОМЕР ОБХОДА ОТДЕЛЕНИЙ КУРЬЕРОМ
     * ПОРЯДКОВИЙ НОМЕР В ОБХОДЕ ВІДДІЛЕНЬ КУР'ЄРОМ
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getQuereVisit();
    /**
     *
     * GET AGENT
     * true = Branch Justin; false = Branch agent
     * ТИП ОТДЕЛЕНИЯ: true = Отделение Justin; false = Отделение агента
     * ТИП ВІДДІЛЕННЯ: true = Відділення Justin; false = Відділення агента
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function getAgent();
    /**
     *
     * GET PAY CARD
     * ВОЗМОЖНОСТЬ ОПЛАТЫ КАРТОЙ
     * МОЖЛИВІСТЬ ОПЛАТИ КАРТОЮ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function getPayCard();
    /**
     *
     * GET ACCEPT PAY
     * ВОЗМОЖНОСТЬ ОПЛАТИ ПРИ ПОЛУЧЕНИИ ОТПРАВЛЕНИЯ
     * МОЖЛИВІСТЬ ОПЛАТИ ПРИ ОТРИМАННІ ВІДПРАВЛЕННЯ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function getAcceptPay();
    /**
     *
     * GET POSTMAST
     * НАЯВНОСТЬ ПОЧТАМАТА НА ОТДЕЛЕНИИ
     * НАЯВНІСТЬ ПОЧТОМАТУ НА ВІДДІЛЕННІ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function getPostmat();
    /**
     *
     * GET CODE HOLDING
     * НОМЕР ОТДЕЛЕНИЯ В КАЧЕСТВЕ ХОЛДИНГА В СИСТЕМЕ ОРГАНИЗАЦИИ
     * НОМЕР ВІДДІЛЕННЯ В ЯКОСТІ ХОЛДІНГУ В СИСТЕМІ ОРГАНІЗАЦІЇ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getCodeHolding();
    /**
     *
     * GET ID SHEDULER
     * ПОЛУЧИТЬ ИД РАСПИСАНИЯ ОТДЕЛЕНИЯ
     * ОТРИМАТИ ІД РОЗКЛАДУ ВІДДІЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getShedulerID();
    /**
     *
     * GET ID
     * ПОЛУЧИТЬ ИДЕНТИФИКАТОР ОТДЕЛЕНИЯ В СИСТЕМЕ ОРГАНИЗАЦИИ
     * ОТРИМАТИ ІДЕНТИФІКАТОР ВІДДІЛЕННЯ В СИСТЕМІ ОРГАНІЗАЦІЇ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getID();
    /**
     *
     * GET ENUM
     * ТИП ТОЧКИ ОБРАБОТКИ
     * ТИП ТОЧКИ ОБРОБКИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getEnum();
    /**
     *
     * GET VALUE
     * ПОЛУЧИТЬ ЗНАЧЕНИЕ
     * ОТРИМАТИ ЗНАЧЕННЯ
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getValue();
    /**
     *
     * GET DEPART NUMBER
     * ПОЛУЧИТЬ НОМЕР ОТДЕЛЕНИЯ
     * ОТРИМАТИ НОМЕР ВІДДІЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getDepartNumber();
    /**
     *
     * GET HOUSE NUMBER
     * ПОЛУЧИТЬ НОМЕР ДОМА, ГДЕ НАХОДИТСЯ ОТДЕЛЕНИЕ
     * ОТРИМАТИ НОМЕР БУДИНКУ, ДЕ ЗНАХОДИТЬСЯ ВІДДІЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getHouseNumber();
    /**
     *
     * GET LOGIN
     * ПОЛУЧИТЬ ЛОГИН
     * ОТРИМАТИ ЛОГІН
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getLogin();
    /**
     *
     * GET STATUS DATE
     * ПОЛУЧИТЬ ДАТУ И ВРЕМЯ ТЕКУЩЕГО СТАТУСА ЗАКАЗА
     * ОТРИМАТИ ДАТУ ТА ЧАС ПОТОЧНОГО СТАТУСУ ЗАМОВЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getStatusDate();
    /**
     *
     * GET ORDER NUMBER
     * ПОЛУЧИТЬ НОМЕР ЗАКАЗА В СИСТЕМЕ
     * ОТРИМАТИ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getOrderNumber();
    /**
     *
     * GET CLIENT NUMBER
     * ПОЛУЧИТЬ НОМЕР КЛИЕНТА В СИСТЕМЕ
     * ОТРИМАТИ НОМЕР КЛІЄНТА В СИСТЕМІ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getClientNumber();
    /**
     *
     * GET TTN
     * ПОЛУЧИТЬ НОМЕР ТТН
     * ОТРИМАТИ НОМЕР ТТН
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getTTN();
    /**
     *
     * GET DELIVERY DEPARTMENT
     * ПОЛУЧИТЬ ОТДЕЛЕНИЕ ДОСТАВКИ
     * ОТРИМАТИ ВІДДІЛЕННЯ ДОСТАВКИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getDDepartment();
    /**
     *
     * GET ADDRESS DEPARTMENT
     * ПОЛУЧИТЬ АДРЕС ОТДЕЛЕНИЯ ДОСТАВКИ
     * ОТРИМАТИ АДРЕС ВІДДІЛЕННЯ ДОСТАВКИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getADepartment();
    /**
     *
     * GET TTN NEW ORDER
     * ПОЛУЧИТЬ НОМЕР НОВОГО ТТН
     * ОТРИМАТИ НОМЕР НОВОГО ТТН
     *
     * @return STRING
     *
     */
    public function ttn();
    /**
     *
     * GET NUMBER NEW ORDER
     * ПОЛУЧИТЬ НОМЕР
     * ОТРИМАТИ НОМЕР
     *
     * @param STRING $field
     *
     * @return STRING | NULL
     *
     */
    public function number($field = '');
    /**
     *
     * GET DATE
     * ПОЛУЧИТЬ ДАТУ ДОБАВЛЕНИЯ СТАТУСА
     * ОТРИМАТИ ДАТУ ДОДАВАННЯ СТАТУСУ
     *
     * @return STRING | NULL
     *
     */
    public function date();
    /**
     *
     * GET TIME
     * ПОЛУЧИТЬ ВРЕМЯ ДОБАВЛЕНИЕ СТАТУСА
     * ОТРИМАТИ ЧАС ДОДАВАННЯ СТАТУСУ
     *
     * @return STRING | NULL
     *
     */
    public function time();
    /**
     *
     * GET DATE TIME ADDED STATUS
     * ПОЛУЧИТЬ ДАТУ И ВРЕМЯ ДОБАВЛЕНИЯ СТАТУСА
     * ОТРИМАТИ ДАТУ ТА ЧАС ДОДАВАННЯ СТАТУСУ
     *
     * @return STRING | NULL
     *
     */
    public function dateAdded();
    /**
     *
     * GET STATUS
     * ПОЛУЧИТЬ ТЕКУЩИЙ СТАТУС
     * ОТРИМАТИ ПОТОЧНИЙ СТАТУС
     *
     * @return STRING | NULL
     *
     */
    public function status();
    /**
     *
     * GET DEPARTMENT NUMBER
     * ПОЛУЧИТЬ НОМЕР ОТДЕЛЕНИЯ (ЕСЛИ ОТПРАВЛЕНИЕ НАХОДИТСЯ НА ОТДЕЛЕНИИ)
     * ОТПРИМААТИ НОМЕР ВІДДІЛЕННЯ (ЯКЩО ВІДПРАВЛЕННЯ ЗНАХОДИТЬСЯ НА ВІДДІЛЕННІ)
     *
     * @return STRING | NULL
     *
     */
    public function deparNumber();
    /**
     *
     * GET DEPARTMENT ADDRESS
     * ПОЛУЧИТЬ АДРЕС ОТДЕЛЕНИЯ (ЕСЛИ ОТПРАВЛЕНИЕ НАХОДИТСЯ НА ОТДЕЛЕНИИ)
     * ОТРИМАТИ АДРЕСУ ВІДДІЛЕННЯ (ЯКЩО ВІДПРАВЛЕННЯ ЗНАХОДИТЬСЯ НА ВІДДІЛЕННІ)
     * @return STRING | NULL
     *
     */
    public function deparAddress();
    /**
     *
     * GET ADDRESS
     * ПОЛУЧИТЬ АДРЕС
     * ОТРИМАТИ АДРЕС
     *
     * @return STRING | NULL
     *
     */
    public function address();
    /**
     *
     * GET LOCALITY
     * ПОЛУЧИТЬ НАЗВАНИЕ ГОРОД
     * ОТРИМАТИ НАЗВУ ГОРОДА
     *
     * @return STRING | NULL
     *
     */
    public function getLocality();
    /**
     *
     * GET TYPE DEPARTMENT
     * ПОЛУЧИТЬ ТИП ОТДЕЛЕНИЯ
     * ОТРИМАТИ ТИП ВІДДІЛЕННЯ
     * @return STRING | NULL
     *
     */
    public function format();
    /**
     *
     * GET SCHEDULE DEPARTMENT DESCRIPTION
     * ПОЛУЧИТЬ ОПИСАНИЕ ГРАФИКА ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОПИС ГРАФІКУ ВІДДІЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function scheduDescr();
    /**
     *
     * GET DISTANCE
     * РАССТОЯНИЕ ДО ОТДЕЛЕНИЯ НА КАРТЕ (КМ)
     * ВІДСТАНЬ ДО ВІДДІЛЕННЯ НА КАРТІ (КМ)
     *
     * @return STRING | NULL
     *
     */
    public function distance();
    /**
     * GET SHORT NAME
     * ПОЛУЧИТЬ КОРОТКОЕ НАЗВАНИЕ
     * ОТРИМАТИ КОРОТКЕ НАЗВУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function shortName();
    /**
     *
     * GET DATA
     * ПОЛУЧИТЬ ДАТУ
     * ОТРИМАТИ ДАТУ
     *
     * @param BOOLEAN $parse
     *
     * @param BOOLEAN $timestamp
     *
     * @param INTEGER $type
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function data($parse = false, $timestamp = true, $type = 0);
    /**
     *
     * GET BEGINNING WORK
     * ПОЛУЧИТЬ ВРЕМЯ НАЧАЛО РАБОЧЕГО ДНЯ
     * ОТРИМАТИ ЧАС ПОЧАТКУ РОБОЧОГО ДНЯ
     *
     * @param BOOLEAN $parse
     *
     * @param BOOLEAN $timestamp
     *
     * @param INTEGER $type
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function startWork($parse = false, $timestamp = true, $type = 0);
    /**
     *
     * GET END WORK
     * ПОЛУЧИТЬ ВРЕМЯ ОКОНЧАНИЯ РАБОЧЕГО ДНЯ
     * ОТРИМАТИ ЧАС ЗАКІЧЕННЯ РОБОЧЕГО ДНЯ
     *
     * @param BOOLEAN $parse
     *
     * @param BOOLEAN $timestamp
     *
     * @param INTEGER $type
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function endWork($parse = false, $timestamp = true, $type = 0);
    /**
     *
     * GET WORKING DAY
     * ПОЛУЧИТЬ СТАТУС РАБОЧЕГО ДНЯ
     * ОТРИМАТИ СТАТУС РОБОЧОГО ДНЯ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function workDay();
    /**
     *
     * GET NUMBER EN
     * ПОЛУЧИТЬ НОМЕР ЗАКАЗА С PMS СИСТЕМЫ
     * ОТРИМАТИ НОМЕР ЗАМОВЛЕННЯ З PMS СИСТЕМИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function numberEN();
    /**
     *
     * GET NUMBER KIS
     * ПОЛУЧИТЬ НОМЕР ЗАКАЗА С СИСТЕМЫ ПРОДАВЦА
     * ОТРИМАТИ НОМЕР ЗАМОВЛЕННЯ З СИСТЕМИ ТОРГОВЦЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function numberKIS();
    /**
     *
     * GET NUMBER TTN
     * ПОЛУЧИТЬ НОМЕР ТТН ЗАКАЗА
     * ОТРИМАТИ НОМЕР ТТН ЗАМОВЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function numberTTN();
    /**
     *
     * GET SENDER
     * ПОЛУЧИТЬ ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ВІДПРАВНИКА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function sender();
    /**
     *
     * GET RECEIVER
     * ПОЛУЧИТЬ ПОЛУЧАТЕЛЯ
     * ОТРИМАТИ ОТРИМУВАЧА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function receiver();
    /**
     *
     * GET PHONE SENDER
     * ПОЛУЧИТЬ ТЕЛЕФОН ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ТЕЛЕФОН ВІДПРАВНИКА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function phoneSender();
    /**
     *
     * GET PHONE RECEIVER
     * ПОЛУЧИТЬ ТЕЛЕФОН ПОЛУЧАТЕЛЯ
     * ОТРИМАТИ ТЕЛЕФОН ОТРИМУВАЧА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function phoneReceiver();
    /**
     *
     * GET DATE STATUS
     * ПОЛУЧИТЬ ДАТУ СТАТУСА
     * ОТРИМАТИ ДАТУ СТАТУСУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function dateStatus();
    /**
     *
     * GET STATUS UUID
     * ПОЛУЧИТЬ UUID СТАТУСА
     * ОТРИМАТИ UUID СТАТУСА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function statusUUID();
    /**
     *
     * GET SENDER CITY ID
     * ПОЛУЧИТЬ ID ГОРОДА ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ID МІСТА ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderCity();
    /**
     *
     * GET SENDER COMPANY
     * ПОЛУЧИТЬ НАЗВАНИЕ / ФИО ОТПРАВИТЕЛЯ
     * ОТПРИМАТИ НАЗВУ / ПІП ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderCompany();
    /**
     *
     * GET SENDER CONTACT
     * ПОЛУЧИТЬ ФИО ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ПІП ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderContact();
    /**
     *
     * GET ADDRESS SENDER ORDER
     * ПОЛУЧИТЬ АДРЕС ЗАБОРА ЗАКАЗА
     * ОТПРИМАТИ АДРЕСУ ЗАБОРУ ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function addressPickup();
    /**
     *
     * GET STATUS PICKUP ORDER
     * ПОЛУЧИТЬ СТАТУС ЗАБОРА
     * ОТРИМАТИ СТАТУС ЗАБОРУ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function requirePickup();
    /**
     *
     * GET BRANCH SENDER
     * ПОЛУЧИТЬ НОМЕР ОТДЕЛЕНИЯ ОТПРАВИТЕЛЯ
     * ОТРИМАТИ НОМЕР ВІДДІЛЕННЯ ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderBranch();
    /**
     *
     * GET RECEIVER CONTACT
     * ПОЛУЧИТЬ ФИО ПОЛУЧАТЕЛЯ
     * ОТПРИМАТИ ПІП ОТРИМУВАЧА
     *
     * @return STRING | NULL
     *
     */
    public function receiverContact();
    /**
     *
     * GET COUNT PLACE
     * ПОЛУЧИТЬ КОЛИЧЕСТВО ГРУЗОВЫХ МЕСТ
     * ОТРИМАТИ КІЛЬКІСТЬ ВАНТАЖНИХ МІСЦЬ
     *
     * @return STRING | NULL
     *
     */
    public function countPlace();
    /**
     *
     * GET VOLUME
     * ПОЛУЧИТЬ ОБЪЕМ В М3
     * ОТРИМАТИ ОБ'ЄМ В М3
     *
     * @return STRING | NULL
     *
     */
    public function volume();
    /**
     *
     * GET WEIGHT
     * ПОЛУЧИТЬ ВЕС В КГ
     * ОТРИМАТИ ВЕС В КГ
     *
     * @return STRING | NULL
     *
     */
    public function weight();
    /**
     *
     * GET COST DECLARED
     * ПОЛУЧИТЬ ЗАДЕКЛАРИРОВАННУЮ СТОИМОСТЬ ЗАКАЗА
     * ОТРИМАТИ ЗАДЕКЛАРОВАНУ ВАРТІСТЬ ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function costDeclared();
    /**
     *
     * GET DELIVERY AMOUNT
     * ПОЛУЧИТЬ СТОИМОСТЬ ДОСТАВКИ
     * ОТРИМАТИ ВАРТІСТЬ ДОСТАВКИ
     *
     * @return STRING | NULL
     *
     */
    public function deliveryAmount();
    /**
     *
     * GET REDELIVERY AMOUNT
     * ПОЛУЧИТЬ КОМИССИЮ ЗА ДОСТАВКУ ЗАКАЗА
     * ОТРИМАТИ КОМІСІЮ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function redeliveryAmount();
    /**
     *
     * GET ORDER AMOUNT
     * ПОЛУЧИТЬ СУММУ ЗА ЗАКАЗ
     * ОТРИМАТИ СУМУ ЗА ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function orderAmount();
    /**
     *
     * GET DELIVERY PAYMENT
     * ПОЛУЧИТЬ СТАТУС ОПЛАТЫ КОМИССИИ ЗА ЗАКАЗ
     * ОТРИМАТИ СТАТУС ОПЛАТИ КОМІСІЇ ЗА ЗАМОВЛЕННЯ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function redeliveryPay();
    /**
     *
     * GET REDELIVERY PAYER
     * ПОЛУЧИТЬ ПЛАТЕЛЬЩИКА КОМИССИИ
     * ОТРИМАТИ ПЛАТНИКА КОМІСЇ
     *
     * @return INTEGER | NULL
     *
     */
    public function redeliveryPayer();
    /**
     *
     * GET DELIVERY PAYER
     * ПОЛУЧИТЬ СТАТУС ОПЛАТЫ ЗА ДОСТАВКУ ЗАКАЗА
     * ОТРИМАТИ СТАТУС ОПЛАТИ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function deliveryPay();
    /**
     *
     * GET DELIVERY PAYER
     * ПОЛУЧИТЬ ПЛАТЕЛЬЩИКА ДОСТАВКИ ЗАКАЗА
     * ОТРИМАТИ ПЛАТНИКА ДОСТАВКИ ЗАМОВЛЕННЯ
     *
     * @return INTEGER | NULL
     *
     */
    public function deliveryPayer();
    /**
     *
     * GET ORDER PAY
     * ПОЛУЧИТЬ СТАТУС ОПЛАТЫ ЗА ЗАКАЗ
     * ОТРИМАТИ СТАТУС ОПЛАТИ ЗА ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function orderPay();
    /**
     *
     * GET DELIVERY TYPE
     * ПОЛУЧИТЬ ТИП ЗАКАЗА
     * ОТРИМАТИ ТИП ЗАМОВЛЕННЯ
     *
     * @return INTEGER | NULL
     *
     */
    public function deliveryType();
    /**
     *
     * GET CODE TYPE
     * ПОЛУЧИТЬ ТИП ВЫДАЧИ COD
     * ОТРИМАТИ ТИП ВИДАЧІ COD
     *
     * @return INTEGER | NULL
     *
     */
    public function codType();
    /**
     *
     * GET COD CARD NUMBER
     * ПОЛУЧИТЬ НОМЕР КАРТЫ ДЛЯ COD
     * ОТРИМАТИ НОМЕР КАРТИ ДЛЯ COD
     *
     * @return STRING | NULL
     *
     */
    public function cardNumber();
    /**
     *
     * GET DESCRIPTION
     * ПОЛУЧИТЬ ОПИСАНИЕ
     * ОТРИМАТИ ОПИС
     *
     * @return STRING | NULL
     *
     */
    public function description();
    /**
     *
     * GET ADD DESCRIPTION
     * ПОЛУЧИТЬ ДОБАВЛЕНОЕ ОПИСАНИЕ
     * ОТРИМАТИ ДОДАНИЙ ОПИС
     *
     * @return STRING | NULL
     *
     */
    public function addDescription();
    /**
     *
     * GET MARKING CODE
     * ПОЛУЧИТЬ КОД МАРКИРОВКИ
     * ОТРИМАТИ КОД МАРКУВАННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function marking();
    /**
     *
     * GET WIDTH
     * ПОЛУЧИТЬ ШИРИНУ
     * ОТРИМАТИ ШИРИНУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function width();
    /**
     *
     * GET HEIGHT
     * ПОЛУЧИТЬ ВЫСОТУ
     * ОТРИМАТИ ВИСОТУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function height();
    /**
     *
     * GET DEPTH
     * ПОЛУЧИТЬ ГЛУБИНУ, СМ
     * ОТРИМАТИ ГЛИБИНУ, СМ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function depth();
}
