<?php

$link = mysqli_connect('localhost', 'root', '');

$sql = "CREATE DATABASE IF NOT EXISTS `digi`";
mysqli_query($link, $sql);

$link = mysqli_connect('localhost', 'root', '', 'digi');

$sql = "CREATE TABLE  IF NOT EXISTS `digi`.`products` (`id` INT NOT NULL , `title` VARCHAR(255) NOT NULL , `price` INT NOT NULL , `brand` VARCHAR(255) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
mysqli_query($link, $sql);