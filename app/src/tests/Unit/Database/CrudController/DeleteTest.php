<?php

namespace Wine\tests\Unit\Database\CrudController;

use PHPUnit\Framework\TestCase;
use Wine\database\Crud\DeleteController;

class DeleteTest extends TestCase {

    /**
     * Method to test delete of crud controller
     *
     * @return void
     */
    public function testDelete(){

        $delete = new DeleteController();
        $delete->exeDelete( 'wines', 'id=:id', 'id=2');

        $this->assertTrue( $delete->getResult() );

    }

}