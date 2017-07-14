<?php

    class Stylist

    {
        private $stylist_name;
        private $id;

        function __construct($stylist_name, $id = null)
        {
            $this->stylist_name = $stylist_name;
            $this->id = $id;
        }

        function setStylistName($new_stylist_name)
        {
            $this->stylist_name = (string) $new_stylist_name;
        }

        function getStylistName()
        {
            return $this->stylist_name;
        }

        // function setId()
        // {
        //     $this->id = intval($id);
        // }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $executed = $GLOBALS['DB']->exec("INSERT INTO stylists (name) VALUES ('{$this->getStylistName()}')");
            if ($executed) {
                 $this->id= $GLOBALS['DB']->lastInsertId();
                 return true;
            } else {
                 return false;
            }
        }

        static function getAll()
          {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $stylist_name = $stylist['name'];
                $id = $stylist['id'];
                var_dump($id);
                $new_stylist = new Stylist($stylist, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
          }

        static function find($search_id)
           {
               $found_stylist = null;
               $returned_stylists = $GLOBALS['DB']->prepare("SELECT * FROM stylists WHERE id = :id");
               $returned_stylists->bindParam(':id', $search_id, PDO::PARAM_STR);
               $returned_stylists->execute();
               foreach($returned_stylists as $stylist) {
                   $stylist_name = $stylist['name'];
                   $stylist_id = $stylist['id'];
                   if ($stylist_id == $search_id) {
                     $found_stylist = new Stylist($stylist_name, $stylist_id);
                   }
               }
               return $found_stylist;
           }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists;");
        }
    }


 ?>
