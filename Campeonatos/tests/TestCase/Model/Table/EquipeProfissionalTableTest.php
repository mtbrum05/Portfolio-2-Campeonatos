<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EquipeProfissionalTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EquipeProfissionalTable Test Case
 */
class EquipeProfissionalTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EquipeProfissionalTable
     */
    public $EquipeProfissional;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EquipeProfissional',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EquipeProfissional') ? [] : ['className' => EquipeProfissionalTable::class];
        $this->EquipeProfissional = TableRegistry::getTableLocator()->get('EquipeProfissional', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EquipeProfissional);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
