<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InteractionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InteractionsTable Test Case
 */
class InteractionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InteractionsTable
     */
    public $Interactions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.interactions',
        'app.users',
        'app.files',
        'app.submissions',
        'app.assignments',
        'app.sections',
        'app.courses',
        'app.semesters',
        'app.students',
        'app.teams'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Interactions') ? [] : ['className' => 'App\Model\Table\InteractionsTable'];
        $this->Interactions = TableRegistry::get('Interactions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Interactions);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
