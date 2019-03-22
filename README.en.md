![header](https://github.com/martinjack/justin/blob/master/doc/header.png?raw=true)
# Description

PHP class to work with Justin API

> Read this in other language: [English](README.en.md), [Русский](README.md), [Український](README.ua.md)

> [Wiki - Description library](https://github.com/martinjack/justin/wiki)

# Documentation

[API documentation v6.0.1](https://github.com/martinjack/justin/blob/master/doc/API_JustIn_v6.0.1_UKR.pdf "PDF")

# Requirements

* PHP 7.0 or above
* Composer

# Composer
```bash
composer require jackmartin/justin
```

# Libraries

[Guzzle](https://github.com/guzzle/guzzle)

# Basic methods API

1. Get list regions.
    * [listRegions](https://github.com/martinjack/justin#listregions)
2. Get list regional areas.
    * [listAreasRegions](https://github.com/martinjack/justin#listareasregions)
3. Get list settlements.
    * [listCities](https://github.com/martinjack/justin#listcities)
4. Get list areas of settlements
    * [listCityRegion](https://github.com/martinjack/justin#listcityregion)
5. Get list streets city.
    * [listStreetsCity](https://github.com/martinjack/justin#liststreetscity)
6. Get list departments. Old method
    * [listDepartments](https://github.com/martinjack/justin#listdepartments)
7. Get list departments.
    * [listDepartmentsLang](https://github.com/martinjack/justin#listdepartmentslang)
8. Get list statuses order.
    * [listStatuses](https://github.com/martinjack/justin#liststatuses)
9. Get key seller(senderID)
    * [keySeller](https://github.com/martinjack/justin#keyseller)
10. Get story statuses order. Old method
    * [getStatusHistory](https://github.com/martinjack/justin#getstatushistory)
11. Get story statuses order.
    * [getStatusHistoryF](https://github.com/martinjack/justin#getstatushistoryf)
12. Create new order(Departure)
    * [Order](https://github.com/martinjack/justin#order)
13. Create sticker order
    * [createSticker](https://github.com/martinjack/justin#createsticker)

# Examples

### listRegions() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->listRegions()

);
```

### listAreasRegions() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->listAreasRegion()

);
```

### listCities() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->listCities()

);
```

### listCityRegion() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->listCityRegion()

);
```

### listStreetsCity() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

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

### listDepartments() ####

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->listDepartments()

);
```

### listDepartmentsLang() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->listDepartmentsLang()

);
```

### listStatuses() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->listStatuses()

);
```

### keySeller() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

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

### getStatusHistory() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->getStatusHistory(

        [

            [

                'name'       => 'orderNumber',

                'comparison' => 'equal',

                'leftValue'  => '000000004',

            ],

        ]

    )

    // $justin->name('orderNumber')->leftValue('000000004')->equal()->getStatusHistory()
    // $justin->name('orderNumber')->equal('000000004')->getStatusHistory()

);
```

### getStatusHistoryF() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

print_r(

    $justin->getStatusHistory(

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
### order() ###

#### Example 1

```php
include_once 'vendor/autoload.php';

use Justin\Order;

$order = new Order('EN', true);

$order->setKey('e315ffa3-94bd-11e8-80c1-525400fb7782');

$newOrder = $order
    ->setNumber('52525')
    ->setDate()
    ->senderCityID(

        '32b69b95-9018-11e8-80c1-525400fb7782'

    )
    ->sender('ТОП ПРОДАЦЕЦ')
    ->senderContact('Иванов Иван')
    ->senderPhone('380524152299')
    ->addressReceipt('ул. Груша. 7')
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
    ->create();

print_r(

    $newOrder->fields()->number()
    // $newOrder->fields()->ttn()
    // $newOrder->getData()
    // $newOrder->getResult()
    // $newOrder->getRaw()

);

```

#### Example 2

```php
include_once 'vendor/autoload.php';

use Justin\Order;

$order = new Order('EN', true);

$order->setKey('e315ffa3-94bd-11e8-80c1-525400fb7782');

$newOrder = $order->create(

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

### createSticker() ###

```php
use Justin\Justin;

include_once 'vendor/autoload.php';

$justin = new Justin('EN', true);

$justin->setKey('e315ffa3-94bd-11e8-80c1-525400fb7782');

print_r(

    $justin->createSticker(

        '877893', __DIR__ . '/' . time() . '.pdf'

    )

);

print_r(

    $justin->createSticker(

        '877893', __DIR__ . '/' . time() . '.pdf', true

    )

);
```
### Sticker has name or FIO sender and receiver
![Sticker1](https://github.com/martinjack/justin/blob/master/doc/sticker1.png?raw=true "Example sticker order. Sticker has name or FIO sender and receiver")
### Sticker has names sender and receiver
![Sticker2](https://github.com/martinjack/justin/blob/master/doc/sticker2.png?raw=true "Example sticker order. Sticker has names sender and receiver")