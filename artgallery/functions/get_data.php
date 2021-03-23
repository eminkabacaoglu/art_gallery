<?php require_once '../admin/setconfig.php'; 

if(!isset($_POST['searchTerm'])){ 
    $fetchData = $db->qSql("SELECT * FROM arts WHERE art_status = '1' or  art_status='2' order by art_id ASC limit 5");
  }else{ 
    $search = $_POST['searchTerm'];   
    $fetchData = $db->qSql("SELECT * FROM arts WHERE (art_status = '1' or  art_status='2') and art_name like '%".$search."%' order by art_id ASC limit 5");

  } 
  
  $data = array();
  while ($row=$fetchData->fetch(PDO::FETCH_ASSOC)) {    
    $data[] = array("id"=>$row['art_id'], "text"=>$row['art_name']);
  }
  echo json_encode($data);






?>