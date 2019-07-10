<?php

namespace Justin;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Justin\Contracts\iJustin;
use Justin\Data;
use Justin\Exceptions\JustinApiException;
use Justin\Exceptions\JustinAuthException;
use Justin\Exceptions\JustinException;
use Justin\Exceptions\JustinFileException;
use Justin\Exceptions\JustinHttpException;
use Justin\Exceptions\JustinResponseException;

/**
 *
 * Class Justin
 *
 * @package Justin
 *
 */
class Justin extends Order implements iJustin
{

    /**
     *
     * CLIENT QUERY
     *
     * @var OBJECT
     *
     */
    public $client = null;
    /**
     *
     * SANDBOX
     *
     * @var BOOLEAN
     *
     */
    protected $sandbox = false;
    /**
     *
     * ADDRESS API
     *
     * @var STRING
     *
     */
    private $address_api = 'https://api.justin.ua';
    /**
     *
     * OPEN API URL
     *
     * @var STRING
     *
     */
    private $open_api = 'http://openapi.justin.ua/';
    /**
     *
     * AUTH_LOGIN
     *
     * @var STRING
     *
     */
    protected $auth_login = 'Exchange';
    /**
     *
     * AUTH PASSWORD
     *
     * @var STRING
     *
     */
    protected $auth_password = 'Exchange';
    /**
     *
     * KEY API
     *
     * @var STRING
     *
     */
    protected $key = '';
    /**
     *
     * LOGIN
     *
     * @var STRING
     *
     */
    protected $login = '';
    /**
     *
     * PASSWORD
     *
     * @var STRING
     *
     */
    protected $password = '';
    /**
     *
     * LANGUAGE
     *
     * @var STRING
     *
     */
    protected $language = 'UA';
    /**
     *
     * API URL
     *
     * @var ARRAY
     *
     */
    private $api = [

        0 => '',

    ];
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
    public function __construct($language = 'UA', $sandbox = false, $version = 'v2', $timeout = 60, $connect_timeout = 60, $timezone = 'Europe/Kiev')
    {

        $this->client = new Client(

            [

                'request.options' => [

                    'timeout'         => $timeout,

                    'connect_timeout' => $connect_timeout,

                ],

            ]

        );

        date_default_timezone_set(

            $timezone

        );

        $this->api[0] = $this->address_api;

        return $this
            ->setSandbox($sandbox)
            ->setVersion($version)
            ->setLanguage($language);

    }
    /**
     *
     * SET SANDBOX
     *
     * @param BOOLEAN sandbox
     *
     * @param STRING $type
     *
     * @return OBJECT
     *
     */
    public function setSandbox($sandbox, $type = 'justin_pms')
    {

        $this->sandbox = $sandbox;

        if ($sandbox) {

            $this->api[1] = "${type}_test/hs";

        } else {

            $this->api[1] = "${type}/hs";

        }

        return $this;

    }
    /**
     *
     * SET VERSION
     *
     * @param STRING $version
     *
     * @param STRING $type
     *
     * @return OBJECT
     *
     */
    private function setVersion($version = 'v2', $type = 'runRequest')
    {

        $this->api[2] = "${version}/${type}";

        return $this;

    }
    /**
     *
     * SET LANGUAGE
     *
     * @param STRING $lang
     *
     * @return OBJECT
     *
     */
    public function setLanguage($lang = 'UA')
    {

        $this->language = $lang;

        return $this;

    }
    /**
     *
     * SET AUTH LOGIN
     *
     * @param STRING $login
     *
     * @return OBJECT
     *
     */
    public function setAuthLogin($login)
    {

        $this->auth_login = $login;

        return $this;

    }
    /**
     *
     * SET AUTH PASSWORD
     *
     * @param STRING $password
     *
     * @return OBJECT
     *
     */
    public function setAuthPassword($password)
    {

        $this->auth_password = $password;

        return $this;

    }
    /**
     *
     * SET KEY
     *
     * @param STRING $key
     *
     * @return OBJECT
     *
     */
    public function setKey($key)
    {

        $this->key = $key;

        return $this;

    }
    /**
     *
     * SET LOGIN
     *
     * @param STRING $login
     *
     * @return OBJECT
     *
     */
    public function setLogin($login)
    {

        $this->login = $login;

        return $this;

    }
    /**
     *
     * SET PASSWORD
     *
     * @param STRING $password
     *
     * @return OBJECT
     *
     */
    public function setPassword($password)
    {

        $this->password = sha1(

            "{$password}:" . date('Y-m-d')

        );

        return $this;

    }
    /**
     *
     * SET ADDRESS API
     *
     * @param STRING $address_api
     *
     * @return OBJECT
     *
     */
    public function setAddressApi($address_api)
    {

        $this->api[0] = $address_api;

        return $this;

    }
    /**
     *
     * SET OPEN API URL
     *
     * @param STRING $url
     *
     * @return OBJECT
     *
     */
    public function setOpenAPI($url)
    {

        $this->open_api = $url;

        return $this;

    }
    /**
     *
     * REQUEST
     *
     * @param STRING $request
     *
     * @param STRING $type
     *
     * @param ARRAY $data
     *
     * @throws JustinAuthException
     * @throws JustinApiException
     * @throws JustinHttpException
     * @throws JustinException
     *
     * @return ARRAY
     *
     */
    private function request($request, $type, $method, $data, $query = 'post')
    {

        $response = [];
        #
        try {

            if ($query == 'post') {

                ##
                # SET FIELDS
                #
                $body = json_encode(

                    array_merge(

                        [

                            'keyAccount' => $this->login,

                            'sign'       => $this->password,

                            'request'    => $request,

                            'type'       => $type,

                            'name'       => $method,

                        ],

                        $data

                    )

                );
                #
                $result = $this->client->post(

                    implode(

                        '/',

                        $this->api

                    ),

                    [

                        'auth' => [

                            $this->auth_login,

                            $this->auth_password,

                        ],

                        'body' => $body,

                    ]

                );

            } else {

                $result = $this->client->get(

                    $this->open_api . "{$method}/{$data}"

                );

            }
            ##
            # DECODE RESPONSE
            $result = json_decode(

                $result->getBody()->getContents(),

                true

            );

            #
            if (

                (isset($result['response']['status']) && $result['response']['status']) || (isset($result['status']) && $result['status']) || (is_array($result) && count($result))

            ) {

                if (

                    isset($result['data']) || isset($result['result']) || isset($result[0]['date']) || isset($result['date'])

                ) {

                    $response = $result;

                    ##
                    # SET DEFAULT
                    #
                    $this->filter         = [];
                    $this->amount_filters = 0;
                    $this->setVersion();
                    #
                } elseif (isset($result['response']['codeError'])) {

                    throw new JustinApiException(

                        $result['response']['message']

                    );

                } else {

                    $error = 'Error API. Empty response data';

                    ##
                    # OPENAPI ERROR
                    #
                    if (isset($result['msg']) && $result['msg']) {

                        $error = $result['msg'];

                    }

                    throw new JustinApiException(

                        $error

                    );

                }

            } else {

                throw new JustinApiException(

                    json_encode($result)

                );

            }

        } catch (RequestException $exception) {

            $error = $exception->getCode();

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

                    if ($exception->getResponse()) {

                        $error = $exception->getResponse()->getBody()->getContents();

                    }

                    if (!$error) {

                        $error = $exception->getMessage();

                    }

                    break;

            }

            throw new JustinHttpException(

                $error

            );

        } catch (Exception $exception) {

            throw new JustinResponseException(

                $exception

            );

        }

