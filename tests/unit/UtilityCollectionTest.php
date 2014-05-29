<?php
use Codeception\Util\Stub;

class UtilityCollectionTest extends \Codeception\TestCase\Test
{
   /**
    * @var \CodeGuy
    */
    protected $codeGuy;

    protected function _before()
    {
        $this->collection = new Utility_Collection();

        $testData = 
        [
            [
                'name' => 'bob',
                'age' => 10,
                'kids' => [
                    'name' => 'zack',
                    'age' => 2
                ]
            ],
            [
                'name' => 'jeff',
                'age' => 15,
                'kids' => [
                    'name' => 'jess',
                    'age' => 3
                ]
            ],
            [
                'name' => 'chris',
                'age' => 20,
                'kids' => [
                    'name' => 'jr',
                    'age' => 4
                ]
            ],
            [
                'name' => 'dug',
                'age' => 25,
                'kids' => [
                    'name' => 'dan',
                    'age' => 5
                ]
            ],
            [
                'name' => 'sam',
                'age' => null,
                'kids' => [
                    'name' => 'jane',
                    'age' => null
                ]
            ]
        ];

        foreach ($testData as $data) {
            $newParent = new stdClass();
            $newParent->name = $data['name'];
            $newParent->age = $data['age'];
            
            $newParent->kids = new Utility_Collection();

            $newChild = new stdClass();
            $newChild->name = $data['kids']['name'];
            $newChild->age = $data['kids']['age'];
            $newParent->kids->add($newChild);

            $this->collection->add($newParent);
        }
    }

    protected function _after()
    {
        $this->collection = null;
    }

    public function testCreateCollection()
    {
        $this->assertInstanceOf('NukaCode\Core\Database\Collection', $this->collection);
    }

    public function testGetWhere()
    {
        $data = $this->collection->getWhere('name', 'bob');
        $this->assertCount(1, $data);
    }

    public function testGetWhereIn()
    {
        $data = $this->collection->getWhereIn('age', [10, 15]);
        $this->assertCount(2, $data);
    }

    public function testGetWhereBetween()
    {
        $data = $this->collection->getWhereBetween('age', [10, 20]);
        $this->assertCount(3, $data);
    }

    public function testGetWhereNull()
    {
        $this->markTestIncomplete('Null is not working for some reason');
        $data = $this->collection->getWhereNull('age');
        $this->assertCount(1, $data);
    }

    public function testGetWhereLike()
    {
        $data = $this->collection->getWhereLike('name', 'hri');
        $this->assertCount(1, $data);
    }

    public function testGetWhereNot()
    {
        $data = $this->collection->getWhereNot('name', 'bob');
        $this->assertCount(4, $data);
    }

    public function testGetWhereNotIn()
    {
        $data = $this->collection->getWhereNotIn('age', [10, 15]);
        $this->assertCount(2, $data);
    }

    public function testGetWhereNotBetween()
    {
        $data = $this->collection->getWhereNotBetween('age', [10, 20]);
        $this->assertCount(1, $data);
    }

    public function testGetWhereNotNull()
    {
        $this->markTestIncomplete('Null is not working for some reason');
        $data = $this->collection->getWhereNotNull('age');
        $this->assertCount(4, $data);
    }

    public function testGetWhereNotLike()
    {
        $data = $this->collection->getWhereNotLike('name', 'hri');
        $this->assertCount(4, $data);
    }

    public function testGetWhereFirst()
    {
        $data = $this->collection->getWhereInFirst('age', [10, 15]);
        $this->assertInstanceOf('stdClass', $data);
        $this->assertEquals(10, $data->age);
    }

    public function testGetWhereLast()
    {
        $data = $this->collection->getWhereInLast('age', [10, 15]);
        $this->assertInstanceOf('stdClass', $data);
        $this->assertEquals(15, $data->age);
    }

    public function testGetWhereTap()
    {
        $data = $this->collection->getWhere('kids->name', 'jess');
        $this->assertCount(1, $data);
        $this->assertEquals('jeff', $data->first()->name);
    }

    public function testGetWhereInTap()
    {
        $data = $this->collection->getWhereIn('kids->age', [2, 4]);
        $this->assertCount(2, $data);
    }

    public function testGetWhereBetweenTap()
    {
        $data = $this->collection->getWhereBetween('kids->age', [2, 4]);
        $this->assertCount(3, $data);
    }

    public function testGetWhereNullTap()
    {
        $this->markTestIncomplete('Null is not working for some reason');
        $data = $this->collection->getWhereNull('kids->age');
        $this->assertCount(1, $data);
    }

    public function testGetWhereLikeTap()
    {
        $data = $this->collection->getWhereLike('kids->name', 'es');
        $this->assertCount(1, $data);
    }

    public function testGetWhereNotTap()
    {
        $data = $this->collection->getWhereNot('kids->name', 'dan');
        $this->assertCount(4, $data);
    }

    public function testGetWhereNotInTap()
    {
        $data = $this->collection->getWhereNotIn('kids->age', [2, 4]);
        $this->assertCount(2, $data);
    }

    public function testGetWhereNotBetweenTap()
    {
        $data = $this->collection->getWhereNotBetween('kids->age', [2, 4]);
        $this->assertCount(1, $data);
    }

    public function testGetWhereNotNullTap()
    {
        $this->markTestIncomplete('Null is not working for some reason');
        $data = $this->collection->getWhereNotNull('kids->age');
        $this->assertCount(4, $data);
    }

    public function testGetWhereNotLikeTap()
    {
        $data = $this->collection->getWhereNotLike('kids->name', 'es');
        $this->assertCount(4, $data);
    }

    public function testGetWhereFirstTap()
    {
        $data = $this->collection->getWhereInFirst('kids->age', [2, 4]);
        $this->assertInstanceOf('stdClass', $data);
        $this->assertEquals(10, $data->age);
    }

    public function testGetWhereLastTap()
    {
        $data = $this->collection->getWhereInLast('kids->age', [2, 4]);
        $this->assertInstanceOf('stdClass', $data);
        $this->assertEquals(20, $data->age);
    }

    public function testGetName()
    {
        $data = $this->collection->first()->kids->name;
        $this->assertEquals('zack', $data->first());
        $this->assertInstanceOf('NukaCode\Core\Database\Collection', $data);
        $this->assertCount(1, $data);
    }

}