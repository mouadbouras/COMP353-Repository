<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArchiveFile Entity
 *
 * @property int $id
 * @property string $name
 * @property int $size_bytes
 * @property string $checksum
 * @property \Cake\I18n\Time $upload_date
 * @property int $user_id
 * @property string $ip_address
 * @property int $version_number
 * @property string $file_name
 *
 * @property \App\Model\Entity\User $user
 */
class ArchiveFile extends Entity
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
