<?php
// Clase que hereda de PDO y que implementa el patrón Singleton para que únicamente haya en la aplicación una instancia de ella
class SPDO extends PDO
{
    private static $instance = null;

    public function __construct()
    {
        $config = Config::singleton();
        parent::__construct(
            'mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname'),
            $config->get('dbuser'), $config->get('dbpass')
        );
    }

    public static function singleton()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
?>