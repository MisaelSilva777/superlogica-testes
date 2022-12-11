<?php

namespace Wine\tests\Unit\Integration;

use PHPUnit\Framework\TestCase;
use Wine\database\Crud\CreateController;

require_once __DIR__ . '/../../../vendor/autoload.php';

class OrderTest extends TestCase {

    /**
     * Method to test route of create order - store
     *
     * @return void
     */
    public function testCreateOrder(){

        $postRequest = [
            'wines_id'       => '1,3,7',
            'wines_quantity' => '1,2,2',
            'order_distance' => 20,
        ];

        $call = CallAPI( 'POST', 'http://localhost/index.php/api/order', $postRequest );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }

    /**
     * Method to test route of get all orders - index
     *
     * @return void
     */
    public function testGetAllOrders(){

        $call = CallAPI( 'GET', 'http://localhost/index.php/api/orders' );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }

    /**
     * Method to test route of get all orders - index
     *
     * @return void
     */
    public function testGetOrderById(){

        $call = CallAPI( 'GET', 'http://localhost/index.php/api/order/1' );

        $call = json_decode($call, true);

        $call_status = $call['status'] ?? null;

        $this->assertEquals(200, $call_status );

    }


}