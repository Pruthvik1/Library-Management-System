<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property int $category_id
 * @property string $book_img
 * @property string $title
 * @property string|null $slug
 * @property string $summary
 * @property string $isbn_no
 * @property string $auther
 * @property int $total_qty
 * @property int $available_qty
 * @property \Cake\I18n\FrozenTime $created_at
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\Record[] $records
 */
class Book extends Entity
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
        'category_id' => true,
        'book_img' => true,
        'title' => true,
        'slug' => true,
        'summary' => true,
        'isbn_no' => true,
        'auther' => true,
        'total_qty' => true,
        'available_qty' => true,
        'created_at' => true,
        'category' => true,
        'records' => true,
    ];
}
