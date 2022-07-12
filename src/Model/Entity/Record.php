<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Record Entity
 *
 * @property int $id
 * @property string $book_name
 * @property int $book_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $borrow_date
 * @property \Cake\I18n\FrozenTime $return_date
 * @property string $is_returned
 *
 * @property \App\Model\Entity\Book $book
 * @property \App\Model\Entity\User $user
 */
class Record extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'book_name' => true,
        'book_id' => true,
        'user_id' => true,
        'borrow_date' => true,
        'return_date' => true,
        'is_returned' => true,
        'book' => true,
        'user' => true,
    ];
}
