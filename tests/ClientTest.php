<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";
    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);




    class ClientTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Stylist::deleteAll();
        //     Client::deleteAll();
        // }

        function testSave()
        {
            //
            $client_name = "Sue";
            $test_client = new Client($client_name);

            //
            $executed = $test_client->save();

            //
            $this->assertTrue($executed, "Client not saved to database");
        }

        function testGetClientName()
        {
            //
            $client_name = "Sue";
            $test_client = new Client($client_name);

            //
            $result = $test_client->getClientName();

            //
            $this->assertEquals($client_name, $result);
        }

        function testGetId()
        {
            //
            $client_name = "Sue";
            $test_client = new Client($client_name);
            $test_client->save();

            //
            $result = $test_client->getId();

            //
            $this->assertEquals(true, is_numeric($result));
        }

        function testGetAll()
      {
          //Arrange
          $client = "Sue";
          $client_2 = "Jane";
          $test_client = new Client($client);
          $test_client->save();
          $test_client_2 = new Client($client_2);
          $test_client_2->save();

          //Act
          $result = Client::getAll();

          //Assert
          $this->assertEquals([$test_client, $test_client_2], $result);
      }

        function testDeleteAll()
        {
            //Arrange
            $client_name = "Sue";
            $client_name_2 = "Jane";
            $test_client = new Client($client_name);
            $test_client->save();
            $test_client_2 = new Client($client_name_2);
            $test_client_2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

    }
?>
