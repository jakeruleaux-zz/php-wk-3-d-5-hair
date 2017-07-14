<?php

    class Stylist

    {
        private $stylist_name;
        private $stylist_id;

        function __construct($stylist_name, $stylist_id = null)
        {
            $this->stylist_name = $stylist_name;
            $this->stylist_id = $stylist_id;
        }

        function setStylistName($new_stylist_name)
        {
            $this->stylist_name = (string) $new_stylist_name;
        }

        function getStylistName()
        {
            return $this->stylist_name;
        }

        function setStylistId()
        {
            $this->stylist_id = intval($stylist_id);
        }

        function getStylistId()
        {
            return $this->stylist_id;
        }
    }


 ?>
