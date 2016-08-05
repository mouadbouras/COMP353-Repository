<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property int $crsmgrid
 * @property int $permission_level
 *
 * @property \App\Model\Entity\File[] $files
 * @property \App\Model\Entity\Student[] $students
 */
class User extends Entity
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

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password)
    {
        return (new DefaultPasswordHasher)->hash($password);
    }

    public function isStudent($sectionid = null){
        if($sectionid){
            $studentsTable = TableRegistry::get('Students');
            return $studentsTable->exists(['user_id' => $this->id, 'section_id' => $sectionid]);
        }
        return ($this->permission_level == 1 || $this->permission_level == 2);
    }
    public function isTA($sectionid = null){
        if($sectionid){
            $sectionsTable = TableRegistry::get('sections');
            return $sectionsTable->exists(['ta_user_id' => $this->id, 'id' => $sectionid]);
        }
        return ($this->permission_level == 3);
    }
    public function isInstructor($sectionid = null){
        if($sectionid){
            $sectionsTable = TableRegistry::get('sections');
            return $sectionsTable->exists(['instructor_user_id' => $this->id, 'id' => $sectionid]);
        }
        return ($this->permission_level == 3);
    }
    public function isAdmin(){
        return ($this->permission_level == 4);
    }
    
    public function getGroup($sectionid){
        $studentsTable = TableRegistry::get('Students');
        $students = $studentsTable->find('all', ['contain' => ['Teams']])
            ->where(['user_id' => $this->id, 'Students.section_id' => $sectionid]);
        if($student = $students->first()){
            return $student->team;
        }
    }
}
