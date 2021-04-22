<?php
    class Product extends DataMapper{
        var $table = 'products';

        var $validation = array(
            "name" => array(
                "label" => "Name",
                "rules" => array("required", "trim"),
            ),
            "description" => array(
                "label" => "Description",
                "rules" => array("required", "trim"),
            ),
            "price" => array(
                "label" => "Price",
                "rules" => array("required", "numeric"),
            )
        );
    }
?>