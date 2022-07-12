<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RecordsFixture
 */
class RecordsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'book_name' => 'Lorem ipsum dolor sit amet',
                'book_id' => 1,
                'user_id' => 1,
                'borrow_date' => '2022-07-02 04:47:59',
                'return_date' => '2022-07-02 04:47:59',
                'is_returned' => 'Lorem ip',
            ],
        ];
        parent::init();
    }
}
