![header](https://github.com/martinjack/justin/blob/master/doc/header.png?raw=true)
# Опис

[![Latest Stable Version](https://poser.pugx.org/jackmartin/justin/v/stable)](https://packagist.org/packages/jackmartin/justin) [![Total Downloads](https://poser.pugx.org/jackmartin/justin/downloads)](https://packagist.org/packages/jackmartin/justin) [![License](https://poser.pugx.org/jackmartin/justin/license)](https://packagist.org/packages/jackmartin/justin)

PHP клас для роботи з API [Justin](https://justin.ua) 

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

> [Wiki - Опис роботи бібліотеки](https://github.com/martinjack/justin/wiki)

> [Тестування](https://github.com/martinjack/justin/wiki/Tests)

# Документація

[API documentation](https://justin.ua/api/api_justin_documentation.pdf "PDF")

[Telegram підтримка API](https://t.me/justin_support_api)

# Вимога

* PHP 5.6 або вище
* Composer

# Composer
```bash
composer require jackmartin/justin
```

# Бібліотеки

[Guzzle](https://github.com/guzzle/guzzle)

# Основні методи API

1. Налаштування підключення
    * [__construct](https://github.com/martinjack/justin/blob/master/README.ua.md#__construct)
2. Отримати поточний статус замовлення:
    * [currentStatus](https://github.com/martinjack/justin/blob/master/README.ua.md#currentStatus)
3. Отримати список областей
    * [listRegions](https://github.com/martinjack/justin/blob/master/README.ua.md#listregions)
4. Отримати список обласних районів
    * [listAreasRegion](https://github.com/martinjack/justin/blob/master/README.ua.md#listareasregion)
5. Отримати список населених пунктів
    * [listCities](https://github.com/martinjack/justin/blob/master/README.ua.md#listcities)
6. Отримати список районів населених пунктів
    * [listCityRegion](https://github.com/martinjack/justin/blob/master/README.ua.md#listcityregion)
7. Отримати список вулиць міста
    * [listStreetsCity](https://github.com/martinjack/justin/blob/master/README.ua.md#liststreetscity)
8. Отримати список типів відділень
    * [branchTypes](https://github.com/martinjack/justin/blob/master/README.ua.md#branchtypes)
9. Отримати список відділень.
    * [listDepartmentsLang](https://github.com/martinjack/justin/blob/master/README.ua.md#listdepartmentslang)
10. Отримати розклад роботи відділень. (Старий метод)
    * [branchSchedule](https://github.com/martinjack/justin/blob/master/README.ua.md#branchschedule)
11. Створити нове замовлення(Відправлення)
    * [createOrder](https://github.com/martinjack/justin/blob/master/README.ua.md#createOrder)
12. Відміна замовлення
    * [cancelOrder](https://github.com/martinjack/justin#cancelorder)
13. Отримати список статусів замовлення
    * [listStatuses](https://github.com/martinjack/justin/blob/master/README.ua.md#liststatuses)
14. Отримати ключ торговця(senderID)
    * [keySeller](https://github.com/martinjack/justin/blob/master/README.ua.md#keyseller)
15. Отримати історію руху відправлення
    * [trackingHistory](https://github.com/martinjack/justin/blob/master/README.ua.md#trackingHistory)
16. Отримати історію статусів замовлення.
    * [getStatusHistoryF](https://github.com/martinjack/justin/blob/master/README.ua.md#getstatushistoryf)
17. Отримати список замовлень за вказаний період
    * [listOrders](https://github.com/martinjack/justin/blob/master/README.ua.md#listorders)
18. Отримати інформацію про замовлення
    * [orderInfo](https://github.com/martinjack/justin/blob/master/README.ua.md#orderinfo)
19. Створити стікер замовлення
    * [createSticker](https://github.com/martinjack/justin/blob/master/README.ua.md#createsticker)
20. Калькулятор вартості послуг
    * [calculatePriceService](https://github.com/martinjack/justin#calculatepriceservice)

# Приклади

### __construct()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true, 'v2', 30, 30, 'UTC');
```

### currentStatus()

```php
include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->currentStatus('201971185')->getData()

);
```

### listRegions()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listRegions()->getData()

);
```

### listAreasRegion()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listAreasRegion()

);
```

### listCities()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listCities()

);
```

### listCityRegion()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listCityRegion()

);
```

### listStreetsCity()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listStreetsCity(

        [

            [

                'name'       => 'objectOwner',

                'comparison' => 'equal',

                'leftValue'  => '32b69b95-9018-11e8-80c1-525400fb7782',

            ]

        ]

    )

    // $justin->name('objectOwner')->leftValue('32b69b95-9018-11e8-80c1-525400fb7782')->equal()->listStreetsCity()
    // $justin->name('objectOwner')->equal('32b69b95-9018-11e8-80c1-525400fb7782')->listStreetsCity()

);
```

### branchTypes()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->branchTypes()->getData()

);
```

### getBranch()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

print_r(

    $justin->getBranch('220')->getData()
    // $justin->getBranch('220')->fields()->number()
    // $justin->getBranch('220')->fields()->getType()
    // $justin->getBranch('220')->fields()->address()
    // $justin->getBranch('220')->fields()->getPosition()
    // $justin->getBranch('220')->fields()->getDescr()
    // $justin->getBranch('220')->fields()->scheduDescr()

);
```

### listDepartments()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listDepartments()

);
```

### listDepartmentsLang()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listDepartmentsLang()

);
```

### cancelOrder()

```php
include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('UA', false);


$justin->setKey('Ваш ключ API');

print_r(

    $justin->cancelOrder('Код замовлення')->getData()

);

```

### listStatuses()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->listStatuses()

);
```

### keySeller()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

print_r(

    $justin->keySeller(

        [

            [

                'name'       => 'login',

                'comparison' => 'equal',

                'leftValue'  => 'test',

            ],

        ]

    )
    
    // $justin->name('login')->leftValue('test')->equal()->keySeller()
    // $justin->name('login')->equal('test')->keySeller()

);
```

### trackingHistory()

```php
include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('UA', true);

print_r(

    $justin->trackingHistory('201810165')->getData()
    // $justin->trackingHistory('201810165')->fields()->orderNumber()
    // $justin->trackingHistory('201810165')->fields()->orderDescr()
    // $justin->trackingHistory('201810165')->fields()->status()
    // $justin->trackingHistory('201810165')->fields()->date()
    // $justin->trackingHistory('201810165')->fields()->time()
    // $justin->trackingHistory('201810165')->fields()->dateAdded()
    // $justin->trackingHistory('201810165')->fields()->deparNumber()
    // $justin->trackingHistory('201810165')->fields()->deparAddress()

);
```

### getStatusHistoryF()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setLogin('Ваш логін')->setPassword('Ваш пароль');

$justin->setKey('Ваш ключ API');

print_r(

    $justin->getStatusHistoryF(

        [

            'name'       => 'orderNumber',

            'comparison' => 'equal',

            'leftValue'  => '000000004',

        ]

    )

    // $justin->name('orderNumber')->leftValue('000000004')->equal()->getStatusHistory()
    // $justin->name('orderNumber')->equal('000000004')->getStatusHistory()

);
```
### createOrder()

#### Пример 1

```php
include_once 'vendor/autoload.php';

use Justin\Order;

$order = new Order('UA', true);

$order->setKey('Ваш ключ');

$newOrder = $order
    ->setNumber('52525')
    ->setDate()
    ->senderCityID(

        '32b69b95-9018-11e8-80c1-525400fb7782'

    )
    ->sender('ТОП ПРОДАЦЕЦ')
    ->senderContact('Иванов Иван')
    ->senderPhone('380524152299')
    ->addressPickup('ул. Груша. 7')
    ->requirePickup(true)
    ->senderBranchID(

        '2100102032'

    )
    ->receiver('ТОВ Укрпочта')
    ->receiverContact('Петр 1')
    ->receiverPhone('380425831259')
    ->countPlace(1)
    ->receiverBranchID(

        '2100108028'

    )
    ->volume('0.02')
    ->weight('100')
    ->costDeclared(1500)
    ->deliveryAmount(0)
    ->redeliveryAmount(1500)
    ->orderAmount(1500)
    ->redeliveryPay(true)
    ->redeliveryPayer(1)
    ->deliveryPay(true)
    ->deliveryPayer(1)
    ->requireDelivery(false)
    ->orderPay(true)
    ->comment('Тест заказ')
    ->createOrder();

print_r(

    $newOrder->fields()->number()
    // $newOrder->fields()->ttn()
    // $newOrder->getData()
    // $newOrder->getResult()
    // $newOrder->getRaw()

);

```

#### Пример 2

```php
include_once 'vendor/autoload.php';

use Justin\Order;

$order = new Order('UA', true);

$order->setKey('Ваш ключ');

$newOrder = $order->createOrder(

    [
        'number'                         => '123456',

        'date'                           => '20171221',

        'sender_city_id'                 => '32b69b95-9018-11e8-80c1-525400fb7782',

        'sender_company'                 => 'УА ТОВ',

        'sender_contact'                 => 'Петрова Ирина',

        'sender_phone'                   => '+380991112233',

        'sender_pick_up_address'         => 'Степана Бандери, No 6',

        'pick_up_is_required'            => true,

        'sender_branch'                  => '2100102032',

        'receiver'                       => 'Петров Сергей',

        'receiver_contact'               => '',

        'receiver_phone'                 => 'Петров Сергей',

        'count_cargo_places'             => 2,

        'branch'                         => '2100108028',

        'weight'                         => 0.1,

        'volume'                         => 0.02,

        'declared_cost'                  => 1500,

        'delivery_amount'                => 0,

        'redelivery_amount'              => 1500,

        'order_amount'                   => 1500,

        'redelivery_payment_is_required' => true,

        'redelivery_payment_payer'       => 1,

        'delivery_payment_is_required'   => true,

        'delivery_payment_payer'         => 1,

        'delivery_is_required'           => false,

        'order_payment_is_required'      => true,

        'add_description'                => 'Тест API'
    ]

);

print_r(

    $newOrder->fields()->number()
    // $newOrder->fields()->ttn()
    // $newOrder->getData()
    // $newOrder->getResult()
    // $newOrder->getRaw()

);
```

### listOrders()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setKey('Ваш ключ');

print_r(

    $justin->listOrders('20190505')->getData()

);
```

### orderInfo()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setKey('Ваш ключ');

print_r(

    $justin->orderInfo('Ваш номер замовлення')->getData()

);
```

### createSticker()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('UA', true);

$justin->setKey('Ваш ключ');

print_r(

    $justin->createSticker(

        null, '400144837', __DIR__ . '/' . time() . '.pdf', null, false

    )

    // $justin->createSticker(

    //     [400144837, 400144837], null, __DIR__ . '/t.pdf', null, false

    // )

);

```
### Стікер приклад
![Sticker](https://github.com/martinjack/justin/blob/master/doc/sticker.png?raw=true "Стікер приклад")

### calculatePriceService()
```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль')->setKey('Ваш ключ');

print_r(

    $justin->calculatePriceService([

        'point_a_locality_uuid' => 'e7ebcef9-dbfb-11e7-80c6-00155dfbfb00',
        'point_b_locality_uuid' => 'e7ebcef9-dbfb-11e7-80c6-00155dfbfb00',
        'weight'                => 35.0,
        'cargo_details'         => [
            [
                'cargo_description' => 'fdd20d8b-1375-11eb-a2e5-0050569bda1b',
                'amount'            => 0,
            ],
     
            [
                'cargo_description' => 'bed96769-1386-11eb-a2e5-0050569bda1b',
                'amount'            => 1,
            ],
     
        ],
        'cargo_places_array'    => [
      
            [
                'weight' => 10,
                'width'  => 2,
                'height' => 1,
                'depth'  => 1,
            ],
      
            [
                'weight' => 5,
                'width'  => 1,
                'height' => 1,
                'depth'  => 1,
            ],
      
      ],

    ])->getData()

);
```