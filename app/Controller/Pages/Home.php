<?php

namespace App\Controller\Pages;

use App\Core\View;

class Home extends Page {

  public static function getHome() : string
  {
    
    $content = View::render('pages/home', [
      'form' => self::getForm()
    ]);
    return parent::getPage($content);
  }

  public static function getForm() : string
  {

    $content = self::getCard(1, 'Database A');
    $content .= self::getCard(2, 'Database B');
    
    return View::render('pages/components/form', [
      'cards' => $content
    ]);
  }
  
  public static function getCard($cardId = 1, string $cardTitle = 'Database A') : string
  {
    return View::render('pages/components/form-card', [
      'cardId'    => $cardId,
      'cardTitle' => $cardTitle
    ]);
  }
}