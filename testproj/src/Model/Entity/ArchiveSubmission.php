<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArchiveSubmission Entity
 *
 * @property int $id
 * @property int $assignment_id
 * @property int $team_id
 * @property int $file_id
 * @property bool $is_deleted
 * @property \Cake\I18n\Time $deletion_date
 * @property bool $is_active
 *
 * @property \App\Model\Entity\Assignment $assignment
 * @property \App\Model\Entity\Team $team
 * @property \App\Model\Entity\File $file
 */
class ArchiveSubmission extends Entity
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
        '*' => true
    ];
}
