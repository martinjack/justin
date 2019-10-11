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
class Data extends Utils implements iData
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
     * ARRAY FIELDS
     *
     * @var OBJECT
     *
     */
    public $arrayFields = null;
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

        } else {

            $this->data = $raw;

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

        if ($this->raw && count($this->raw)) {

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

        $this->arrayFields = $this;

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

        } elseif (isset($this->fields['date'])) {

            $this->fields = $this->fields[$item];

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
     */
    public function cargoList()
    {

        return $this->nodeData(

            'cargo_places_array'

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

        return $this->formatData(

            'descr'

        );

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
    public function type()
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
    public function branchID()
    {

        return $this->formatData(

            'branch'

        );

    }
    /**
     *
     * GET ADDRESS
     * ПОЛУЧИТЬ АДРЕС
     * ОТРИМАТИ АДРЕСУ
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

        if (!$weight) {

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
     * @param STRING $field
     *
     * @return STRING | NULL
     *
     */
    public function number($field = '')
    {

        if (!$field) {

            $field = 'number';

        } else {

            $field = "number_${field}";

        }

        return $this->formatData(

            $field

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
    /**
     * GET SHORT NAME
     * ПОЛУЧИТЬ КОРОТКОЕ НАЗВАНИЕ
     * ОТРИМАТИ КОРОТКЕ НАЗВУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function shortName()
    {

        return $this->formatData(

            'short_name'

        );

    }
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
    public function data($parse = false, $timestamp = true, $type = 0)
    {

        $data = $this->formatData(

            'Data'

        );

        if ($parse && $data) {

            $data = $this->dateParse(

                $data, $timestamp, $type

            );

        }

        return $data;

    }
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
    public function startWork($parse = false, $timestamp = true, $type = 0)
    {

        $data = $this->formatData(

            'BeginningOfWork'

        );

        if ($parse && $data) {

            $data = $this->dateParse(

                $data, $timestamp, $type

            );

        }

        return $data;

    }
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
    public function endWork($parse = false, $timestamp = true, $type = 0)
    {

        $data = $this->formatData(

            'EndOfWork'

        );

        if ($parse && $data) {

            $data = $this->dateParse(

                $data, $timestamp, $type

            );

        }

        return $data;

    }
    /**
     *
     * GET WORKING DAY
     * ПОЛУЧИТЬ СТАТУС РАБОЧЕГО ДНЯ
     * ОТРИМАТИ СТАТУС РОБОЧОГО ДНЯ
     *
     * @return BOOLEAN | ARRAY | NULL
     *
     */
    public function workDay()
    {

        return $this->formatData(

            'WorkingDay'

        );

    }
    /**
     *
     * GET NUMBER EN
     * ПОЛУЧИТЬ НОМЕР ЗАКАЗА С PMS СИСТЕМЫ
     * ОТРИМАТИ НОМЕР ЗАМОВЛЕННЯ PMS СИСТЕМИ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function numberEN()
    {

        return $this->formatData(

            'number_en'

        );

    }
    /**
     *
     * GET NUMBER KIS
     * ПОЛУЧИТЬ НОМЕР ЗАКАЗА С СИСТЕМЫ ПРОДАВЦА
     * ОТРИМАТИ НОМЕР ЗАМОВЛЕННЯ З СИСТЕМИ ТОРГОВЦЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function numberKIS()
    {

        return $this->formatData(

            'number_kis'

        );

    }
    /**
     *
     * GET NUMBER TTN
     * ПОЛУЧИТЬ НОМЕР ТТН ЗАКАЗА
     * ОТРИМАТИ НОМЕР ТТН ЗАМОВЛЕННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function numberTTN()
    {

        return $this->formatData(

            'number_ttn'

        );

    }
    /**
     *
     * GET SENDER
     * ПОЛУЧИТЬ ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ВІДПРАВНИКА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function sender()
    {

        return $this->formatData(

            'sender'

        );

    }
    /**
     *
     * GET RECEIVER
     * ПОЛУЧИТЬ ПОЛУЧАТЕЛЯ
     * ОТРИМАТИ ОТРИМУВАЧА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function receiver()
    {

        $data = $this->formatData(

            'reciver'

        );

        if (!$data) {

            $data = $this->formatData(

                'receiver'

            );

        }

        return $data;

    }
    /**
     *
     * GET PHONE SENDER
     * ПОЛУЧИТЬ ТЕЛЕФОН ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ТЕЛЕФОН ВІДПРАВНИКА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function phoneSender()
    {

        $data = $this->formatData(

            'phone_sender'

        );

        if (!$data) {

            $data = $this->formatData(

                'sender_phone'

            );

        }

        return $data;

    }
    /**
     *
     * GET PHONE RECEIVER
     * ПОЛУЧИТЬ ТЕЛЕФОН ПОЛУЧАТЕЛЯ
     * ОТРИМАТИ ТЕЛЕФОН ОТРИМУВАЧА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function phoneReceiver()
    {
        $data = $this->formatData(

            'phone_reciver'

        );

        if (!$data) {

            $data = $this->formatData(

                'receiver_phone'

            );

        }

        return $data;

    }
    /**
     *
     * GET DATE STATUS
     * ПОЛУЧИТЬ ДАТУ СТАТУСА
     * ОТРИМАТИ ДАТУ СТАТУСУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function dateStatus()
    {

        return $this->formatData(

            'date_status'

        );

    }
    /**
     *
     * GET STATUS UUID
     * ПОЛУЧИТЬ UUID СТАТУСА
     * ОТРИМАТИ UUID СТАТУСА
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function statusUUID()
    {

        return $this->formatData(

            'status_guid'

        );

    }
    /**
     *
     * GET SENDER CITY ID
     * ПОЛУЧИТЬ ID ГОРОДА ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ID МІСТА ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderCity()
    {

        return $this->formatData(

            'sender_city_id'

        );

    }
    /**
     *
     * GET SENDER COMPANY
     * ПОЛУЧИТЬ НАЗВАНИЕ / ФИО ОТПРАВИТЕЛЯ
     * ОТПРИМАТИ НАЗВУ / ПІП ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderCompany()
    {

        return $this->formatData(

            'sender_company'

        );

    }
    /**
     *
     * GET SENDER CONTACT
     * ПОЛУЧИТЬ ФИО ОТПРАВИТЕЛЯ
     * ОТРИМАТИ ПІП ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderContact()
    {

        return $this->formatData(

            'sender_contact'

        );

    }
    /**
     *
     * GET ADDRESS SENDER ORDER
     * ПОЛУЧИТЬ АДРЕС ЗАБОРА ЗАКАЗА
     * ОТПРИМАТИ АДРЕСУ ЗАБОРУ ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function addressPickup()
    {

        return $this->formatData(

            'sender_pick_up_address'

        );

    }
    /**
     *
     * GET STATUS PICKUP ORDER
     * ПОЛУЧИТЬ СТАТУС ЗАБОРА
     * ОТРИМАТИ СТАТУС ЗАБОРУ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function requirePickup()
    {

        return $this->formatData(

            'pick_up_is_required'

        );

    }
    /**
     *
     * GET BRANCH SENDER
     * ПОЛУЧИТЬ НОМЕР ОТДЕЛЕНИЯ ОТПРАВИТЕЛЯ
     * ОТРИМАТИ НОМЕР ВІДДІЛЕННЯ ВІДПРАВНИКА
     *
     * @return STRING | NULL
     *
     */
    public function senderBranch()
    {

        return $this->formatData(

            'sender_branch'

        );

    }
    /**
     *
     * GET RECEIVER CONTACT
     * ПОЛУЧИТЬ ФИО ПОЛУЧАТЕЛЯ
     * ОТПРИМАТИ ПІП ОТРИМУВАЧА
     *
     * @return STRING | NULL
     *
     */
    public function receiverContact()
    {

        return $this->formatData(

            'receiver_contact'

        );

    }
    /**
     *
     * GET COUNT PLACE
     * ПОЛУЧИТЬ КОЛИЧЕСТВО ГРУЗОВЫХ МЕСТ
     * ОТРИМАТИ КІЛЬКІСТЬ ВАНТАЖНИХ МІСЦЬ
     *
     * @return STRING | NULL
     *
     */
    public function countPlace()
    {

        return $this->formatData(

            'count_cargo_places'

        );

    }
    /**
     *
     * GET VOLUME
     * ПОЛУЧИТЬ ОБЪЕМ В М3
     * ОТРИМАТИ ОБ'ЄМ В М3
     *
     * @return STRING | NULL
     *
     */
    public function volume()
    {

        return $this->formatData(

            'volume'

        );

    }
    /**
     *
     * GET WEIGHT
     * ПОЛУЧИТЬ ВЕС В КГ
     * ОТРИМАТИ ВЕС В КГ
     *
     * @return STRING | NULL
     *
     */
    public function weight()
    {

        return $this->formatData(

            'weight'

        );

    }
    /**
     *
     * GET COST DECLARED
     * ПОЛУЧИТЬ ЗАДЕКЛАРИРОВАННУЮ СТОИМОСТЬ ЗАКАЗА
     * ОТРИМАТИ ЗАДЕКЛАРОВАНУ ВАРТІСТЬ ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function costDeclared()
    {

        return $this->formatData(

            'declared_cost'

        );

    }
    /**
     *
     * GET DELIVERY AMOUNT
     * ПОЛУЧИТЬ СТОИМОСТЬ ДОСТАВКИ
     * ОТРИМАТИ ВАРТІСТЬ ДОСТАВКИ
     *
     * @return STRING | NULL
     *
     */
    public function deliveryAmount()
    {

        return $this->formatData(

            'delivery_amount'

        );

    }
    /**
     *
     * GET REDELIVERY AMOUNT
     * ПОЛУЧИТЬ КОМИССИЮ ЗА ДОСТАВКУ ЗАКАЗА
     * ОТРИМАТИ КОМІСІЮ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function redeliveryAmount()
    {

        return $this->formatData(

            'redelivery_amount'

        );

    }
    /**
     *
     * GET ORDER AMOUNT
     * ПОЛУЧИТЬ СУММУ ЗА ЗАКАЗ
     * ОТРИМАТИ СУМУ ЗА ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function orderAmount()
    {

        return $this->formatData(

            'order_amount'

        );

    }
    /**
     *
     * GET DELIVERY PAYMENT
     * ПОЛУЧИТЬ СТАТУС ОПЛАТЫ КОМИССИИ ЗА ЗАКАЗ
     * ОТРИМАТИ СТАТУС ОПЛАТИ КОМІСІЇ ЗА ЗАМОВЛЕННЯ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function redeliveryPay()
    {

        return $this->formatData(

            'redelivery_payment_is_required'

        );

    }
    /**
     *
     * GET REDELIVERY PAYER
     * ПОЛУЧИТЬ ПЛАТЕЛЬЩИКА КОМИССИИ
     * ОТРИМАТИ ПЛАТНИКА КОМІСЇ
     *
     * @return INTEGER | NULL
     *
     */
    public function redeliveryPayer()
    {

        return $this->formatData(

            'redelivery_payment_payer'

        );

    }
    /**
     *
     * GET DELIVERY PAYER
     * ПОЛУЧИТЬ СТАТУС ОПЛАТЫ ЗА ДОСТАВКУ ЗАКАЗА
     * ОТРИМАТИ СТАТУС ОПЛАТИ ЗА ДОСТАВКУ ЗАМОВЛЕННЯ
     *
     * @return BOOLEAN | NULL
     *
     */
    public function deliveryPay()
    {

        return $this->formatData(

            'delivery_payment_is_required'

        );

    }
    /**
     *
     * GET DELIVERY PAYER
     * ПОЛУЧИТЬ ПЛАТЕЛЬЩИКА ДОСТАВКИ ЗАКАЗА
     * ОТРИМАТИ ПЛАТНИКА ДОСТАВКИ ЗАМОВЛЕННЯ
     *
     * @return INTEGER | NULL
     *
     */
    public function deliveryPayer()
    {

        return $this->formatData(

            'delivery_payment_payer'

        );

    }
    /**
     *
     * GET ORDER PAY
     * ПОЛУЧИТЬ СТАТУС ОПЛАТЫ ЗА ЗАКАЗ
     * ОТРИМАТИ СТАТУС ОПЛАТИ ЗА ЗАМОВЛЕННЯ
     *
     * @return STRING | NULL
     *
     */
    public function orderPay()
    {

        return $this->formatData(

            'order_payment_is_required'

        );

    }
    /**
     *
     * GET DELIVERY TYPE
     * ПОЛУЧИТЬ ТИП ЗАКАЗА
     * ОТРИМАТИ ТИП ЗАМОВЛЕННЯ
     *
     * @return INTEGER | NULL
     *
     */
    public function deliveryType()
    {

        return $this->formatData(

            'delivery_type'

        );

    }
    /**
     *
     * GET CODE TYPE
     * ПОЛУЧИТЬ ТИП ВЫДАЧИ COD
     * ОТРИМАТИ ТИП ВИДАЧІ COD
     *
     * @return INTEGER | NULL
     *
     */
    public function codType()
    {

        return $this->formatData(

            'cod_transfer_type'

        );

    }
    /**
     *
     * GET COD CARD NUMBER
     * ПОЛУЧИТЬ НОМЕР КАРТЫ ДЛЯ COD
     * ОТРИМАТИ НОМЕР КАРТИ ДЛЯ COD
     *
     * @return STRING | NULL
     *
     */
    public function cardNumber()
    {

        return $this->formatData(

            'cod_card_number'

        );

    }
    /**
     *
     * GET DESCRIPTION
     * ПОЛУЧИТЬ ОПИСАНИЕ
     * ОТРИМАТИ ОПИС
     *
     * @return STRING | NULL
     *
     */
    public function description()
    {

        return $this->formatData(

            'description'

        );

    }
    /**
     *
     * GET ADD DESCRIPTION
     * ПОЛУЧИТЬ ДОБАВЛЕНИЕ ОПИСАНИЕ
     * ОТРИМАТИ ДОДАНИЙ ОПИС
     *
     * @return STRING | NULL
     *
     */
    public function addDescription()
    {

        return $this->formatData(

            'add_description'

        );

    }
    /**
     *
     * GET MARKING CODE
     * ПОЛУЧИТЬ КОД МАРКИРОВКИ
     * ОТРИМАТИ КОД МАРКУВАННЯ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function marking()
    {

        return $this->formatData(

            'marking'

        );

    }
    /**
     *
     * GET WIDTH
     * ПОЛУЧИТЬ ШИРИНУ
     * ОТРИМАТИ ШИРИНУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function width()
    {

        return $this->formatData(

            'width'

        );

    }
    /**
     *
     * GET HEIGHT
     * ПОЛУЧИТЬ ВЫСОТУ
     * ОТРИМАТИ ВИСОТУ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function height()
    {

        return $this->formatData(

            'height'

        );

    }
    /**
     *
     * GET DEPTH
     * ПОЛУЧИТЬ ГЛУБИНУ, СМ
     * ОТРИМАТИ ГЛИБИНУ, СМ
     *
     * @return STRING | ARRAY | NULL
     *
     */
    public function depth()
    {

        return $this->formatData(

            'depth'

        );

    }

}
