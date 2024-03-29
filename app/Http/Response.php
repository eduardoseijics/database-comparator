<?php

namespace App\Http;

class Response {

  const HTTP_CONTINUE                        = 100;
  const HTTP_SWITCHING_PROTOCOLS             = 101;
  const HTTP_PROCESSING                      = 102; // RFC2518
  const HTTP_EARLY_HINTS                     = 103; // RFC8297
  const HTTP_OK                              = 200;
  const HTTP_CREATED                         = 201;
  const HTTP_ACCEPTED                        = 202;
  const HTTP_NON_AUTHORITATIVE_INFORMATION   = 203;
  const HTTP_NO_CONTENT                      = 204;
  const HTTP_RESET_CONTENT                   = 205;
  const HTTP_PARTIAL_CONTENT                 = 206;
  const HTTP_MULTI_STATUS                    = 207; // RFC4918
  const HTTP_ALREADY_REPORTED                = 208; // RFC5842
  const HTTP_IM_USED                         = 226; // RFC3229
  const HTTP_MULTIPLE_CHOICES                = 300;
  const HTTP_MOVED_PERMANENTLY               = 301;
  const HTTP_FOUND                           = 302;
  const HTTP_SEE_OTHER                       = 303;
  const HTTP_NOT_MODIFIED                    = 304;
  const HTTP_USE_PROXY                       = 305;
  const HTTP_RESERVED                        = 306;
  const HTTP_TEMPORARY_REDIRECT              = 307;
  const HTTP_PERMANENTLY_REDIRECT            = 308; // RFC7238
  const HTTP_BAD_REQUEST                     = 400;
  const HTTP_UNAUTHORIZED                    = 401;
  const HTTP_PAYMENT_REQUIRED                = 402;
  const HTTP_FORBIDDEN                       = 403;
  const HTTP_NOT_FOUND                       = 404;
  const HTTP_METHOD_NOT_ALLOWED              = 405;
  const HTTP_NOT_ACCEPTABLE                  = 406;
  const HTTP_PROXY_AUTHENTICATION_REQUIRED   = 407;
  const HTTP_REQUEST_TIMEOUT                 = 408;
  const HTTP_CONFLICT                        = 409;
  const HTTP_GONE                            = 410;
  const HTTP_LENGTH_REQUIRED                 = 411;
  const HTTP_PRECONDITION_FAILED             = 412;
  const HTTP_REQUEST_ENTITY_TOO_LARGE        = 413;
  const HTTP_REQUEST_URI_TOO_LONG            = 414;
  const HTTP_UNSUPPORTED_MEDIA_TYPE          = 415;
  const HTTP_REQUESTED_RANGE_NOT_SATISFIABLE = 416;
  const HTTP_EXPECTATION_FAILED              = 417;
  const HTTP_I_AM_A_TEAPOT                   = 418; // RFC2324
  const HTTP_MISDIRECTED_REQUEST             = 421; // RFC7540
  const HTTP_UNPROCESSABLE_ENTITY            = 422; // RFC4918
  const HTTP_LOCKED                          = 423; // RFC4918
  const HTTP_FAILED_DEPENDENCY               = 424; // RFC4918
  const HTTP_INTERNAL_SERVER_ERROR           = 500;

  /**
   * Código do status HTTP
   * @var integer
   */
  private $httpCode = 200;

  /**
   * Cabeçalhos do response
   * @var array
   */
  private $headers = [];

  /**
   * Tipo do conteudo que está sendo retornado
   * @var string
   */
  private $contentType = 'text/html';

  /**
   * Conteúdo do Response
   * @var mixed
   */
  private $content;

  /**
   * @param integer $httpCode
   * @param mixed $content
   * @param string $contentType
   * @return mixed
   */
  public function __construct($httpCode, $content, $contentType = 'text/html') {
    $this->httpCode = $httpCode;
    $this->content = $content;
    $this->setContentType($contentType);
  }

  /**
   * Método responsável por alterar o content type do response
   */
  public function setContentType($contentType) {
    $this->contentType = $contentType;
    $this->addHeader('Content-Type', $contentType);
  }

  /**
   * Método responsável por adicionar um registro no cabeçalho de response
   * @param string $key
   * @param string $value
   */
  public function addHeader($key, $value) {
    $this->headers[$key] = $value;
  }

  /**
   * Método responsável por enviar a resposta para o usuário
   */
  public function sendResponse() {
    $this->sendHeaders();
    switch ($this->contentType) {
      case 'text/html':
        echo $this->content;
        exit;
    }
  }

  private function sendHeaders() {
    //STATUS
    http_response_code($this->httpCode);

    //ENVIAR HEADERS
    foreach ($this->headers as $key => $value) {
      header($key.':'.$value);
    }
  }
}