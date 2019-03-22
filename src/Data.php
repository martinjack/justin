<?php

namespace Justin;

use Justin\Contracts\iData;
use Justin\Exceptions\JustinDataException;

/**
 *
 * Class Data
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

        }

        unset($raw);

        return $this;

    }
    /**
     *
     * GET DATA
     * ДАННЫЕ ОТВЕТА СЕРВЕРА
     * ДАННІ ВІДПОВІДІ СЕРВЕРУ
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
     * GET RAW
     * СЫРЬЕ ДАННЫЕ ОТВЕТА СЕРВЕРА
     * СИРІ ДАНІ ВІДПОВІДІ СЕРВЕРУ
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

            'No data to display. Empty array raw'

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

        return isset($this->raw['response']['status']) ? $this->raw['response']['status'] : null;

    }
    /**
     *
     * GET RESULT
     * ПОЛУЧИТЬ РЕЗУЛЬТАТ
     * ОТРИМАТИ РЕЗУЛЬТАТ
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
     * КОД ОШИБКИ API
     * КОД ПОМИЛКИ API
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
     * СПИСОК ОШИБОК
     * СПИСОК ПОМИЛОК
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
     * СООБЩЕНИЕ API
     * ПОВІДОМЛЕННЯ API
     *
     * @return STRING | NULL
     *
     */
    public function getMessage()
    {

        return isset($this->raw['response']['message']) ? $this->raw['response']['message'] : null;

    }
    /**
     *
     * TOTAL RECORDS
     * КОЛИЧЕСТВО ЗАПИСЕЙ
     * КІЛЬКІСТЬ ЗАПИСІВ
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
     * ПОЛЯ С ДАННЫМИ
     * ПОЛЯ З ДАНИМИ
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

        } elseif (isset($this->getData()['number'])) {

            foreach ($this->data as $key => $item) {

                $this->fields[$key] = $item;

            }

        }

        return $this;

    }
    /**
     *
     * SHOW DATA
     *
     * @return ARRAY
     *
     */
    public function show()
    {

        return $this->fields;

    }
    /**
     *
     * FIRST ITEM
     * ВЕРНУТЬ ПЕРВЫЙ ЭЛЕМЕНТ МАССИВА
     * ПОВЕРНУТИ ПЕРШИЙ ЕЛЕМЕНТ МАСИВУ
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
     * ВЕРНУТЬ ПОСЛЕДНИЙ ЭЛЕМЕНТ МАССИВА
     * ПОВЕРНУТИ ОСТАННІЙ ЕЛЕМЕНТ МАСИВУ
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
        $list = $this->last ? end($list) : $list;
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
     * ОПИСАНИЕ КОМПАНИИ-ХОЗАИНА ОТДЕЛЕНИЯ
     * ОПИС КОМПАНІЇ-ВЛАСНИКА ВІДДІЛЕННЯ
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
     * ОПИСАНИЕ ОБЛАСТИ ОТДЕЛЕНИЯ
     * ОПИС ОБЛАСТІ ВІДДІЛЕННЯ
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
     * ОПИСАНИЕ НАСЕЛЕННОГО ПУНКТА ОТДЕЛЕНИЯ
     * ОПИС НАСЕЛЕНОГО ПУНКТУ ВІДДІЛЕННЯ
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
     * ОПИСАНИЕ РАЙОНА ОТДЕЛЕНИЯ
     * ОПИС РАЙОНУ ВІДДІЛЕННЯ
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
     * СВЯЗЬ С ОТДЕЛЕНИЕМ
     * СВЯЗОК З ВІДДІЛЕННЯМ
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
     * НАПРАВЛЕНИЕ
     * НАПРЯМОК
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
     * ОСНОВНЫЕ ДАННЫЕ ОТДЕЛЕНИЯ
     * ОСНОВНІ ДАНІ ВІДДІЛЕННЯ
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
     * ОПИСАНИЕ ТИПА ОТДЕЛЕНИЯ
     * ОПИС ТИПУ ВІДДІЛЕННЯ
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
     * ОПИСАНИЕ ОБЛАСТНОГО РЕГИОНА
     * ОПИС ОБЛАСНОГО РЕГІОНУ
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
     * ОПИСАНИЕ УЛИЦЫ ОТДЕЛЕНИЯ
     * ОПИС ВУЛИЦЫ ВІДДІЛЕННЯ
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
     * ИНФОРМАЦИЯ ПРО ПРОДАВЦА
     * ІНФОРМАЦІЯ ПРО ТОРГОВЦЯ
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
     * ВНУТРЕННИЙ НОМЕР ЗАКАЗА В СИСТЕМЕ
     * ВНУТРІШНІЙ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
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
     * ВНУТРЕННИЙ НОМЕР СТАТУСА ЗАКАЗА В СИСТЕМЕ
     * ВНУТРІШНІЙ НОМЕР ЗАМОВЛЕННЯ В СИСТЕМІ
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
     * ИНФОРМАЦИЯ ПРО ОТПРАВИТЕЛЯ
     * ІНФОРМАЦІЯ ПРО ВІДПРАВНИКА
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
     * ОПИСАНИЕ
     * ОПИС
     *
     * @return STRING | ARRAY
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
     * @return INTEGER | ARRAY | NULL
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
     * ПОЛУЧИТЬ КОАТУУ ГОРОДА
     * ОТРИМАТИ КОАТУУ МІСТА
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
     * МЕСТОПОЛОЖЕНИЕ ОТДЕЛЕНИЯ
     * МІСЦЕ РОЗТАШУВАННЯ ВІДДІЛЕННЯ
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
     * МАКСИМАЛЬНЫЙ ВЕС ОТПРАВЛЕНИЯ ДЛЯ ОТДЕЛЕНИЯ
     * МАКСИМАЛЬНА ВАГА ВІДПРАВЛЕННЯ ДЛЯ ВІДДІЛЕННЯ
     *
     * @return INTEGER | NULL
     *
     */
    public function getWeightLimit()
    {

        return $this->formatData(

            'weight_limit'

        );

    }
    /**
     *
     * GET QUERE VISIT
     * ПОРЯДКОВЫЙ НОМЕР ОБХОДА ОТДЕЛЕНИЙ КУРЬЕРОМ
     * ПОРЯДКОВИЙ НОМЕР В ОБХОДЕ ВІДДІЛЕНЬ КУР'ЄРОМ
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
     * ВОЗМОЖНОСТЬ ОПЛАТЫ КАРТОЙ
     * МОЖЛИВІСТЬ ОПЛАТИ КАРТОЮ
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
     * ВОЗМОЖНОСТЬ ОПЛАТИ ПРИ ПОЛУЧЕНИИ ОТПРАВЛЕНИЯ
     * МОЖЛИВІСТЬ ОПЛАТИ ПРИ ОТРИМАННІ ВІДПРАВЛЕННЯ
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
     * НАЯВНОСТЬ ПОЧТАМАТА НА ОТДЕЛЕНИИ
     * НАЯВНІСТЬ ПОЧТОМАТУ НА ВІДДІЛЕННІ
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
     * НОМЕР ОТДЕЛЕНИЯ В КАЧЕСТВЕ ХОЛДИНГА В СИСТЕМЕ ОРГАНИЗАЦИИ
     * НОМЕР ВІДДІЛЕННЯ В ЯКОСТІ ХОЛДІНГУ В СИСТЕМІ ОРГАНІЗАЦІЇ
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
     * ТИП ТОЧКИ ОБРАБОТКИ
     * ТИП ТОЧКИ ОБРОБКИ
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
     * @return STRING
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
     * GET NUMBER NEW ORDER
     * ПОЛУЧИТЬ НОМЕР НОВОГО ЗАКАЗА
     * ОТРИМАТИ НОМЕР НОВОГО ЗАМОВЛЕННЯ
     *
     * @return STRING
     *
     */
    public function number()
    {

        return $this->formatData(

            'number'

        );

    }
}
