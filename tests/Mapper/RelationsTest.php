<?php
namespace Atlas\Mapper;

use Atlas\Exception;
use Atlas\DataSource\Employee\EmployeeMapper;
use Atlas\DataSource\Employee\EmployeeRecord;
use Atlas\DataSource\Employee\EmployeeRecordSet;
use Atlas\DataSource\Employee\EmployeeRow;
use Atlas\Relation\HasManyThrough;

class MapperRelationsTest extends \PHPUnit_Framework_TestCase
{
    protected $mapperLocator;
    protected $relations;

    protected function setUp()
    {
        $mapperLocator = new MapperLocator();
        $mapperLocator->set(EmployeeMapper::CLASS, function () {
            return EmployeeMapper::CLASS;
        });

        $this->relations = new FakeRelations($mapperLocator);
    }

    public function testSet_hasManyThrough_noThroughName()
    {
        $this->setExpectedException(
            Exception::CLASS,
            "Relation 'foo' does not exist"
        );

        $this->relations->set(
            'bar',
            HasManyThrough::CLASS,
            EmployeeMapper::CLASS,
            'foo'
        );
    }

    public function testSet_noForeignMapper()
    {
        $this->setExpectedException(
            Exception::CLASS,
            "NoSuchMapper does not exist"
        );

        $this->relations->set(
            'bar',
            HasOne::CLASS,
            NoSuchMapper::CLASS
        );
    }
}
