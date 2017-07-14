<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);




    class StylistTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Stylist::deleteAll();
        //     Client::deleteAll();
        // }

        function testSave()
        {
            //
            $stylist_name = "Bob";
            $test_stylist = new Stylist($stylist_name);

            //
            $executed = $test_stylist->save();

            //
            $this->assertTrue($executed, "Stylist not saved to database");
        }

        function testGetStylistName()
        {
            //
            $stylist_name = "Bob";
            $test_stylist = new Stylist($stylist_name);

            //
            $result = $test_stylist->getStylistName();

            //
            $this->assertEquals($stylist_name, $result);
        }

        function testSetStylistName()
        {
            //
            $stylist_name = "Bob";
            $test_stylist = new Stylist($stylist_name);

            //
            $test_stylist->setStylistName("Bill");
            $result = $test_stylist->getStylistName();

            //
            $this->assertEquals("Bill", $result);
        }

        function testGetStylistId()
        {
            //
            $stylist_id = "Bob";
            $test_stylist = new Stylist($stylist_id);
            $test_stylist->save();
            //
            $result = $test_stylist->getId();

            //
            $this->assertEquals(true, is_numeric($result));
        }

        // function testGetAll()
        // {
        //     //
        //     $stylist_name = "Bob";
        //     $stylist_name2 = "Bill";
        //     $test_stylist = new Stylist($stylist_name);
        //     $test_stylist->save();
        //     $test_stylist2 = new Stylist($stylist_name2);
        //     $test_stylist2->save();
        //
        //     //
        //     $result = $Stylist::getAll();
        //
        //     //
        //     $this->assertEquals([$test_stylist, $test_stylist2], $result);
        // }
    }
?>
