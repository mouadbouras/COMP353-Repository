<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Team Entity
 *
 * @property int $id
 * @property int $leader_user_id
 * @property int $section_id
 * @property int $size_limit
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Section $section
 * @property \App\Model\Entity\Student[] $students
 * @property \App\Model\Entity\Submission[] $submissions
 */
class Team extends Entity
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

    protected function _setSizeLimit($value){
        return $value==null?'10485760':$value;
    }

    protected function _getSizeLimit($value){
        return $value==null?'10485760':$value;
    }
}
