<?php
session_start();
class Vol
{
  public $idVol;
  public $depart;
  public $destination;
  public $date_depart;
  public $time;
  public $prix;
  public $place_disponible;
  public $status;



  //--------show Function-------------
  public function show($Table_Name)
  {
    global $db;
    $array = array();
    $query = "SELECT * FROM " . $Table_Name . "";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {

      $array[] = $row;
    }
    return $array;
  }

  // --------Insert Function----------
  function vol_insert($depart, $destination, $date_depart, $time, $prix, $place_disponible, $status)
  {
    global $db;
    $query = mysqli_query($db, "INSERT INTO vols values ('', '$depart', '$destination', '$date_depart', '$time', '$prix', '$place_disponible', $status)");

    if ($query == true) {
      return true;
    } else {
      return false;
    }
  }

  // --------Update Function----------
  function vol_update($id1, $depart, $destination, $date_depart, $time, $prix, $place_disponible, $status)
  {
    global $db;
    $query = mysqli_query($db, "UPDATE vols set depart = '$depart', 
            destination = '$destination', 
            date_depart = '$date_depart', 
            time = '$time', 
            prix = '$prix', 
            place_disponible = '$place_disponible', 
            status = '$status' 
            where idVol = '$id1'");
  }

  // --------Delete Function----------
  //    function user_delete($id) {
  //    mysqli_query($this->conn,"DELETE from users where iduser = '$id'");



}
