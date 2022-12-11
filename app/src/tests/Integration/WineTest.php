<?php

namespace Wine\tests\Unit\Integration;

use PHPUnit\Framework\TestCase;
use Wine\database\Crud\CreateController;

require_once __DIR__ . '/../../../vendor/autoload.php';

class WineTest extends TestCase {

    /**
     * Method to test route of create wine - store
     *
     * @return void
     */
    public function testCreateWine(){

        $postRequest = [
            'name'   => 'wine test',
            'type'   => 'type wine test',
            'weight' => 0.7,
            'price' => 17.5,
        ];

        $call = CallAPI( 'POST', 'http://localhost/index.php/api/wine', $postRequest );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }

    /**
     * Method to test route of get all wines - index
     *
     * @return void
     */
    public function testAllWines(){

        $call = CallAPI( 'GET', 'http://localhost/index.php/api/wines' );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }

    /**
     * Method to test route of get wine by id - show
     *
     * @return void
     */
    public function testWineById(){

        $call = CallAPI( 'GET', 'http://localhost/index.php/wine/1' );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }

    /**
     * Method to test update wine by id - update
     *
     * @return void
     */
    public function testUpdateWine(){

        $postRequest = [
            'type'   => 'updated',
        ];

        $call = CallAPI( 'PUT', 'http://localhost/index.php/wine/1', $postRequest );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }

    /**
     * Method to test route of destroy wine by id - destroy
     *
     * @return void
     */
    public function testRemoveWine(){

        $call = CallAPI( 'DELETE', 'http://localhost/index.php/wine/1' );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }

}