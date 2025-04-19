<?php

namespace App\models;

use PDO;

class NewsModel
{
  private $db;
  public function __construct($db)
  {
      $this->db = $db;
  }

//  Получение конкретной новости по id
  public function getNewsId(int $id):array {
        $sql = "SELECT * FROM `news` WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result!== false ? $result : [];
  }

// Получение последней(свежей) новости
  public function getLastNews():array {
      $sql = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT 1";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
  }

// Получение суммарного количества новостей
  public function getAllCountNews():int {
      $sql = "SELECT COUNT(*) FROM `news`";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return  $stmt->fetchColumn();
  }

// Постраничный вывод новостей(пагинация) + сортировка по дате
  public function getNewsList(int $page = 1, int $limit = 4):array {
      $offset = ($page -1) * $limit;
      $sql = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT $offset, $limit";
      $stmt = $this->db->prepare($sql);
      $stmt->execute();
      return $stmt->fetchALL(PDO::FETCH_ASSOC);
  }

}