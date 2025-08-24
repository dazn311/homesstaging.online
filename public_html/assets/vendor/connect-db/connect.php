<?php
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  // $conn = new mysqli('locahost','root','a1exandr','homestage','3306');
  $conn = new mysqli('localhost','root', '', 'homestage', '3306');
  $conn->set_charset('utf8mb4');