        return $response;

    }
    /**
     *
     * LIST REGIONS
     * СПИСОК ОБЛАСТЕЙ
     * ДАННІ ОБЛАСТЕЙ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listRegions($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'cat_Region',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * LIST AREAS REGION
     * СПИСОК ОБЛАСТНЫХ РАЙОНОВ
     * СПИСОК ОБЛАСНИХ РАЙОНІВ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listAreasRegion($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'cat_areasRegion',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * LIST CITIES
     * СПИСОК НАСЕЛЕННЫХ ПУНКТОВ
     * СПИСОК НАСЕЛЕНИХ ПУНКТІВ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listCities($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'cat_Cities',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * LIST CITY REGIONS
     * СПИСОК РАЙОНОВ НАСЕЛЕННЫХ ПУНКТОВ
     * СПИСОК РАЙОНІВ НАСЕЛЕНИХ ПУНКТІВ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listCityRegion($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'cat_cityRegions',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * LIST STREETS CITY
     * СПИСОК УЛИЦ ГОРОДА
     * СПИСОК ВУЛИЦЬ МІСТА
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listStreetsCity($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'cat_cityStreets',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * GET LIST TYPES BRACHES
     * ПОЛУЧИТЬ СПИСОК ТИПОВ ОТДЕЛЕНИЙ
     * ОТРИМАТИ СПИСОК ТИПІВ ВІДДІЛЕНЬ
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function branchTypes($limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'cat_branchType',

                $this->getFilter(

                    [], $limit

                )

            )

        );

    }
    /**
     *
     * GET BRANCH
     * ПОЛУЧИТЬ ИНФОРМАЦИЮ ПРО ОТДЕЛЕНИЕ
     * ОТРИМАТИ ІНФОРМАЦІЮ ПРО ВІДДІЛЕННЯ
     *
     * @param STRING $id
     *
     * @return OBJECT
     *
     */
    public function getBranch($id)
    {

        return new Data(

            $this->request(

                '', '', 'branches', $id, 'get'

            )

        );

    }
    /**
     * OLD METHOD
     *
     * LIST DEPARTMENTS
     * СПИСОК ОТДЕЛЕНИЙ
     * СПИСОК ВІДДІЛЕНЬ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listDepartments($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'request', 'req_Departments',

                $this->getFilter(

                    $filter, $limit = 0

                )

            )

        );

    }
    /**
     *
     * LIST DEPARTMENTS
     * СПИСОК ОТДЕЛЕНИЙ
     * СПИСОК ВІДДІЛЕНЬ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listDepartmentsLang($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'request', 'req_DepartmentsLang',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * GET SCHEDULE BRANCHES
     * ПОЛУЧИТЬ РАСПИСАНИЕ РАБОТЫ ОТДЕЛЕНИЯ
     * ОТРИМАТИ РОЗКЛАД РОБОТИ ВІДДІЛЕННЯ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function branchSchedule($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'infoData', 'getScheduleBranch',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * GET NEAREST DEPARTMENT
     * ПОЛУЧИТЬ БЛИЖАЙШЕЕ ОТДЛЕНИЕ ПО АДРЕСУ
     * ОТРИМАТИ НАЙБЛИЖЧЕ ВІДДІЛЕННЯ ЗА АДРЕСОЮ
     *
     * @param STRING $address
     *
     * @return OBJECT
     *
     */
    public function getNeartDepartment($address)
    {

        return new Data(

            $this->request(

                '', '', 'branches_locator', $address, 'get'

            )

        );

    }
    /**
     *
     * CREATE NEW ORDER
     * СОЗДАТЬ НОВЫЙ ЗАКАЗ НА ДОСТАВКУ
     * СТВОРИТИ НОВЕ ЗАМОВЛЕННЯ НА ДОСТАВКУ
     *
     * @param ARRAY $data
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function createOrder($data = [], $version = 'v1')
    {

        ##
        $this->orderVersion(

            $this->sandbox, $version

        );
        ##
        $response = [];
        ##
        # SET DATA
        #
        if ($data) {

            $this->dataOrder = $data;

        }
        $this->dataOrder = [

            'api_key' => $this->key,

            'data'    => $this->dataOrder,

        ];
        ##
        # CHECK FIELDS
        #
        if ($this->checkFieldsOrder()) {

            try {

                $request = $this->client->post(

                    implode(

                        '/',

                        $this->orderApi

                    ),

                    [

                        'auth' => [

                            $this->auth_login,

                            $this->auth_password,

                        ],

                        'body' => json_encode(

                            $this->dataOrder

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
                ##
                # SET DEFAULT
                #
                $this->dataOrder = [];
                #

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

                        if (!$error) {

                            $error = $exception->getMessage();

                        }

                        break;

                }

                throw new JustinHttpException(

                    $error

                );

            } catch (Exception $exception) {

                throw new JustinResponseException(

                    $exception

                );

            }

        } else {

            $response = [];

        }

        return new Data(

            $response

        );

    }
    /**
     *
     * CANCEL ORDER
     * ОТМЕНА ЗАКАЗА
     * ВІДМІНА ЗАМОВЛЕННЯ
     *
     * @param STRING $number
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function cancelOrder($number, $version = 'v1')
    {

        ##
        # SET URL API
        #
        $this->setSandbox(

            $this->sandbox,

            'api_pms'

        );

        $this->setVersion(

            "api/${version}",

            'documents/orders_cancel'

        );
        #
        return new Data(

            $this->request(

                '', '', '',
                [

                    'api_key' => $this->key,

                    'number'  => $number,

                ]

            )

        );

    }
    /**
     *
     * LIST STATUSES
     * СПИСОК СТАСУСОВ ЗАКАЗА
     * СПИСОК СТАТУСІВ ЗАМОВЛЕНЬ
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function listStatuses($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'orderStatuses',

                $this->getFilter(

                    $filter, $limit

                )

            )

        );

    }
    /**
     *
     * KEY SELLER
     * КЛЮЧ ТОРГОВЦА
     * КЛЮЧ ТОРГОВЦЯ
     *
     * @param ARRAY $filter
     *
     * @return OBJECT
     *
     */
    public function keySeller($filter = [])
    {

        return new Data(

            $this->request(

                'getData', 'infoData', 'getSenderUUID',

                $this->getFilter(

                    $filter

                )

            )

        );

    }
    /**
     *
     * GET CURRENT STATUS
     * ПОЛУЧИТЬ ТЕКУЩИЙ СТАТУС ЗАКАЗА
     * ОТРИМАТИ ПОТОЧНИЙ СТАТУС ЗАМОВЛЕННЯ
     *
     * @param STRING $number
     *
     * @return OBJECT
     *
     */
    public function currentStatus($number)
    {

        return new Data(

            $this->request(

                '', '', 'tracking', $number, 'get'

            )

        );

    }
    /**
     *
     * GET TRACKING HISTORY
     * ПОЛУЧИТЬ ИСТОРИЮ ДВИЖЕНИЯ ОТПРАВЛЕНИЯ
     * ОТРИМАТИ ІСТОРІЮ РУХУ ВІДПРАВЛЕННЯ
     *
     * @param STRING $number
     *
     * @return OBJECT
     *
     */
    public function trackingHistory($number)
    {

        return new Data(

            $this->request(

                '', '', 'tracking_history', $number, 'get'

            )

        );

    }
    /**
     * OLD METHOD
     *
     * GET HISTORY STATUSES ORDERS
     * ПОЛУЧИТЬ ИСТОРИЮ СТАТУСОВ ЗАКАЗОВ
     * ОТРИМАТИ ІСТОРІЮ СТАТУСІВ ЗАМОВЛЕНЬ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @return OBJECT
     *
     */
    public function getStatusHistory($filter = [], $limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'request', 'getOrderStatusesHistory',

                $this->getFilter(

                    $filter, $limit, false

                )

            )

        );

    }
    /**
     *
     * GET HISTORY STATUSES ORDERS
     * ПОЛУЧИТЬ ИСТОРИЮ СТАТУСОВ ЗАКАЗОВ
     * ОТРИМАТИ ІСТОРІЮ СТАТУСІВ ЗАМОВЛЕНЬ
     *
     * @param ARRAY $filter
     *
     * @param INTEGER $limit
     *
     * @param STRING $senderID
     *
     * @return OBJECT
     *
     */
    public function getStatusHistoryF($filter = [], $limit = 0, $senderID = '')
    {

        $senderID = !$this->key ? $senderID : $this->key;

        $filter = $this->getFilter(

            $filter, $limit, false

        );

        if (isset($filter['filter'])) {

            array_push(

                $filter['filter'],

                [

                    'name'       => 'senderId',

                    'comparison' => 'equal',

                    'leftValue'  => $senderID,

                ]

            );

        } else {

            $filter['filter'][] = [

                'name'       => 'senderId',

                'comparison' => 'equal',

                'leftValue'  => $senderID,

            ];

        }

        return new Data(

            $this->request(

                'getData', 'request', 'getOrderStatusesHistoryF', $filter

            )

        );

    }
    /**
     *
     * GET LIST ORDERS
     * ПОЛУЧИТЬ СПИСОК ЗАКАЗОВ ЗА УКАЗАННЫЙ ПЕРИОД
     * ОТРИМАТИ СПИСОК ЗАМОВЛЕНЬ ЗА ВКАЗАНИЙ ПЕРІОД
     *
     * @param STRING $date
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function listOrders($date, $version = 'v1')
    {

        ##
        # SET URL API
        #
        $this->setSandbox(

            $this->sandbox,

            'api_pms'

        );

        $this->setVersion(

            "api/${version}",

            'documents/getListOrders'

        );

        return new Data(

            $this->request(

                '', '', '',
                [

                    'api_key' => $this->key,

                    'period'  => $date,

                ]

            )

        );

    }
    /**
     *
     * GET ORDER INFO
     * ПОЛУЧИТЬ ИНФОРМАЦИЮ О ЗАКАЗЕ
     * ОТРИМАТИ ІНФОРМАЦІЮ ПРО ЗАМОВЛЕННЯ
     *
     * @param STRING $number
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function orderInfo($number, $version = 'v1')
    {

        ##
        # SET URL API
        #
        $this->setSandbox(

            $this->sandbox,

            'api_pms'

        );

        $this->setVersion(

            "api/${version}",

            'documents/getOrderInfo'

        );

        return new Data(

            $this->request(

                '', '', '',
                [

                    'api_key'      => $this->key,

                    'order_number' => $number,

                ]

            )

        );

    }
    /**
     *
     * STICKER PDF
     * СОЗДАТЬ СТИКЕР ЗАКАЗА В ФОРМАТЕ PDF
     * СТВОРИТИ СТІКЕР ЗАМОВЛЕННЯ В ФОРМАТІ PDF
     *
     * @param INTEGER $orderNumber
     *
     * @param BOOLEAN $show
     *
     * @param STRING $path
     *
     * @param BOOLEAN $type
     *
     * @param STRING $version
     *
     * @throws JustinFileException
     *
     * @return BOOLEAN
     *
     */
    public function createSticker($orderNumber, $show = false, $path = null, $type = 0, $version = 'v1')
    {
        ##
        # GET TYPE
        #
        switch ($type) {

            case 0:

                $type = 'printSticker';

                break;
            case 1:

                $type = 'printStickerWithContactPerson';
                break;
            case 2:

                $type = 'printStickerAddress';

                break;

        }
        #
        try {

            ##
            # CHECK SANDBOX
            #
            if ($this->sandbox) {

                $space = 'api_pms_demo';

            } else {

                $space = 'pms';

            }

            $url = "{$this->address_api}/${space}/hs/api/${version}/${type}/order?order_number=${orderNumber}&api_key=" . $this->key;

            if (!$show) {

                if (!$path) {

                    throw new JustinFileException(

                        'Failed. Check path save!'

                    );

                }

                $sticker = fopen($path, 'w+');

                ##
                # SAVE PDF
                #
                $this->client->get(

                    $url,

                    [

                        'auth'               => [

                            $this->auth_login,

                            $this->auth_password,

                        ],

                        RequestOptions::SINK => $sticker,

                    ]

                );
                #
                if (file_exists($path) && filesize($path) != 0) {

                    return true;

                } else {

                    throw new JustinFileException(

                        'Failed pdf sticker. Please check arguments'

                    );

                }

            } else {

                if ($path != 'url') {

                    $request = $this->client->get(

                        $url,

                        [

                            'auth' => [

                                $this->auth_login,

                                $this->auth_password,

                            ],

                        ]

                    );

                    header('Content-type: application/pdf');
                    header('Content-Disposition: inline;');

                    echo $request->getBody()->getContents();

                } else {

                    return $url;

                }

            }

        } catch (RequestException $exception) {

            if ($path) {

                unlink($path);

            }

            if ($exception->getCode() == 401) {

                throw new JustinAuthException(

                    'Unauthorized. Please check correct login or password'

                );

            } else {

                throw new JustinApiException(

                    $exception->getResponse()->getBody()->getContents()

                );

            }

        } catch (Exception $exception) {

            throw new JustinResponseException(

                $exception

            );

        } finally {

            @fclose($sticker);

        }

        return false;

    }

}
