<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ArchiveFiles Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\ArchiveFile get($primaryKey, $options = [])
 * @method \App\Model\Entity\ArchiveFile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ArchiveFile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ArchiveFile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ArchiveFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ArchiveFile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ArchiveFile findOrCreate($search, callable $callback = null)
 */
class ArchiveFilesTable extends Table
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

        $this->table('archive_files');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
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
            ->integer('size_bytes')
            ->requirePresence('size_bytes', 'create')
            ->notEmpty('size_bytes');

        $validator
            ->requirePresence('checksum', 'create')
            ->notEmpty('checksum');

        $validator
            ->dateTime('upload_date')
            ->requirePresence('upload_date', 'create')
            ->notEmpty('upload_date');

        $validator
            ->requirePresence('ip_address', 'create')
            ->notEmpty('ip_address');

        $validator
            ->integer('version_number')
            ->requirePresence('version_number', 'create')
            ->notEmpty('version_number');

        $validator
            ->requirePresence('file_name', 'create')
            ->notEmpty('file_name');

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

        return $rules;
    }
}
