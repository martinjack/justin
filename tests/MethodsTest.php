<?php
declare (strict_types = 1);

namespace Justin\Tests;

use Justin\Data;
use Justin\Justin;
use PHPUnit\Framework\TestCase;

/**
 *
 * Class MethodsTest
 *
 * @package Justin\Tests
 *
 */
final class MethodsTest extends TestCase
{
    /**
     *
     * KEY
     *
     * @var STRING
     *
     */
    private $key = '';
    /**
     *
     * LOGIN
     *
     * @var STRING
     *
     */
    private $login = 'Exchange';
    /**
     *
     * PASSWORD
     *
     * @var STRING
     *
     */
    private $password = 'Exchange';
    /**
     *
     * NUMBER
     *
     * @var STRING
     *
     */
    private $number = '';
    /**
     *
     * PERIOD
     *
     * @var STRING
     *
     */
    private $period = '';
    /**
     *
     * JUSTIN
     *
     * @var OBJECT
     *
     */
    private $justin = null;

    /**
     *
     * INIT CLASS JUSTIN
     *
     * @return VOID
     *
     */
    public function setUp(): void
    {

        #
        $this->key = getenv('key');

        $this->login = getenv('login');

        $this->password = getenv('password');

        $this->number = getenv('number');

        $this->period = getenv('period');
        #

        $this->justin = new Justin('UA', true);

        $this->justin
            ->setKey($this->key)
            ->setLogin($this->login)
            ->setPassword($this->password);

    }
    /**
     *
     * TEAR DOWN
     *
     * @return VOID
     *
     */
    public function tearDown(): void
    {

        $this->justin = null;

    }
    /**
     *
     * TEST AVAILABLE API
     *
     * @return VOID
     *
     */
    public function testAvailableApi(): void
    {

        exec('ping -c 2 195.201.72.186', $output, $status);

        $this->assertFalse((bool) $status);

    }
    /**
     *
     * TEST METHOD LIST REGIONS
     *
     * @return VOID
     *
     */
    public function testListRegions(): void
    {

        $data = $this->justin->listRegions();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD LIST AREAS REGIONS
     *
     * @return VOID
     *
     */
    public function testListAreasRegions(): void
    {

        $data = $this->justin->listAreasRegion();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD LSIT CITIES
     *
     * @return VOID
     *
     */
    public function testListCities(): void
    {

        $data = $this->justin->listCities();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD LIST CITY REGION
     *
     * @return VOID
     *
     */
    public function testListCityRegion(): void
    {

        $data = $this->justin->listCityRegion();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD LIST STREETS CITY
     *
     * @return VOID
     *
     */
    public function testListStreetsCity(): void
    {

        $data = $this->justin->name('objectOwner')->equal('32b69b95-9018-11e8-80c1-525400fb7782')->listStreetsCity();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD BRANCH TYPES
     *
     * @return VOID
     *
     */
    public function testBranchTypes(): void
    {

        $this->justin->setSandbox(false);

        $data = $this->justin->branchTypes();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

        $this->justin->setSandbox(true);

    }
    /**
     *
     * TEST METHOD GET BRANCH
     *
     * @return VOID
     *
     */
    public function testGetBranch(): void
    {

        $data = $this->justin->getBranch('220');

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            (bool) $data->getRaw()['status']

        );

    }
    /**
     *
     * TEST METHOD LIST DEPARTMENTS
     *
     * @return VOID
     *
     */
    public function testListDepartments(): void
    {

        $data = $this->justin->listDepartments();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD LIST DEPARTMENTS WITH FILTER
     *
     * @return VOID
     *
     */
    public function testListDepartmentsFilter(): void
    {

        $data = $this->justin->limit(1)->listCityRegion();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD LIST DEPARTMENTSLANG
     *
     * @return VOID
     *
     */
    public function testListDepartmentsLang(): void
    {

        $data = $this->justin->listDepartmentsLang();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD LIST DEPARTMENTSLANG WITH FILTER
     *
     * @return VOID
     *
     */
    public function testListDepartmentsLangFilter(): void
    {

        $data = $this->justin->limit(1)->listDepartmentsLang();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHODS BRANCH SCHEDULE
     *
     * @return VOID
     *
     */
    public function testBranchSchedule(): void
    {

        $this->justin->setSandbox(false);

        $data = $this->justin
            ->name('Depart')
            ->equal('1a4df005-5d8d-11e8-80be-525400fb7782')
            ->branchSchedule();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

        $this->justin->setSandbox(true);

    }
    /**
     *
     * TEST METHOD GET NEARTDEPARTMENT
     *
     * @return VOID
     *
     */
    public function testGetNeartDepartment()
    {

        $data = $this->justin->getNeartDepartment('Київ,Шевченка,30');

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            (bool) $data->getRaw()['status']

        );

    }
    /**
     *
     * TEST METHOD LIST STATUSES
     *
     * @return VOID
     *
     */
    public function testListStatuses(): void
    {

        $data = $this->justin->listStatuses();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD KEY SELLER
     *
     * @return VOID
     *
     */
    public function testKeySeller(): void
    {

        $data = $this->justin->name('login')->equal($this->login)->keySeller();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD CURRENT STATUS
     *
     * @return VOID
     *
     */
    public function testCurrentStatus(): void
    {

        $data = $this->justin->currentStatus('201971185');

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            (bool) $data->getRaw()['status']

        );

    }
    /**
     *
     * TEST METHOD TRACKING HISTORY
     *
     * @return VOID
     *
     */
    public function testTrackingHistory(): void
    {

        $data = $this->justin->trackingHistory('201971185');

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            (bool) $data->getRaw()['status']

        );

    }
    /**
     *
     * TEST METHOD GET STATUS HISTORY
     *
     * @return VOID
     *
     */
    public function testGetStatusHistory()
    {

        $data = $this->justin->name('orderNumber')->equal('000000004')->getStatusHistory();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOS GET STATUS HISTORYF
     *
     * @return VOID
     *
     */
    public function testGetStatusHistoryF(): void
    {

        $data = $this->justin
            ->name('orderNumber')
            ->equal('000000004')
            ->getStatusHistory();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            $data->getRaw()['response']['status']

        );

    }
    /**
     *
     * TEST METHOD CREATE ORDER
     *
     * @return VOID
     *
     */
    public function testCreateOrder(): void
    {

        $newOrder = $this->justin
            ->setNumber(rand())
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

        $this->assertInstanceOf(

            Data::class,

            $newOrder

        );

        $this->assertIsArray($newOrder->getRaw());

        $this->assertEquals('success', $newOrder->getRaw()['result']);

    }
    /**
     *
     * TEST METHOD LIST ORDERS
     *
     * @return VOID
     *
     */
    public function testListOrders(): void
    {

        $this->justin->setSandbox(false);

        $data = $this->justin->listOrders(

            $this->period

        );

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            (bool) count(

                $data->getRaw()

            )

        );

        $this->justin->setSandbox(true);

    }
    /**
     *
     * TEST METHOD ORDER INFO
     *
     * @return VOID
     *
     */
    public function testOrderInfo(): void
    {

        $this->justin->setSandbox(false);

        $data = $this->justin->orderInfo(

            $this->number

        );

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertIsArray($data->getRaw());

        $this->assertTrue(

            (bool) count(

                $data->getRaw()

            )

        );

        $this->justin->setSandbox(true);

    }
    /**
     *
     * TEST METHOD CREATE STICKER
     *
     * @return VOID
     *
     */
    public function testCreateSticker(): void
    {

        $pdf = 'file.pdf';

        $this->justin->setKey('e315ffa3-94bd-11e8-80c1-525400fb7782');

        $this->assertTrue(

            $this->justin->createSticker(

                '877893', false, $pdf

            )

        );

        unlink($pdf);

    }

}
