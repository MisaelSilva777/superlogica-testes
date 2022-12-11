<?php

namespace Wine\tests\Unit\Database\CrudController;

use PHPUnit\Framework\TestCase;
use Wine\database\Crud\ReadController;

class ReadTest extends TestCase {

    /**
     * Method to test read of crud controller
     *
     * @return void
     */
    public function testRead(){

        $read = new ReadController();
        $read->exeRead('wines', 'WHERE id = :id', 'id=1');

        $this->assertIsArray( $read->getResult() );

    }

}