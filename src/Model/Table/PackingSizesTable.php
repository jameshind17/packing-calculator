<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\Collection\CollectionInterface;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PackingSizes Model
 *
 * @method \App\Model\Entity\PackingSize newEmptyEntity()
 * @method \App\Model\Entity\PackingSize newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\PackingSize[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PackingSize get($primaryKey, $options = [])
 * @method \App\Model\Entity\PackingSize findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\PackingSize patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PackingSize[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PackingSize|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackingSize saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PackingSize[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackingSize[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackingSize[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\PackingSize[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class PackingSizesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('packing_sizes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->allowEmptyString('id', null, 'create');

        $validator
            ->nonNegativeInteger('pack_size')
            ->requirePresence('pack_size', 'create')
            ->notEmptyString('pack_size');

        return $validator;
    }

    public function findBelowSizes(Query $query, array $options) {
        return $query
            ->where(function(QueryExpression $exp, Query $q) use ($options) {
                return $exp->lt('pack_size', $options['qty']);
            })
            ->order(['pack_size' => 'DESC']);
    }

    public function findAboveSizes(Query $query, array $options) {
        return $query
            ->where(function(QueryExpression $exp, Query $q) use ($options) {
                return $exp->gte('pack_size', $options['qty']);
            })
            ->order('pack_size');
    }
}
