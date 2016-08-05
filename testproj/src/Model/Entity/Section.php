<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Section Entity
 *
 * @property int $id
 * @property int $course_id
 * @property int $semester_id
 * @property int $ta_user_id
 * @property int $instructor_user_id
 *
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\Semester $semester
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Assignment[] $assignments
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Team[] $teams
 */
class Section extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
