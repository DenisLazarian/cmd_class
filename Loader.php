<?php
/**
 * Clase para cargar automaticamente
 * cualquier otra clase que necesites en tu codigo.
 * 
 * URL: https://codigonaranja.com/como-implementar-un-autoload-de-clases-en-php
 */
class  Loader
{
  protected static $dirs = array();
  protected static $registered = 0;
  public function __construct($dirs = array())
  {
      self::init($dirs);
  }
  protected static function loadFile($file)
  {
      if (file_exists($file)) {
          require_once $file;
          return TRUE;
      }
      return FALSE;
  }
  public static function autoLoad($class)
  {
      $success = FALSE;
      $fn = str_replace('\\', DIRECTORY_SEPARATOR, $class)
            . '.php';
      foreach (self::$dirs as $start) {
          $file = $start . DIRECTORY_SEPARATOR . $fn;
          if (self::loadFile($file)) {
              $success = TRUE;
              break;
          }
      }
      if (!$success) {
          if (!self::loadFile(__DIR__
              . DIRECTORY_SEPARATOR . $fn)) {
              throw new \Exception(
                  'No se puede cargar la clase:  ' . $class);
          }
      }


    //   if (PHP_VERSION_ID < 50600) {
    //     if (!headers_sent()) {
    //         header('HTTP/1.1 500 Internal Server Error');
    //     }
    //     $err = 'Composer 2.3.0 dropped support for autoloading on PHP <5.6 and you are running '.PHP_VERSION.', please upgrade PHP or use Composer 2.2 LTS via "composer self-update --2.2". Aborting.'.PHP_EOL;
    //     if (!ini_get('display_errors')) {
    //         if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
    //             fwrite(STDERR, $err);
    //         } elseif (!headers_sent()) {
    //             echo $err;
    //         }
    //     }
    //     trigger_error(
    //         $err,
    //         E_USER_ERROR
    //     );
    // }
    
    // require_once __DIR__ . '/composer/autoload_real.php';
    
    // return ComposerAutoloaderInitef0cf6b14e93ad520947d9bddd0bfb31::getLoader();
    
      
      return $success;
  }
  public static function addDirs($dirs)
  {
      if (is_array($dirs)) {
          self::$dirs = array_merge(self::$dirs, $dirs);
      } else {
        self::$dirs[] = $dirs;
     }
  }
  public static function init($dirs = array())
  {
    
      if ($dirs) {
          self::addDirs($dirs);
      }
      if (self::$registered == 0) {
          spl_autoload_register(__CLASS__ . '::autoload');
          self::$registered++;
      }

    //   if (PHP_VERSION_ID < 50600) {
    //     if (!headers_sent()) {
    //         header('HTTP/1.1 500 Internal Server Error');
    //     }
    //     $err = 'Composer 2.3.0 dropped support for autoloading on PHP <5.6 and you are running '.PHP_VERSION.', please upgrade PHP or use Composer 2.2 LTS via "composer self-update --2.2". Aborting.'.PHP_EOL;
    //     if (!ini_get('display_errors')) {
    //         if (PHP_SAPI === 'cli' || PHP_SAPI === 'phpdbg') {
    //             fwrite(STDERR, $err);
    //         } elseif (!headers_sent()) {
    //             echo $err;
    //         }
    //     }
    //     trigger_error(
    //         $err,
    //         E_USER_ERROR
    //     );
    // }
    
    // require_once __DIR__ . '/composer/autoload_real.php';
    
    // return ComposerAutoloaderInitef0cf6b14e93ad520947d9bddd0bfb31::getLoader();
    
  }
} // fin de la clase
 ?>