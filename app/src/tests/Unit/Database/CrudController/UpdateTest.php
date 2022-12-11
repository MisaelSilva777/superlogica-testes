<?php

namespace Wine\tests\Unit\Database\CrudController;

use PHPUnit\Framework\TestCase;
use Wine\database\Crud\UpdateController;

class UpdateTest extends TestCase {

    /**
     * Method to test update of crud controller
     *
     * @return void
     */
    public function testUpdate(){

        $wine_data = [
            'price'  => 20.45
        ];

        $update = new UpdateController();
        $update->exeUpdate('wines', $wine_data, 'id = :id', 'id=1');

        $this->assertTrue( $update->getResult() );

    }

}