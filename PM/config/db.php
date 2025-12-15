<?php
$conn = new mysqli("localhost", "root", "", "ghibli_booking");
if ($conn->connect_error) {
    die("Database connection failed");
}
session_start();
