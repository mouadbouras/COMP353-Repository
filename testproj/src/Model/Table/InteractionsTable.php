<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Interactions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Teams
 * @property \Cake\ORM\Association\BelongsTo $Files
 *
 * @method \App\Model\Entity\Interaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Interaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Interaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Interaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Interaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Interaction findOrCreate($search, callable $callback = null)
 */
class InteractionsTable extends Table
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

        $this->table('interactions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id'
        ]);
        $this->belongsTo('Files', [
            'foreignKey' => 'file_id'
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
            ->integer('action_code')
            ->requirePresence('action_code', 'create')
            ->notEmpty('action_code');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['team_id'], 'Teams'));
        $rules->add($rules->existsIn(['file_id'], 'Files'));

        return $rules;
    }
}
