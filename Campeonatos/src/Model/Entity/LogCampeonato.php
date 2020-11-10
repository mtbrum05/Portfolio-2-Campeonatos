<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LogCampeonato Entity
 *
 * @property int $id
 * @property int $id_campeonato
 * @property \Cake\I18n\FrozenTime $data_criacao
 * @property bool $ativo
 * @property \Cake\I18n\FrozenTime|null $data_inativacao
 * @property string|null $observacao
 * @property int $id_equipe_profissional
 */
class LogCampeonato extends Entity
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
        'id_campeonato' => true,
        'data_criacao' => true,
        'ativo' => true,
        'data_inativacao' => true,
        'observacao' => true,
        'id_equipe_profissional' => true,
    ];
}
