<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EquipeProfissional Entity
 *
 * @property int $id
 * @property int $id_equipe
 * @property int $id_profissional
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenTime $data_criacao
 * @property \Cake\I18n\FrozenTime|null $data_inicio
 * @property \Cake\I18n\FrozenTime|null $data_fim
 * @property bool $ativo
 */
class EquipeProfissional extends Entity
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
        'id_equipe' => true,
        'id_profissional' => true,
        'descricao' => true,
        'data_criacao' => true,
        'data_inicio' => true,
        'data_fim' => true,
        'ativo' => true,
    ];
}
