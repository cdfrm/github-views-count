<?php

namespace Ghvc\Data;

use PDO;
use Dotenv\Dotenv;
use Webmozart\Assert\Assert;

class BadgeData
{
    private const MIN_LENGTH = 1;

    private const MAX_LENGTH = 39;

    private const REGEX = '#^[a-z\d](?:[a-z\d]|-(?=[a-z\d])){0,38}$#i';

    private $username;

    protected $path;

    protected $connection;

    protected $table;


    public function __construct(){
        $this->path = realpath(__DIR__ . '/../../../ghvc/');
        $this->connection = $this->connect();
        $this->table = 'github_profile_views';
        $this->username = $this->validateUsername($_GET['username']);
    }

    public function getCountByUsername(){
       
        $statement = $this->connection->prepare(
            'SELECT `visited`
               FROM ' . $this->table . '
              WHERE username = :username;'
        );
        $statement->bindParam('username', $this->username);
        $statement->execute();

        $count = (int) $statement->fetchColumn(0) + 1;
        
        $isInsert = false;
        if($count == 1){
            $isInsert = true;
        }
        $this->addViewByUsername($count, $isInsert);

        return $count;
    }

    private function addViewByUsername($newCount, $insert = false): void
    {
        if($insert){
            $statement = $this->connection->prepare(
                'INSERT INTO ' . $this->table . ' VALUES (NULL, :username, :visited);');
            $statement->bindParam('visited', $newCount);
            $statement->bindParam('username', $this->username);
            $statement->execute();
        }else{
            $statement = $this->connection->prepare(
                'UPDATE ' . $this->table . '
                      SET visited = :visited
                      WHERE username = :username;
                      ;'
            );
            $statement->bindParam('visited', $newCount);
            $statement->bindParam('username', $this->username);
            $statement->execute();
        }
    }
    

    private function connect(){
        $dotEnv = Dotenv::createImmutable($this->path);
        $dotEnv->load();

        $dotEnv->required([
            'DB_DRIVER',
            'DB_HOST',
            'DB_PORT',
            'DB_USER',
            'DB_PASSWORD',
            'DB_NAME',
        ]);

        $dsn = sprintf(
            '%s:host=%s;port=%d;dbname=%s',
            $_ENV['DB_DRIVER'], $_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_NAME']
        );
        
        $dbConnectionOptions = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ];

        return new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $dbConnectionOptions);
    }

    private function validateUsername($username){
        Assert::minLength($username, self::MIN_LENGTH);
        Assert::maxLength($username, self::MAX_LENGTH);
        Assert::regex($username, self::REGEX, 'Username may only contain alphanumeric characters or single hyphens, and cannot begin or end with a hyphen.');

        return strtolower($username);
    }
}

