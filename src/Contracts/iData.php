<?php

namespace Justin\Contracts;

/**
 *
 * Interface iData
 *
 * @package Justin
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
    public function getType();
    /**
     *
     * GET BRANCH ID
     * ПОЛУЧИТЬ ИД ФИЛИАЛА
     * ОТРИМАТИ ІД ФІЛІАЛУ
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getBranchID();
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
     * @return STRING
     *
     */
    public function number();
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
}
