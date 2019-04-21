<?php
//немного доработал класс PDO


class Sql
{

    const DB_HOST = 'localhost';
    const DB_NAME = 'learn_db';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_CHAR = 'utf8';
    const DRIVER = 'mysql';

    protected static $instance = null;

    private function __construct()
    {

    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return array
     */
    public static function getRows($sql, $args = [])
    {
//        print_r( self::sql($sql, $args)->fetchAll());
        return self::sql($sql, $args)->fetchAll();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return \PDOStatement
     */
    private static function sql($sql, $args = [])
    {
//        echo "<pre>" . $sql . "</pre>";
//        print_r($args); echo "<br>";
        $stmt = self::instance()->prepare($sql);
//        print_r($stmt);echo "<br>";
        $stmt->execute($args);
        return $stmt;
    }

    /**
     *
     * @return \PDO
     */
    private static function instance()
    {
        if (self::$instance === null) {
            $opt = array(
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => TRUE,
            );
            $dsn = self::DRIVER . ':host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::DB_CHAR;
            self::$instance = new \PDO($dsn, self::DB_USER, self::DB_PASS, $opt);
        }
        return self::$instance;
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return array
     */
    public static function getRow($sql, $args = [])
    {
//        print_r(self::sql($sql, $args)->fetch());
        return self::sql($sql, $args)->fetch();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return integer ID
     */
    public static function insert($sql, $args = [])
    {
        self::sql($sql, $args);
        return self::instance()->lastInsertId();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return integer affected rows
     */
    public static function update($sql, $args = [])
    {
        $stmt = self::sql($sql, $args);
        return $stmt->rowCount();
    }

    /**
     *
     * @param string $sql
     * @param array $args
     * @return integer affected rows
     */
    public static function delete($sql, $args = [])
    {
        $stmt = self::sql($sql, $args);
        return $stmt->rowCount();
    }

    public function password($name, $password)
    {

        return strrev(md5($name)) . md5($password) . md5($name . $password);
    }

    private function __clone()
    {

    }

}
