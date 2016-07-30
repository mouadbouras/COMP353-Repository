<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\I18n\Time;

/**
 * Semesters Model
 *
 * @property \Cake\ORM\Association\HasMany $Sections
 *
 * @method \App\Model\Entity\Semester get($primaryKey, $options = [])
 * @method \App\Model\Entity\Semester newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Semester[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Semester|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Semester patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Semester[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Semester findOrCreate($search, callable $callback = null)
 */
class SemestersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('semesters');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('Sections', [
            'foreignKey' => 'semester_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        return $validator;
    }

    function selectCurrentSemesters(\Cake\ORM\Query $query){
        $now = Time::now()->toDateString();
        return $query->select()
            ->where(['Semesters.start_date <=' => $now, 
             'Semesters.end_date >=' => $now]);
    }
}
