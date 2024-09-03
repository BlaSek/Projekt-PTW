<?php
$conn = new mysqli("localhost", "root", "", "projektydb");
if ($conn->connect_error) {
    exit("Connection failed: " . $conn->connect_error);
}

