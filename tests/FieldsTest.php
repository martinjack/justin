<?php
declare (strict_types = 1);

namespace Justin\Tests;

use Justin\Data;
use Justin\Justin;
use PHPUnit\Framework\TestCase;

/**
 *
 * Class FieldsTest
 *
 * @package Justin\Tests
 *
 */
final class FieldsTest extends TestCase
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
     * INIT JUSTIN CLASS
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

        $this->justin = new Justin('UA', false);

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
     * TEST FIELD CODE IN METHOD LIST DEPARTMENTS
     *
     * @return VOID
     *
     */
    public function testFieldCodeListDepartments(): void
    {

        $this->assertNotEmpty(

            $this->justin->limit(1)->listDepartments()->fields()->getCode()

        );

    }
    /**
     *
     * TEST FIELD KNOT IN METHOD LIST DEPARTMENTS
     *
     * @return VOID
     *
     */
    public function testFieldKnotListDepartments(): void
    {

        $data = $this->justin->limit(1)->listDepartments()->fields()->knot();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertNotEmpty(

            $data->getUUID()

        );

        $this->assertNotEmpty(

            $data->type()

        );

    }
    /**
     *
     * TEST FIELD ADDRESS IN METHOD LIST DEPARTMENTS
     *
     * @return VOID
     *
     */
    public function testFieldAddressListDepartments(): void
    {

        $this->assertNotEmpty(

            $this->justin->limit(1)->listDepartments()->fields()->getAddress()

        );

    }
    /**
     *
     * TEST FIELD ORDERNUMBER IN METHOD CURRENT STATUS
     *
     * @return VOID
     *
     */
    public function testFieldsOrderNumberCurrentStatus(): void
    {

        $this->assertNotEmpty(

            $this->justin->currentStatus('201971185')->fields()->orderNumber()

        );

    }
    /**
     *
     * TEST FIELD ORDERDESCRIPTION IN METHOD CURRENT STATUS
     *
     * @return VOID
     *
     */
    public function testFieldOrderDescriptionCurrentStatus(): void
    {

        $this->assertNotEmpty(

            $this->justin->currentStatus('201971185')->fields()->orderDescr()

        );

    }
    /**
     *
     * TEST FIELD SHORTNAME IN METHOD BRANCH TYPES
     *
     * @return VOID
     *
     */
    public function testFieldsShortNameBranchTypes(): void
    {

        $this->justin->setSandbox(false);

        $this->assertNotEmpty(

            $this->justin->limit(1)->branchTypes()->fields()->shortName()

        );

        $this->justin->setSandbox(true);

    }
    /**
     *
     * TEST FIELD DEPART IN METHOD BRANCH SCHUDULE
     *
     * @return VOID
     *
     */
    public function testFieldDepartBranchSchedule(): void
    {

        $this->justin->setSandbox(false);

        $data = $this->justin->limit(1)->name('Depart')->equal('1a4df005-5d8d-11e8-80be-525400fb7782')->branchSchedule()->fields();

        $this->assertInstanceOf(

            Data::class,

            $data

        );

        $this->assertNotEmpty(

            $data->data()

        );

        $this->assertNotEmpty(

            $data->startWork()

        );

        $this->justin->setSandbox(true);

    }
    /**
     *
     * TEST FIELD DESCR IN METHOD LIST STREETS CITY
     *
     * @return VOID
     *
     */
    public function testFieldDescrListStreetsCity(): void
    {

        $this->assertNotEmpty(

            $this->justin->limit(1)->name('objectOwner')->equal('32b69b95-9018-11e8-80c1-525400fb7782')->listStreetsCity()->fields()->getDescr()

        );

    }

}
