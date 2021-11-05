<?php

namespace Justin;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
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
     * ADDRESS API SANDBOX
     *
     * @var STRING
     *
     */
    private $address_api_sandbox = 'https://api.sandbox.justin.ua';
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
     * RAW PASSWORD
     *
     */
    private $rawPassword = null;
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
     * HEADERS
     *
     * @var ARRAY
     *
     */
    private $headers = [

        'Content-Type' => 'application/json',

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

            $this->api[0] = $this->address_api_sandbox;
            $this->api[1] = 'client_api/hs';

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

        $this->rawPassword = $password;
        $this->password    = sha1(

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
     * SET BEARER
     *
     * @param STRING $token
     *
     * @return OBJECT
     *
     */
    public function setBearer($token)
    {

        $this->headers['Authorization'] = 'Bearer ' . $token;

        return $this;

    }
    /**
     *
     * REQUEST
     *
     * @param STRING $request
     * @param STRING $type
     * @param STRING $method
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
    private function request($request, $type, $method, $data)
    {

        $response = [];

        #
        try {

            $result = $this->client->request(

                'POST',

                implode(

                    '/',

                    $this->api

                ),

                [

                    'headers' => $this->headers,

                    'auth'    => [

                        $this->auth_login,

                        $this->auth_password,

                    ],

                    'body'    => json_encode(

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

                    ),

                ]

            );

            ##
            # DECODE RESPONSE
            #
            $result = json_decode(

                $result->getBody()->getContents(),

                true

            );
            #
            if (

                (isset($result['response']['status']) && $result['response']['status']) || (isset($result['status']) && $result['status']) || (is_array($result) && count($result))

            ) {

                if (

                    isset($result['data']) || isset($result['result']) || isset($result[0]['date']) || isset($result['date']) || isset($result['accessToken']) || isset($result['refreshToken'])

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

                }

            } else {

                throw new JustinApiException(

                    json_encode($result)

                );

            }

        } catch (RequestException $exception) {

            $error    = $exception->getCode();
            $response = json_decode($exception->getResponse()->getBody()->getContents(), true);

            switch ($error) {

                case 401:

                    if (!isset($response['message'])) {

                        throw new JustinAuthException(

                            'Unauthorized. Please check correct login or password(401)'

                        );

                    } else {

                        throw new JustinAuthException(

                            json_encode($response)

                        );

                    }

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
     * LIST DEPARTMENTS
     * СПИСОК ОТДЕЛЕНИЙ
     * СПИСОК ВІДДІЛЕНЬ
     *
     * @param ARRAY $filter
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
     * ORDER INFO
     *
     * GET ORDER INFO
     * ПОЛУЧИТЬ ИНФОРМАЦИЮ О ЗАКАЗЕ
     * ОТРИМАТИ ІНФОРМАЦІЮ ПРО ЗАМОВЛЕННЯ
     *
     * @param STRING $number
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function orderInfo($number, $version = 'v1')
    {

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
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function listOrders($date, $version = 'v1')
    {

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
     * CREATE STICKER
     *
     * СТВОРЕННЯ СТІКЕРІВ
     * СОЗДАНИЕ СТИКЕРОВ
     *
     * @param ARRAY $orders
     * @param STRING $order
     * @param STRING $path
     * @param STRING $cargoPlace
     * @param BOOLEAN $show
     * @param STRING $version
     *
     * @return BOOLEAN | OBJECT | NULL
     *
     */
    public function createSticker($orders = null, $order = null, $path = null, $cargoPlace = null, $show = false, $version = 'v1')
    {

        $url = [

            $this->api[0],

            $this->sandbox ? 'client_api' : 'justin_pms',

            'hs/api',

            $version,

            'printSticker',

            'order',

        ];

        try {

            $data = [

                'headers' => [

                    'Content-Type' => 'application/json',

                ],

                'auth'    => [

                    $this->auth_login,

                    $this->auth_password,

                ],

            ];

            if (is_array($orders)) {

                $type         = 'POST';
                $url[4]       = 'printPackageStickers';
                $url[5]       = 'print';
                $data['body'] = json_encode(

                    [

                        'api_key'           => $this->key,
                        'order_number_list' => $orders,

                    ]

                );

            } else {

                $type  = 'GET';
                $url[] = sprintf(

                    '?api_key=%s&order_number=%s&cargo_place=%s',

                    $this->key,

                    $order,

                    $cargoPlace

                );

            }

            $url = implode('/', $url);

            print_r($url);

            if (!$show) {

                if (!$path) {

                    throw new JustinFileException(

                        'Failed. Check path save!'

                    );

                }

                $stickers     = fopen($path, 'w+');
                $data['sink'] = $stickers;

                $this->client->request(

                    $type,

                    $url,

                    $data

                );

                ##
                # VALID PDF
                #
                if (file_exists($path) && filesize($path) != 0) {

                    return true;

                } else {

                    throw new JustinFileException(

                        'Failed pdf sticker. Please check arguments'

                    );

                }
                #

            } elseif ($path != 'url') {

                $pdf = $this->client->request(

                    $type,

                    $url,

                    $data

                );

                echo $pdf->getBody()->getContents();

            } else {

                return $url;

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

            @fclose($stickers);

        }

        return false;

    }
    /**
     *
     * CREATE REGISTRY
     *
     * СОЗДАНИЕ РЕЕСТРА ОТПРАВЛЕНИЙ
     * СТВОРЕННЯ РЕЄСТРУ ВІДПРАВЛЕНЬ
     * CREATION REGISTRY ORDERS
     *
     * @param ARRAY $data
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function createRegistry($data, $version = 'v1')
    {

        $this->setVersion(

            "api/${version}",

            'documents/pickup/add'

        );

        return new Data(

            $this->request(

                '', '', '',

                [

                    'api_key' => $this->key,
                    'data'    => $data,

                ]

            )

        );

    }
    /**
     *
     * GET REGISTRY
     *
     * ПОЛУЧИТЬ ИНФОРМАЦИЮ ПРО РЕЕСТР ОТПРАВЛЕНИЙ
     * ОТРИМАТИ ІНФОРМАЦІЯ ПРО РЕЄСТР ВІДПРАВЛЕНЬ
     * GET INFO REGISTRY ORDERS
     *
     * @param ARRAY $data
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function getRegistry($data, $version = 'v1')
    {

        $this->setVersion(

            "api/${version}",

            'documents/pickup/get'

        );

        return new Data(

            $this->request(

                '', '', '',

                [

                    'api_key' => $this->key,
                    'data'    => $data,

                ]

            )

        );

    }
    /**
     *
     * REMOVE REGISTRY
     *
     * УДАЛЕНИЕ РЕЕСТРА ОТПРАВЛЕНИЙ
     * ВИДАЛЕННЯ РЕЄСТРУ ВІДПРАВЛЕНЬ
     * REMOVE REGISTRY ORDERS
     *
     * @param ARRAY $data
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function removeRegistry($data, $version = 'v1')
    {

        $this->setVersion(

            "api/${version}",

            'documents/pickup/del'

        );

        return new Data(

            $this->request(

                '', '', '',

                [

                    'api_key' => $this->key,
                    'data'    => $data,

                ]

            )

        );

    }
    /**
     *
     * CREATE SESSION
     *
     * ОТКРЫТЬ СЕССИЮ
     * ВІДКРИТИ СЕСІЮ
     * OPEN SESSION
     *
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function createSession($version = 'v3')
    {

        $this->api[1] = 'client_api';

        $this->setVersion(

            "${version}",

            'auth/login'

        );

        return new Data(

            $this->request(

                '', '', '',

                [

                    'login'    => $this->login,
                    'password' => $this->rawPassword,

                ]

            )

        );

    }
    /**
     *
     * REFRESH SESSION
     *
     * ОБНОВИТЬ КЛЮЧ СЕССИИ
     * ОНОВИТИ КЛЮЧ СЕСІЇ
     * REFRESH KEY SESSION
     *
     * @param STRING $token
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function refreshSession($token, $version = 'v3')
    {

        $this->api[1] = 'client_api';

        $this->setVersion(

            "${version}",

            'auth/refresh'

        );

        return new Data(

            $this->request(

                '', '', '',

                [

                    'refreshToken' => $token,

                ]

            )

        );

    }
    /**
     *
     * CLOSE SESSION
     *
     * ЗАКРЫТЬ СЕССИЮ
     * ЗАКРИТИ СЕСІЮ
     * CLOSE SESSION
     *
     * @param BOOLEAN $all
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function closeSession($all = false, $version = 'v3')
    {

        $this->api[1] = 'client_api';

        $this->setVersion(

            "${version}",

            $all ? 'auth/close' : 'auth/logout'

        );

        return new Data(

            $this->request(

                '', '', '', []

            )

        );

    }
    /**
     *
     * CALCULATE PRICE SERVICE
     *
     * КАЛЬКУЛЯТОР СТОИМОСТИ УСЛУГ
     * КАЛЬКУЛЯТОР ВАРТОСТІ ПОСЛУГ
     *
     * @param ARRAY $data
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function calculatePriceService($data, $version = 'v1'): object
    {

        $this->setVersion(

            "api/${version}",

            'documents/CALCULATEPRICE'

        );

        return new Data(

            $this->request(

                '', '', '',

                [

                    'api_key' => $this->key,
                    'data'    => $data,

                ]

            )

        );

    }

}
