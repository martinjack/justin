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

/**
 *
 * Class Justin
 *
 * @package Justin
 *
 */
class Justin extends Filter implements iJustin
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
     * API URL
     *
     * @var STRING
     *
     */
    private $api = 'http://195.201.72.186/';
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
    private $login = '';
    /**
     *
     * PASSWORD
     *
     * @var STRING
     *
     */
    private $password = '';
    /**
     *
     * LANGUAGE
     *
     * @var STRING
     *
     */
    private $language = 'ua';
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

        return $this
            ->setSandbox($sandbox)
            ->setVersion($version)
            ->setLanguage($language);

    }
    /**
     *
     * SET SANDBOX
     *
     * @param BOOLEAN
     *
     * @return OBJECT
     *
     */
    public function setSandbox($sandbox)
    {

        $this->sandbox = $sandbox;

        if ($sandbox) {

            $this->api = $this->api . 'justin_pms_test/hs/';

        } else {

            $this->api = $this->api . 'justin_pms/hs/';

        }

        return $this;

    }
    /**
     *
     * SET VERSION
     *
     * @param STRING
     *
     * @return OBJECT
     *
     */
    public function setVersion($version = 'v2')
    {

        $this->api = $this->api . "${version}/runRequest";

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

        $this->auth_password = $auth_password;

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
    private function request($request, $type, $method, $data)
    {
        $response = [];
        #
        if (!$this->login || !$this->password) {

            throw new JustinAuthException('Failed auth data. Please enter login or password');

        }
        ##
        # SET DEFAULT FIELDS
        #
        $params = [

            'keyAccount' => $this->login,

            'sign'       => $this->password,

            'request'    => $request,

            'type'       => $type,

            'name'       => $method,

        ];
        #
        try {

            $result = $this->client->post(

                $this->api,

                [

                    'auth' => [

                        $this->auth_login,

                        $this->auth_password,

                    ],

                    'body' => json_encode(

                        array_merge($params, $data)

                    ),

                ]

            );
            ##
            # DECODE RESPONSE
            $result = json_decode(

                $result->getBody()->getContents(),

                true

            );
            #
            if ($result['response']['status']) {

                if (isset($result['data'])) {

                    $response = $result;

                    ##
                    # SET DEFAULT
                    $this->filter = [];
                    $this->limit  = 10;
                    ##
                } else {

                    throw new JustinApiException(

                        'Error API. Empty response data'

                    );

                }

            } else {

                throw new JustinApiException(

                    'Error API: ' . json_encode($result)

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

                    $error = $exception->getResponse()->getBody()->getResponse();

                    break;

            }

            throw new JustinHttpException(

                $error

            );

        } catch (Exception $exception) {

            throw new JustinException(

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

                'getData', 'catalog', 'cat_Region', [

                    'language' => $this->language,

                    'TOP'      => $this->getLimit(

                        $limit

                    ),

                    'filter'   => $this->getFilter(

                        $filter

                    ),

                ]

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

                'getData', 'catalog', 'cat_areasRegion', [

                    'laguange' => $this->language,

                    'TOP'      => $this->getLimit(

                        $limit

                    ),

                    'filter'   => $this->getFilter(

                        $filter

                    ),

                ]

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

                'getData', 'catalog', 'cat_Cities', [

                    'language' => $this->language,

                    'TOP'      => $this->getLimit(

                        $limit

                    ),

                    'filter'   => $this->getFilter(

                        $filter

                    ),

                ]

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

                'getData', 'catalog', 'cat_cityRegions', [

                    'language' => $this->language,

                    'TOP'      => $this->getLimit(

                        $limit

                    ),

                    'filter'   => $this->getFilter(

                        $filter

                    ),

                ]

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

                'getData', 'catalog', 'cat_cityStreets', [

                    'language' => $this->language,

                    'TOP'      => $this->getLimit(

                        $limit

                    ),

                    'filter'   => $this->getFilter(

                        $filter

                    ),

                ]

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

                'getData', 'request', 'req_Departments', [

                    'TOP'    => $this->getLimit(

                        $limit

                    ),

                    'filter' => $this->getFilter(

                        $filter

                    ),

                ]

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

                'getData', 'request', 'req_DepartmentsLang', [

                    'language' => $this->language,

                    'params'   => [

                        'lagnauge' => $this->language,

                    ],

                    'TOP'      => $this->getLimit(

                        $limit

                    ),

                    'filter'   => $this->getFilter(

                        $filter

                    ),

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
    public function listStatuses($limit = 0)
    {

        return new Data(

            $this->request(

                'getData', 'catalog', 'orderStatuses', [

                    'TOP' => $this->getLimit(

                        $limit

                    ),

                ]

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

                'getData', 'infoData', 'getSenderUUID', [

                    'filter' => $this->getFilter(

                        $filter

                    ),

                ]

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
     * @return OBJECT
     *
     */
    public function getStatusHistory($filter = [])
    {

        return new Data(

            $this->request(

                'getData', 'request', 'getOrderStatusesHistory', [

                    'filter' => $this->getFilter(

                        $filter

                    ),

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
     * @param STRING $senderID
     *
     * @return OBJECT
     *
     */
    public function getStatusHistoryF($filter = [], $senderID = '')
    {

        $senderID = !$this->key ? $senderID : $this->key;

        return new Data(

            $this->request(

                'getData', 'request', 'getOrderStatusesHistoryF', [

                    'filter' => [

                        [

                            'name'       => 'senderId',

                            'comparison' => 'equal',

                            'leftValue'  => $senderID,

                        ],

                        $filter,

                    ],
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
     * @param STRING $path
     *
     * @param BOOLEAN $type
     *
     * @param STRING $version
     *
     * @return BOOLEAN
     *
     */
    public function createSticker($orderNumber, $path, $type = false, $version = 'v1')
    {

        if (!$type) {

            $type = 'printSticker';

        } else {

            $type = 'printStickerWithContactPerson';

        }

        try {

            $sticker = fopen($path, 'w+');

            ##
            # SAVE PDF
            #
            $this->client->get(

                "http://195.201.72.186/pms/hs/api/{$version}/{$type}/order?order_number={$orderNumber}&api_key=" . $this->key,

                [

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

        } catch (RequestException $exception) {

            if ($exception->getCode() == 401) {

                throw new JustinAuthException(

                    'Unauthorized. Please check correct login or password'

                );

            } else {

                throw new JustinApiException(

                    'Error API: ' . $exception->getResponse()->getBody()->getContents()

                );

            }

        } catch (Exception $exception) {

            throw new JustinException(

                $exception

            );

        } finally {

            @fclose($sticker);

        }

        return false;

    }

}
