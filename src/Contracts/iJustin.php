<?php

namespace Justin\Contracts;

use Justin\Justin;

/**
 *
 * Interface iJustin
 *
 * @package Justin
 *
 */
interface iJustin
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
     * @param STRING $timezone
     *
     * @return OBJECT
     *
     */
    public function __construct($language = 'UA', $sandbox = false, $version = 'v2', $timeout = 60, $connect_timeout = 60, $timezone = 'UTC');
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
     * GET BRANCH
     * ПОЛУЧИТЬ ИНФОРМАЦИЮ ПРО ОТДЕЛЕНИЕ
     * ОТРИМАТИ ІНФОРМАЦІЮ ПРО ВІДДІЛЕННЯ
     *
     * @return OBJECT
     *
     */
    public function getBranch($id);
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
     * @return ARRAY
     *
     */
    public function listDepartments($filter = [], $limit = 0);
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
     * GET NEAREST DEPARTMENT
     * ПОЛУЧИТЬ БЛИЖАЙШЕЕ ОТДЛЕНИЕ ПО АДРЕСУ
     * ОТРИМАТИ НАЙБЛИЖЧЕ ВІДДІЛЕННЯ ЗА АДРЕСОЮ
     *
     * @param STRING $address
     *
     * @return OBJECT
     *
     */
    public function getNeartDepartment($address);
    /**
     *
     * LIST STATUSES
     * СПИСОК СТАСУСОВ ЗАКАЗА
     * СПИСОК СТАТУСІВ ЗАМОВЛЕНЬ
     *
     * @param INTEGER $limit
     *
     * @return ARRAY
     *
     */
    public function listStatuses($limit = 0);
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
     * GET CURRENT STATUS
     * ПОЛУЧИТЬ ТЕКУЩИЙ СТАТУС ЗАКАЗА
     * ОТРИМАТИ ПОТОЧНИЙ СТАТУС ЗАМОВЛЕННЯ
     *
     * @param STRING $number
     *
     * @return OBJECT
     *
     */
    public function currentStatus($number);
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
    public function trackingHistory($number);
    /**
     * OLD METHOD
     *
     * GET HISTORY STATUSES ORDERS
     * ПОЛУЧИТЬ ИСТОРИЮ СТАТУСОВ ЗАКАЗОВ
     * ОТРИМАТИ ІСТОРІЮ СТАТУСІВ ЗАМОВЛЕНЬ
     *
     * @param ARRAY $filter
     *
     * @return VOID
     *
     */
    public function getStatusHistory($filter = []);
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
     * @return VOID
     *
     */
    public function getStatusHistoryF($filter, $senderID = '');
    /**
     *
     * STICKER PDF
     *
     * @param INTEGER $orderNumber
     *
     * @param STRING $path
     *
     * @param BOOLEAN $type
     *
     * @return BOOLEAN
     *
     */
    public function createSticker($orderNumber, $path, $type = false);

}
