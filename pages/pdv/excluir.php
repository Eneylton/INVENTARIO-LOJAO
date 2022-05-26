<?php

require __DIR__ . '../../../vendor/autoload.php';
session_start(); 

if (isset($_GET['excluir'])) {

  if ($_GET['excluir'] == 'del') {

    $id = intval($_GET['id']);

    if (isset($_SESSION['carrinho'][$id])) {
      unset($_SESSION['carrinho'][$id]);
    }

    header('location: pdv.php?');

    exit;
  }
}