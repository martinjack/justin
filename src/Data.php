<?php

namespace Justin;

use Justin\Contracts\iData;
use Justin\Exceptions\JustinDataException;

/**
 *
 * Class Data
 *
 * @package Justin
 *
 */
class Data implements iData
{

    /**
     *
     * DATA
     *
     * @var ARRAY
     *
     */
    private $data = [];
    /**
     *
     * RAW
     *
     * @var ARRAY
     *
     */
    private $raw = [];
    /**
     *
     * FIELDS
     *
     * @var ARRAY
     *
     */
    private $fields = [];
    /**
     *
     * FIRST ITEM
     *
     * @var BOOLEAN
     *
     */
    private $first = false;
    /**
     *
     * LAST ITEM
     *
     * @var BOOLEAN
     *
     */
    private $last = false;
    /**
     *
     * INIT CLASS
     *
     * @param ARRAY $rawData
     *
     * @return OBJECT
     *
     */
    public function __construct($raw)
    {

        $this->raw = $raw;

        if (isset($this->raw['data']) && count($this->raw['data'])) {

            $this->data = $raw['data'];

        } elseif (isset($this->raw['result']) && is_array($this->raw['result'])) {

            $this->data = $raw['result'];

        }

        unset($raw);

        return $this;

    }
    /**
     *
     * GET RAW
     * ПОЛУЧИТЬ СЫРЬЕ ДАННЫЕ ОТВЕТА СЕРВЕРА
     * ОТРИМАТИ СИРІ ДАНІ ВІДПОВІДІ СЕРВЕРУ
     *
     * @throws JustinDataException
     *
     * @return ARRAY
     *
     */
    public function getRaw()
    {

        if (count($this->raw)) {

            return $this->raw;

        }

        throw new JustinDataException(

            'error'

        );

    }
    /**
     *
     * GET DATA
     * ПОЛУЧИТЬ ДАННЫЕ ОТВЕТА API
     * ОТРИМАТИ ДАННІ ВІДПОВІДІ API
     *
     * @throws JustinDataException
     *
     * @return ARRAY
     *
     */
    public function getData()
    {

        if (count($this->data)) {

            return $this->data;

        }

        throw new JustinDataException(

            'No data to display. Empty array data'

        );

    }
    /**
     *
     * GET STATUS
     * ПОЛУЧИТЬ СТАТУС ОТВЕТА
     * ОТРИМАТИ СТАТУС ВІДПОВІДІ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function getStatus()
    {

        $status = null;

        if (isset($this->raw['response']['status'])) {

            $status = $this->raw['response']['status'];

        } elseif (isset($this->raw['status'])) {

            $status = $this->raw['status'];

        }

        return $status;

    }
    /**
     *
     * GET RESULT
     * ПОЛУЧИТЬ РЕЗУЛЬТАТ ЗАПРОСА
     * ОТРИМАТИ РЕЗУЛЬТАТ ЗАПИТУ
     *
     * @return STRING | NULL
     *
     */
    public function getResult()
    {

        return isset($this->raw['result']) ? $this->raw['result'] : null;

    }
    /**
     *
     * GET CODE ERROR API
     * ПОЛУЧИТЬ КОД ОШИБКИ API
     * ОТРИМАТИ КОД ПОМИЛКИ API
     *
     * @return INTEGER | NULL
     *
     */
    public function getError()
    {

        return isset($this->raw['response']['codeError']) ? $this->raw['response']['codeError'] : null;

    }
    /**
     *
     * GET ERRORS
     * ПОЛУЧИТЬ СПИСОК ОШИБОК
     * ОТРИМАТИ СПИСОК ПОМИЛОК
     *
     * @return ARRAY | NULL
     *
     */
    public function getErrors()
    {

        return isset($this->raw['errors']) ? $this->raw['errors'] : null;

    }
    /**
     *
     * GET MESSAGE API
     * ПОЛУЧИТЬ СООБЩЕНИЕ API
     * ОТРИМАТИ ПОВІДОМЛЕННЯ API
     *
     * @return STRING | NULL
     *
     */
    public function getMessage()
    {

        $msg = null;

        if (isset($this->raw['response']['message'])) {

            $msg = $this->raw['response']['message'];

        } elseif (isset($this->raw['msg'])) {

            $msg = $this->raw['msg'];

        }

        return $msg;

    }
    /**
     *
     * TOTAL RECORDS
     * ПОЛУЧИТЬ КОЛИЧЕСТВО ЗАПИСЕЙ
     * ОТРИМАТИ КІЛЬКІСТЬ ЗАПИСІВ
     *
     * @return INTEGER | NULL
     *
     */
    public function totalRecords()
    {

        return isset($this->raw['totalCountRecords']) ? $this->raw['totalCountRecords'] : null;

    }
    /**
     *
     * FIELDS
     * ПОЛУЧИТЬ ПОЛЯ С ДАННЫМИ
     * ОТРИМАТИ ПОЛЯ З ДАНИМИ
     *
     * @return ARRAY
     *
     */
    public function fields()
    {

        $this->fields = [];

        if (isset($this->getData()[0]['fields'])) {

            foreach ($this->data as $key => $item) {

                $this->fields[$key] = $item['fields'];

            }

        } elseif (isset($this->getData()['number']) | isset($this->getData()[0])) {

            foreach ($this->data as $key => $item) {

                $this->fields[$key] = $item;

            }

        }

        return $this;

    }
    /**
     *
     * FIRST ITEM
     * ВЕРНУТЬ ПЕРВЫЙ ЭЛЕМЕНТ МАССИВА ДАННЫХ
     * ПОВЕРНУТИ ПЕРШИЙ ЕЛЕМЕНТ МАСИВУ ДАНИХ
     *
     * @return OBJECT
     *
     */
    public function first()
    {

        $this->first = true;

        return $this;

    }
    /**
     *
     * LAST ITEM
     * ВЕРНУТЬ ПОСЛЕДНИЙ ЭЛЕМЕНТ МАССИВА ДАННЫХ
     * ПОВЕРНУТИ ОСТАННІЙ ЕЛЕМЕНТ МАСИВУ ДАНИХ
     *
     * @return OBJECT
     *
     */
    public function last()
    {

        $this->last = true;

        return $this;

    }
    /**
     *
     * FORMAT DATA
     *
     * @param STRING $field
     *
     * @param BOOLEAN $first
     *
     * @return ARRAY | INTEGER | STRING | NULL
     *
     */
    private function formatData($field)
    {

        $list = [];

        if (count($this->fields) && isset($this->fields[0][$field])) {

            if (count($this->fields) > 1 && $this->first == false) {

                foreach ($this->fields as $key => $item) {

                    $list[$key] = $item[$field];

                }

            } else {

                $list = $this->fields[0][$field];

            }

        } elseif (count($this->fields) && isset($this->fields[$field])) {

            $list = $this->fields[$field];

        } else {

            $list = null;

        }

        ##
        # LAST ITEM
        #
        if (is_array($list)) {

            $list = $this->last ? end($list) : $list;

        }
        #

        return $list;

    }
    /**
     *
     * NODE DATA
     *
     * @param STRING $item
     *
     * @return OBJECT | NULL
     *
     */
    private function nodeData($item)
    {

        if (isset($this->fields[0][$item])) {

            foreach ($this->fields as $key => $field) {

                $this->fields[$key] = $field[$item];

            }

            return $this;

        }

        return null;

    }
    /**
     *
     * SET NODE OWNER
     * ПОЛУЧИТЬ ОПИСАНИЕ КОМПАНИИ-ХОЗАИНА ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОПИС КОМПАНІЇ-ВЛАСНИКА ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function owner()
    {

        return $this->nodeData(

            'objectOwner'

        );

    }
    /**
     *
     * SET NODE REGION
     * ПОЛУЧИТЬ ОПИСАНИЕ ОБЛАСТИ ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОПИС ОБЛАСТІ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function region()
    {

        return $this->nodeData(

            'region'

        );

    }
    /**
     *
     * SET NODE CITY
     * ПОЛУЧИТЬ ОПИСАНИЕ НАСЕЛЕННОГО ПУНКТА ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОПИС НАСЕЛЕНОГО ПУНКТУ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function city()
    {

        return $this->nodeData(

            'city'

        );

    }
    /**
     *
     * SET NODE LOCALITY
     * ПОЛУЧИТЬ ПОЛУЧИТЬ ОПИСАНИЕ РАЙОНА ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОТРИМАТИ ОПИС РАЙОНУ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function locality()
    {

        return $this->nodeData(

            'locality'

        );

    }
    /**
     *
     * SET NODE KNOT
     * ПОЛУЧИТЬ СВЯЗЬ С ОТДЕЛЕНИЕМ
     * ОТРИМАТИ СВЯЗОК З ВІДДІЛЕННЯМ
     *
     * @return OBJECT | NULL
     *
     */
    public function knot()
    {

        return $this->nodeData(

            'knot'

        );

    }
    /**
     *
     * SET NODE DIRECTION
     * ПОЛУЧИТЬ НАПРАВЛЕНИЕ
     * ОТРИМАТИ НАПРЯМОК
     *
     * @return OBJECT | NULL
     *
     */
    public function direction()
    {

        return $this->nodeData(

            'direction'

        );

    }
    /**
     *
     * SET NODE DEPART
     * ПОЛУЧИТЬ ОСНОВНЫЕ ДАННЫЕ ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОСНОВНІ ДАНІ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function depart()
    {

        return $this->nodeData(

            'Depart'

        );

    }
    /**
     *
     * SET NODE TYPE DEPART
     * ПОЛУЧИТЬ ОПИСАНИЕ ТИПА ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОПИС ТИПУ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function typeDepart()
    {

        return $this->nodeData(

            'TypeDepart'

        );

    }
    /**
     *
     * SET NODE AREA REGION
     * ПОЛУЧИТЬ ОПИСАНИЕ ОБЛАСТНОГО РЕГИОНА
     * ОТРИМАТИ ОПИС ОБЛАСНОГО РЕГІОНУ
     *
     * @return OBJECT | NULL
     *
     */
    public function areaRegion()
    {

        return $this->nodeData(

            'areaRegion'

        );

    }
    /**
     *
     * SET NODE STREET
     * ПОЛУЧИТЬ ОПИСАНИЕ УЛИЦ ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОПИС ВУЛИЦЬ ВІДДІЛЕННЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function street()
    {

        return $this->nodeData(

            'street'

        );

    }
    /**
     *
     * SET NODE COUNTERPART
     * ПОЛУЧИТЬ ИНФОРМАЦИЯ ПРО ТОРГОВЦА
     * ОТРИМАТИ ІНФОРМАЦІЯ ПРО ТОРГОВЦЯ
     *
     * @return OBJECT | NULL
     *
     */
    public function counterpart()
    {

        return $this->nodeData(

            'counterpart'

        );

    }
    /**
     *
     * SET NODE ORDER
     * ПОЛУЧИТЬ ВНУТРЕННИЙ НОМЕР ЗАКАЗА В СИСТЕМЕ
     * ОТРИМАТИ ВНУТРІШНІЙ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
     *
     * @return OBJECT | NULL
     *
     */
    public function order()
    {

        return $this->nodeData(

            'order'

        );

    }
    /**
     *
     * SET NODE STATUS ORDER
     * ПОЛУЧИТЬ ВНУТРЕННИЙ НОМЕР СТАТУСА ЗАКАЗА В СИСТЕМЕ
     * ОТРИМАТИ ВНУТРІШНІЙ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
     *
     * @return OBJECT | NULL
     *
     */
    public function statusOrder()
    {

        return $this->nodeData(

            'statusOrder'

        );

    }
    /**
     *
     * SET NODE SENDER ID
     * ПОЛУЧИТЬ ИНФОРМАЦИЮ ПРО ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ІНФОРМАЦІЮ ПРО ВІДПРАВНИКА
     *
     * @return OBJECT | NULL
     *
     */
    public function senderID()
    {

        return $this->nodeData(

            'senderId'

        );

    }
    /**
     *
     * GET UUID
     * ПОЛУЧИТЬ УНИКАЛЬНЫЙ ИД
     * ОТРИМАТИ УНІКАЛЬНИЙ ІД
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getUUID()
    {

        return $this->formatData(

            'uuid'

        );

    }
    /**
     *
     * GET CODE
     * ПОЛУЧИТЬ КОД
     * ОТРИМАТИ КОД
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getCode()
    {

        return $this->formatData(

            'code'

        );

    }
    /**
     *
     * GET DESCRIPTION
     * ПОЛУЧИТЬ ОПИСАНИЕ
     * ОТРИМАТИ ОПИС
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getDescr()
    {
        $descr = $this->formatData(

            'descr'

        );

        if ($descr == null) {

            $descr = $this->formatData(

                'description'

            );

        }

        return $descr;

    }
    /**
     *
     * GET SCOATOU
     * КОД КОАТУУ
     *
     * @param STRING $type
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getSCOATOU($type = 'SCOATOU')
    {

        if (!$type) {

            return $this->formatData(

                'SCOATOU'

            );

        } else {

            switch ($type) {

                case 'region':

                    $type = 'regionSCOATOU';

                    break;
                case 'city':

                    $type = 'citySCOATOU';

                    break;
                case 'locality':

                    $type = 'localitySCOATOU';

                    break;
                case 'area':

                    $type = 'areaRegionSCOATOU';

                    break;

            }

        }

        return $this->formatData(

            $type

        );

    }
    /**
     *
     * GET REGION SCOATOU
     * ПОЛУЧИТЬ КОАТУУ ОБЛАСТИ
     * ОТРИМАТИ КОАТУУ ОБЛАСТІ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getRegionSCOATOU()
    {

        return $this->formatData(

            'regionSCOATOU'

        );

    }
    /**
     *
     * GET CITY SCOATUO
     * ПОЛУЧИТЬ КОАТУУ ГОРОДА
     * ОТРИМАТИ КОАТУУ МІСТА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getCitySCOATOU()
    {

        return $this->formatData(

            'citySCOATOU'

        );

    }
    /**
     *
     * GET LOCALITY SCOATOU
     * ПОЛУЧИТЬ КОАТУУ РАЙОНА
     * ОТРИМАТИ КОАТУУ РАЙОНУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getLocalitySCOATOU()
    {

        return $this->formatData(

            'localitySCOATOU'

        );

    }
    /**
     *
     * GET AREA REGION SCOATOU
     * ПОЛУЧИТЬ КОАТУУ ОБЛАСТНОГО РАЙОНА
     * ОТРИМАТИ КОАТУУ ОБЛАСНОГО РАЙОНУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getAreaRegionSCOATOU()
    {

        return $this->formatData(

            'areaRegionSCOATOU'

        );

    }
    /**
     *
     * GET TYPE
     * ПОЛУЧИТЬ ТИП
     * ОТРИМАТИ ТИП
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getType()
    {

        return $this->formatData(

            'type'

        );

    }
    /**
     *
     * GET BRANCH ID
     * ПОЛУЧИТЬ ИД ФИЛИАЛА
     * ОТРИМАТИ ІД ФІЛІАЛУ
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getBranchID()
    {

        return $this->formatData(

            'branch'

        );

    }
    /**
     *
     * GET ADDRESS
     * ПОЛУЧИТЬ АДРЕС ФИЛИАЛА
     * ОТРИМАТИ АДРЕСУ ФІЛІАЛУ
     *
     * @return STRING | NULL
     *
     */
    public function getAddress()
    {

        return $this->formatData(

            'address'

        );

    }
    /**
     *
     * GET POSITION
     * ПОЛУЧИТЬ МЕСТОПОЛОЖЕНИЕ ОТДЕЛЕНИЯ
     * ОТРИМАТИ МІСЦЕ РОЗТАШУВАННЯ ВІДДІЛЕННЯ
     *
     * @return ARRAY | NULL
     *
     */
    public function getPosition()
    {

        $list = [];

        if (count($this->fields) && isset($this->fields[0]['lat'])) {

            if (count($this->fields) > 1 && $this->first == false) {

                foreach ($this->fields as $key => $item) {

                    $list[$key] = [

                        'lat' => $item['lat'],

                        'lng' => $item['lng'],

                    ];

                }

            } else {

                $list = [

                    'lat' => $this->fields[0]['lat'],

                    'lng' => $this->fields[0]['lng'],

                ];

            }

        } else {

            $list = null;

        }

        return $list;

    }
    /**
     *
     * GET WEIGHT LIMIT
     * ПОЛУЧИТЬ МАКСИМАЛЬНЫЙ ВЕС ОТПРАВЛЕНИЙ ДЛЯ ОТДЕЛЕНИЯ
     * ОТРИМАТИ МАКСИМАЛЬНУ ВАГУ ВІДПРАВЛЕННЯ ДЛЯ ВІДДІЛЕННЯ
     *
     * @return INTEGER | NULL
     *
     */
    public function getWeightLimit()
    {

        $weight = $this->formatData(

            'weight_limit'

        );

        if ($weight == null) {

            $weigh = $this->formatData(

                'max_weight'

            );

        }

        return $weight;

    }
    /**
     *
     * GET QUERE VISIT
     * ПОЛУЧИТЬ ПОРЯДКОВЫЙ НОМЕР ОБХОДА ОТДЕЛЕНИЙ КУРЬЕРОМ
     * ОТРИМАТИ ПОРЯДКОВИЙ НОМЕР В ОБХОДЕ ВІДДІЛЕНЬ КУР'ЄРОМ
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getQuereVisit()
    {

        return $this->formatData(

            'quereVisit'

        );

    }
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
    public function getAgent()
    {

        return $this->formatData(

            'agent'

        );

    }
    /**
     *
     * GET PAY CARD
     * ПОЛУЧИТЬ ВОЗМОЖНОСТЬ ОПЛАТЫ КАРТОЙ НА ОТДЕЛЕНИИ
     * ОТРИМАТИ МОЖЛИВІСТЬ ОПЛАТИ КАРТОЮ НА ВІДДІЛЕНІ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function getPayCard()
    {

        return $this->formatData(

            'possibility_to_pay_by_card'

        );

    }
    /**
     *
     * GET ACCEPT PAY
     * ПОЛУЧИТЬ ВОЗМОЖНОСТЬ ОПЛАТИ ПРИ ПОЛУЧЕНИИ ОТПРАВЛЕНИЯ
     * ОТРИМАТИ МОЖЛИВІСТЬ ОПЛАТИ ПРИ ОТРИМАННІ ВІДПРАВЛЕННЯ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function getAcceptPay()
    {

        return $this->formatData(

            'possibility_to_accept_payment'

        );

    }
    /**
     *
     * GET POSTMAST
     * ПОЛУЧИТЬ НАЯВНОСТЬ ПОЧТАМАТА НА ОТДЕЛЕНИИ
     * ОТРИМАТИ НАЯВНІСТЬ ПОЧТОМАТУ НА ВІДДІЛЕННІ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function getPostmat()
    {

        return $this->formatData(

            'availability_of_parcel_locker'

        );

    }
    /**
     *
     * GET CODE HOLDING
     * ПОЛУЧИТЬ НОМЕР ОТДЕЛЕНИЯ В КАЧЕСТВЕ ХОЛДИНГА В СИСТЕМЕ ОРГАНИЗАЦИИ
     * ОТРИМАТИ НОМЕР ВІДДІЛЕННЯ В ЯКОСТІ ХОЛДІНГУ В СИСТЕМІ ОРГАНІЗАЦІЇ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getCodeHolding()
    {

        return $this->formatData(

            'codeHolding'

        );

    }
    /**
     *
     * GET ID SHEDULER
     * ПОЛУЧИТЬ ИД РАСПИСАНИЯ ОТДЕЛЕНИЯ
     * ОТРИМАТИ ІД РОЗКЛАДУ ВІДДІЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getShedulerID()
    {

        return $this->formatData(

            'idSheduler'

        );

    }
    /**
     *
     * GET ID
     * ПОЛУЧИТЬ ИДЕНТИФИКАТОР ОТДЕЛЕНИЯ В СИСТЕМЕ ОРГАНИЗАЦИИ
     * ОТРИМАТИ ІДЕНТИФІКАТОР ВІДДІЛЕННЯ В СИСТЕМІ ОРГАНІЗАЦІЇ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getID()
    {

        return $this->formatData(

            'identificator'

        );

    }
    /**
     *
     * GET ENUM
     * ПОЛУЧИТЬ ТИП ТОЧКИ ОБРАБОТКИ
     * ОТРИМАТИ ТИП ТОЧКИ ОБРОБКИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getEnum()
    {

        return $this->formatData(

            'enum'

        );

    }
    /**
     *
     * GET VALUE
     * ПОЛУЧИТЬ ЗНАЧЕНИЕ
     * ОТРИМАТИ ЗНАЧЕННЯ
     *
     * @return INTEGER | ARRAY | NULL
     *
     */
    public function getValue()
    {

        return $this->formatData(

            'value'

        );

    }
    /**
     *
     * GET DEPART NUMBER
     * ПОЛУЧИТЬ НОМЕР ОТДЕЛЕНИЯ
     * ОТРИМАТИ НОМЕР ВІДДІЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getDepartNumber()
    {

        return $this->formatData(

            'departNumber'

        );

    }
    /**
     *
     * GET HOUSE NUMBER
     * ПОЛУЧИТЬ НОМЕР ДОМА, ГДЕ НАХОДИТСЯ ОТДЕЛЕНИЕ
     * ОТРИМАТИ НОМЕР БУДИНКУ, ДЕ ЗНАХОДИТЬСЯ ВІДДІЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getHouseNumber()
    {

        return $this->formatData(

            'houseNumber'

        );

    }
    /**
     *
     * GET LOGIN
     * ПОЛУЧИТЬ ЛОГИН
     * ОТРИМАТИ ЛОГІН
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getLogin()
    {

        return $this->formatData(

            'login'

        );

    }
    /**
     *
     * GET STATUS DATE
     * ПОЛУЧИТЬ ДАТУ И ВРЕМЯ ТЕКУЩЕГО СТАТУСА ЗАКАЗА
     * ОТРИМАТИ ДАТУ ТА ЧАС ПОТОЧНОГО СТАТУСУ ЗАМОВЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getStatusDate()
    {

        return $this->formatData(

            'statusDate'

        );

    }
    /**
     *
     * GET ORDER NUMBER
     * ПОЛУЧИТЬ НОМЕР ЗАКАЗА В СИСТЕМЕ
     * ОТРИМАТИ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getOrderNumber()
    {

        return $this->formatData(

            'orderNumber'

        );

    }
    /**
     *
     * GET CLIENT NUMBER
     * ПОЛУЧИТЬ НОМЕР КЛИЕНТА В СИСТЕМЕ
     * ОТРИМАТИ НОМЕР КЛІЄНТА В СИСТЕМІ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getClientNumber()
    {

        return $this->formatData(

            'clientNumber'

        );

    }
    /**
     *
     * GET TTN
     * ПОЛУЧИТЬ НОМЕР ТТН
     * ОТРИМАТИ НОМЕР ТТН
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getTTN()
    {

        return $this->formatData(

            'TTN'

        );

    }
    /**
     *
     * GET DELIVERY DEPARTMENT
     * ПОЛУЧИТЬ ОТДЕЛЕНИЕ ДОСТАВКИ
     * ОТРИМАТИ ВІДДІЛЕННЯ ДОСТАВКИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getDDepartment()
    {

        return $this->formatData(

            'deliveryDepartment'

        );

    }
    /**
     *
     * GET ADDRESS DEPARTMENT
     * ПОЛУЧИТЬ АДРЕС ОТДЕЛЕНИЯ ДОСТАВКИ
     * ОТРИМАТИ АДРЕС ВІДДІЛЕННЯ ДОСТАВКИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function getADepartment()
    {

        return $this->formatData(

            'addressDepartment'

        );

    }
    /**
     *
     * GET TTN NEW ORDER
     * ПОЛУЧИТЬ НОМЕР НОВОГО ТТН
     * ОТРИМАТИ НОМЕР НОВОГО ТТН
     *
     * @return STRING | NULL
     *
     */
    public function ttn()
    {

        return $this->formatData(

            'ttn'

        );

    }
    /**
     *
     * GET NUMBER
     * ПОЛУЧИТЬ НОМЕР
     * ОТРИМАТИ НОМЕР
     *
     * @return STRING | NULL
     *
     */
    public function number()
    {

        return $this->formatData(

            'number'

        );

    }
    /**
     *
     * GET ORDER NUMBER
     * ПОЛУЧИТЬ НОМЕР ЗАКАЗА
     * ОТРИМАТИ НОМЕР ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function orderNumber()
    {

        return $this->formatData(

            'orderNumber'

        );

    }
    /**
     *
     * GET ORDER DESCRIPTION
     * ПОЛУЧИТЬ ОПИСАНИЕ ЗАКАЗА
     * ОТРИМАТИ ОПИС ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function orderDescr()
    {

        return $this->formatData(

            'orderDescription'

        );

    }
    /**
     *
     * GET DATE
     * ПОЛУЧИТЬ ДАТУ ДОБАВЛЕНИЯ СТАТУСА
     * ОТРИМАТИ ДАТУ ДОДАВАННЯ СТАТУСУ
     *
     * @return STRING | NULL
     *
     */
    public function date()
    {

        return $this->formatData(

            'date'

        );

    }
    /**
     *
     * GET TIME
     * ПОЛУЧИТЬ ВРЕМЯ ДОБАВЛЕНИЕ СТАТУСА
     * ОТРИМАТИ ЧАС ДОДАВАННЯ СТАТУСУ
     *
     * @return STRING | NULL
     *
     */
    public function time()
    {

        return $this->formatData(

            'time'

        );

    }
    /**
     *
     * GET DATE TIME ADDED STATUS
     * ПОЛУЧИТЬ ДАТУ И ВРЕМЯ ДОБАВЛЕНИЯ СТАТУСА
     * ОТРИМАТИ ДАТУ ТА ЧАС ДОДАВАННЯ СТАТУСУ
     *
     * @return STRING | NULL
     *
     */
    public function dateAdded()
    {

        $list = [];

        $dates = $this->formatData('date');

        if (!is_array($dates)) {

            $list = $dates . ' ' . $this->formatData('time');

        } else {

            $list = array_map(

                function ($date, $time) {

                    return $date . ' ' . $time;

                },

                $dates, $this->formatData('time')

            );

        }

        return $list;

    }
    /**
     *
     * GET STATUS
     * ПОЛУЧИТЬ ТЕКУЩИЙ СТАТУС
     * ОТРИМАТИ ПОТОЧНИЙ СТАТУС
     *
     * @return STRING | NULL
     *
     */
    public function status()
    {

        return $this->formatData(

            'status'

        );

    }
    /**
     *
     * GET DEPARTMENT NUMBER
     * ПОЛУЧИТЬ НОМЕР ОТДЕЛЕНИЯ (ЕСЛИ ОТПРАВЛЕНИЕ НАХОДИТСЯ НА ОТДЕЛЕНИИ)
     * ОТПРИМААТИ НОМЕР ВІДДІЛЕННЯ (ЯКЩО ВІДПРАВЛЕННЯ ЗНАХОДИТЬСЯ НА ВІДДІЛЕННІ)
     *
     * @return STRING | NULL
     *
     */
    public function deparNumber()
    {

        return $this->formatData(

            'departmentNumber'

        );

    }
    /**
     *
     * GET DEPARTMENT ADDRESS
     * ПОЛУЧИТЬ АДРЕС ОТДЕЛЕНИЯ (ЕСЛИ ОТПРАВЛЕНИЕ НАХОДИТСЯ НА ОТДЕЛЕНИИ)
     * ОТРИМАТИ АДРЕСУ ВІДДІЛЕННЯ (ЯКЩО ВІДПРАВЛЕННЯ ЗНАХОДИТЬСЯ НА ВІДДІЛЕННІ)
     * @return STRING | NULL
     *
     */
    public function deparAddress()
    {

        return $this->formatData(

            'departmentAdress'

        );

    }
    /**
     *
     * GET ADDRESS
     * ПОЛУЧИТЬ АДРЕС
     * ОТРИМАТИ АДРЕС
     *
     * @return STRING | NULL
     *
     */
    public function address()
    {

        return $this->formatData(

            'adress'

        );

    }
    /**
     *
     * GET LOCALITY
     * ПОЛУЧИТЬ НАЗВАНИЕ ГОРОД
     * ОТРИМАТИ НАЗВУ ГОРОДА
     *
     * @return STRING | NULL
     *
     */
    public function getLocality()
    {

        return $this->formatData(

            'locality'

        );

    }
    /**
     *
     * GET TYPE DEPARTMENT
     * ПОЛУЧИТЬ ТИП ОТДЕЛЕНИЯ
     * ОТРИМАТИ ТИП ВІДДІЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function format()
    {

        return $this->formatData(

            'format'

        );

    }
    /**
     *
     * GET SCHEDULE DEPARTMENT DESCRIPTION
     * ПОЛУЧИТЬ ОПИСАНИЕ ГРАФИКА ОТДЕЛЕНИЯ
     * ОТРИМАТИ ОПИС ГРАФІКУ ВІДДІЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function scheduDescr()
    {

        return $this->formatData(

            'shedule_description'

        );

    }
    /**
     *
     * GET DISTANCE
     * РАССТОЯНИЕ ДО ОТДЕЛЕНИЯ НА КАРТЕ (КМ)
     * ВІДСТАНЬ ДО ВІДДІЛЕННЯ НА КАРТІ (КМ)
     *
     * @return STRING | NULL
     *
     */
    public function distance()
    {

        return $this->formatData(

            'distance'

        );

    }

}
