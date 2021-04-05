![header](https://github.com/martinjack/justin/blob/master/doc/header.png?raw=true)
# Описание

[![Latest Stable Version](https://poser.pugx.org/jackmartin/justin/v/stable)](https://packagist.org/packages/jackmartin/justin) [![Total Downloads](https://poser.pugx.org/jackmartin/justin/downloads)](https://packagist.org/packages/jackmartin/justin) [![License](https://poser.pugx.org/jackmartin/justin/license)](https://packagist.org/packages/jackmartin/justin)

PHP класс для работы с API [Justin](https://justin.ua) 

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

> [Wiki - Описание работы библиотеки](https://github.com/martinjack/justin/wiki)

> [Тестирование](https://github.com/martinjack/justin/wiki/Tests)

# Документация

[API documentation](https://justin.ua/api/api_justin_documentation.pdf "PDF")

[Telegram Поддержка API](https://t.me/justin_support_api)

# Требования

* PHP 5.6 или выше
* Composer

# Composer
```bash
composer require jackmartin/justin
```

# Библиотеки 

[Guzzle](https://github.com/guzzle/guzzle)

# Основные методы API

1. Настройка подключения
    * [__construct](https://github.com/martinjack/justin#__construct)
2. Получить текущий статус заказа:
    * [currentStatus](https://github.com/martinjack/justin#currentStatus)
3. Получить список областей
    * [listRegions](https://github.com/martinjack/justin#listregions)
4. Получить список областных районов
    * [listAreasRegion](https://github.com/martinjack/justin#listareasregion)
5. Получить список населенных пунктов
    * [listCities](https://github.com/martinjack/justin#listcities)
6. Получить список районов населенных пунктов
    * [listCityRegion](https://github.com/martinjack/justin#listcityregion)
7. Получить список улиц города
    * [listStreetsCity](https://github.com/martinjack/justin#liststreetscity)
8. Получить список типов отделений 
    * [branchTypes](https://github.com/martinjack/justin#branchtypes)
9. Получить список отделений.
    * [listDepartmentsLang](https://github.com/martinjack/justin#listdepartmentslang)
10. Получить расписание работы отделения. (Старый метод)
    * [branchSchedule](https://github.com/martinjack/justin#branchschedule)
11. Создать новый заказ(Отправление)
    * [createOrder](https://github.com/martinjack/justin#createOrder)
12. Отмена заказа
    * [cancelOrder](https://github.com/martinjack/justin#cancelorder)
13. Получить список статусов заказа
    * [listStatuses](https://github.com/martinjack/justin#liststatuses)
14. Получить ключ торговца(senderID)
    * [keySeller](https://github.com/martinjack/justin#keyseller)
15. Получить историю движения отправления
    * [trackingHistory](https://github.com/martinjack/justin#trackingHistory)
16. Получить историю статусов заказа.
    * [getStatusHistoryF](https://github.com/martinjack/justin#getstatushistoryf)
17. Получить список заказов за указанный период
    * [listOrders](https://github.com/martinjack/justin#listorders)
18. Получить информацию о заказе
    * [orderInfo](https://github.com/martinjack/justin#orderinfo)
19. Создать стикер заказа
    * [createSticker](https://github.com/martinjack/justin#createsticker)

# Примеры

### __construct()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true, 'v2', 30, 30, 'Europe/Kiev');
```

### currentStatus()

```php
include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->currentStatus('201971185')->getData()

);
```

### listRegions()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listRegions()->getData()

);
```

### listAreasRegion()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listAreasRegion()

);
```

### listCities()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listCities()

);
```

### listCityRegion()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listCityRegion()

);
```

### listStreetsCity()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

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

### listDepartments()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listDepartments()

);
```

### listDepartmentsLang()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listDepartmentsLang()

);
```

### branchSchedule()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin
    ->name('Depart')
    ->equal('1a4df005-5d8d-11e8-80be-525400fb7782')
    ->branchSchedule()
    ->getData()

);
```

### cancelOrder()

```php
include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('RU', false);


$justin->setKey('Ваш ключ API');

print_r(

    $justin->cancelOrder('Код заказа')->getData()

);

```

### listStatuses()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listStatuses()

);
```

### keySeller()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

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

$justin = new Justin('RU', true);

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

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

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

use Justin\Justin;

$order = new Justin('RU', true);

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
    ->weight('10')
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

use Justin\Justin;

$order = new Justin('RU', true);

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

    $justin->orderInfo('Ваш номер заказа')->getData()

);
```

### createSticker()

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('RU', true);

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
### Стикер пример
![Sticker](https://github.com/martinjack/justin/blob/master/doc/sticker.png?raw=true "Стикер пример")