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

        protected function tearDown()
        {
            Task::deleteAll();
            Category::deleteAll();
        }

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
            $result = $test_stylist->getStylistName;

            //
            $this->assertEqual($stylist_name, $result);
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
            $this->assertEqual("Bill", $result);
        }

        function testGetStylistId()
        {
            //
            $stylist_id = "Bob";
            $test_stylist = new Stylist($stylist_id);

            //
            $result = $test_stylist->getId();

            //
            $this->assertEqual(true, is_numeric($result));
        }
    }
?>
