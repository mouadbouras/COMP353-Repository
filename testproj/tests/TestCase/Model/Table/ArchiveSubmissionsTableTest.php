<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArchiveSubmissionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArchiveSubmissionsTable Test Case
 */
class ArchiveSubmissionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ArchiveSubmissionsTable
     */
    public $ArchiveSubmissions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.archive_submissions',
        'app.assignments',
        'app.sections',
        'app.courses',
        'app.semesters',
        'app.users',
        'app.files',
        'app.submissions',
        'app.teams',
        'app.students'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ArchiveSubmissions') ? [] : ['className' => 'App\Model\Table\ArchiveSubmissionsTable'];
        $this->ArchiveSubmissions = TableRegistry::get('ArchiveSubmissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ArchiveSubmissions);

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
