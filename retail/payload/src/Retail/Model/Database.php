<?php
Namespace Retail\Model
{
    USE \PDO;

    Class Database
    {
        protected $pdo = null;

        public function __construct($file)
        {
            if (! $settings = parse_ini_file($file, TRUE)) Throw New \Exception("Unable to open {$file}.");

            $dns = $settings['database']['driver'] .
                ':host=' . $settings['database']['host'] .
                ((! empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
                ';dbname=' . $settings['database']['schema'];

            $this->dbh = New \PDO($dns, $settings['database']['username'], $settings['database']['password'], [
                PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

        }

        public function query()
        {
            $stmt = $this->dbh->query('SELECT id, title FROM products', PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
        }

        public function get($id)
        {
            $stmt = $this->dbh->prepare('SELECT title, blurb, description, features, price FROM products WHERE id = :id');
            $stmt->execute([
                ':id' => $id,
            ]);

            return $stmt->fetch(PDO::FETCH_ASSOC);

        }
    }
}