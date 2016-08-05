<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SectionsFixture
 *
 */
class SectionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'course_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'semester_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ta_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'instructor_user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_sections_course_id' => ['type' => 'index', 'columns' => ['course_id'], 'length' => []],
            'fk_sections_semester_id' => ['type' => 'index', 'columns' => ['semester_id'], 'length' => []],
            'fk_sections_user_id' => ['type' => 'index', 'columns' => ['ta_user_id'], 'length' => []],
            'instructor_user_id' => ['type' => 'index', 'columns' => ['instructor_user_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_sections_course_id' => ['type' => 'foreign', 'columns' => ['course_id'], 'references' => ['courses', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_sections_semester_id' => ['type' => 'foreign', 'columns' => ['semester_id'], 'references' => ['semesters', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fk_sections_user_id' => ['type' => 'foreign', 'columns' => ['ta_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'sections_ibfk_1' => ['type' => 'foreign', 'columns' => ['instructor_user_id'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'course_id' => 1,
            'semester_id' => 1,
            'ta_user_id' => 1,
            'instructor_user_id' => 1
        ],
    ];
}
