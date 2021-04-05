<?php

namespace Justin\Contracts;

use Justin\Justin;

/**
 *
 * Interface iJustin
 *
 * @package Justin\Contracts
 *
 */
interface iJustin
{
    /**
     *
     * INIT CLASS
     *
     * @param STRING $language
     * @param BOOLEAN $sandbox
     * @param STRING $version
     * @param STRING $timezone
     *
     * @return OBJECT
     *
     */
    public function __construct($language = 'UA', $sandbox = false, $version = 'v2', $timeout = 60, $connect_timeout = 60, $timezone = 'Europe/Kiev');
    /**
     *
     * SET SANDBOX
     *
     * @param BOOLEAN sandbox
     * @param STRING $type
     *
     * @return OBJECT
     *
     */
    public function setSandbox($sandbox, $type = 'justin_pms');
    /**
     *
     * SET LANGUAGE
     *
     * @param STRING $lang
     *
     * @return OBJECT
     *
     */
    public function setLanguage($language);
    /**
     *
     * SET AUTH LOGIN
     *
     * @param STRING $login
     *
     * @return OBJECT
     *
     */
    public function setAuthLogin($login);
    /**
     *
     * SET AUTH PASSWORD
     *
     * @param STRING $password
     *
     * @return OBJECT
     *
     */
    public function setAuthPassword($password);
    /**
     *
     * SET KEY
     *
     * @param STRING $key
     *
     * @return OBJECT
     *
     */
    public function setKey($key);
    /**
     *
     * SET LOGIN
     *
     * @param STRING $login
     *
     * @return OBJECT
     *
     */
    public function setLogin($login);
    /**
     *
     * SET PASSWORD
     *
     * @param STRING $password
     *
     * @return OBJECT
     *
     */
    public function setPassword($password);
    /**
     *
     * SET ADDRESS API
     *
     * @param STRING $address_api
     *
     * @return OBJECT
     *
     */
    public function setAddressApi($address_api);
    /**
     *
     * SET BEARER
     *
     * @param STRING $token
     *
     * @return OBJECT
     *
     */
    public function setBearer($token);
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
     * @return ARRAY
     *
     */
    public function listRegions($filter = [], $limit = 0);
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
     * @return ARRAY
     *
     */
    public function listAreasRegion($filter = [], $limit = 0);
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
     * @return ARRAY
     *
     */
    public function listCityRegion($filter = [], $limit = 0);
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
     * @return ARRAY
     *
     */
    public function listStreetsCity($filter = [], $limit = 0);
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
    public function branchTypes($limit = 0);
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
     * @return ARRAY
     *
     */
    public function listDepartmentsLang($filter = [], $limit = 0);
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
    public function branchSchedule($filter = [], $limit = 0);
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
    public function createOrder($data = [], $version = 'v1');
    /**
     *
     * CANCEL ORDER
     * ОТМЕНА ЗАКАЗА
     * ВІДМІНА ЗАМОВЛЕННЯ
     *
     * @param STRING $number
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function cancelOrder($number, $version = 'v1');
    /**
     *
     * LIST STATUSES
     * СПИСОК СТАСУСОВ ЗАКАЗА
     * СПИСОК СТАТУСІВ ЗАМОВЛЕНЬ
     *
     * @param ARRAY $filter
     * @param INTEGER $limit
     *
     * @return ARRAY
     *
     */
    public function listStatuses($filter = [], $limit = 0);
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
    public function keySeller($filter = []);
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
    public function orderInfo($number, $version = 'v1');
    /**
     *
     * GET HISTORY STATUSES ORDERS
     * ПОЛУЧИТЬ ИСТОРИЮ СТАТУСОВ ЗАКАЗОВ
     * ОТРИМАТИ ІСТОРІЮ СТАТУСІВ ЗАМОВЛЕНЬ
     *
     * @param ARRAY $filter
     * @param INTEGER $limit
     * @param STRING $senderID
     *
     * @return OBJECT
     *
     */
    public function getStatusHistoryF($filter, $limit = 0, $senderID = '');
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
    public function listOrders($date, $version = 'v1');
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
    public function createSticker($orders = null, $order = null, $path = null, $cargoPlace = null, $show = false, $version = 'v1');
    /**
     *
     * CREATE REGISTRY
     *
     * @param ARRAY $data
     * @param STRING $version
     *
     * @return OBJECT
     *
     */
    public function createRegistry($data, $version = 'v1');
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
    public function getRegistry($data, $version = 'v1');
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
    public function removeRegistry($data, $version = 'v1');
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
    public function createSession($version = 'v3');
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
    public function refreshSession($token, $version = 'v3');
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
    public function closeSession($all = false, $version = 'v3');
}
