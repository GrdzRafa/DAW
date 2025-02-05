<?php
// header('Access-Control-Allow-Origin: *');
$q = json_decode(file_get_contents('php://input'), true);
  if ($q){
    $data = [];
    // Genera la query
    $query = "SELECT * FROM productes WHERE (";
    foreach ($q as $k=>$v) {
       foreach ($v as $i=>$j){
        if ($i<count($v)-1){
          $query .= " ".$k."= ? or ";
        }else {
          $query .= " ".$k."= ?)";
        }
        $data[]=$j;
      }
        $query .= " and (";
    }
    $sql = substr($query, 0, -6);
  }else {
    $sql = "SELECT * FROM productes";
  }
  
  try {
    $dbh = new PDO('mysql:host=10.0.50.20;dbname=cataleg;charset=utf8','dbadmin', 'Thos-2024');
    $sth = $dbh->prepare($sql);
    $sth->execute($data);
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
  }
  $res = json_encode($result);
  echo $res;
