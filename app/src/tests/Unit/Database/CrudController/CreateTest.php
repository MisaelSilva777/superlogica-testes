<?php

namespace Wine\tests\Unit\Database\CrudController;

use PHPUnit\Framework\TestCase;
use Wine\database\Crud\CreateController;

class CreateTest extends TestCase {

    /**
     * Method to test create of crud controller
     *
     * @return void
     */
    public function testCreate(){

        $create = new CreateController();

        $wine_data = [
            'name'   => 'wine a',
            'type'   => 1,
            'weight' => 1.200,
            'price'  => 17.45
        ];

        $create->exeCreate( 'wines', $wine_data );

        $this->assertIsInt( $create->getResult() );

    }

}