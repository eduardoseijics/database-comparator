<?php

namespace App\Session\Admin;

use App\Models\Entities\User;

/**
 * Gerenciar login de usuário pela sessão de admin
 */
class Login {
  /**
   * Criar login do usuário
   *
   * @param  User $user
   * @return boolean
   */
  public static function login($user) {
    self::init();

    $_SESSION['user'] = [
      'id'    => $user->getId(),
      'name'  => $user->getNome(),
      'email' => $user->getEmail(),
      'tipo'  => $user->getTipo()
    ];

    return true;
  }


  /**
   * Inicia a sessão
   *
   * @return void
   */
  private static function init() {
    // Verificar se a sessão está ativa
    if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  /**
   * Verifica se o usuário está logado no sistema
   *
   * @return boolean
   */
  public static function isLogged() {
    self::init();

    return isset($_SESSION['user']['id']);
  }

  /**
   * Executar logout do usuário
   *
   * @return boolean
   */
  public static function logout() {
    self::init();

    // Destrói todos os dados da sessão atual
    session_destroy();

    return true;
  }
}