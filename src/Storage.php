<?php


namespace AsyncScraper;


use Exception;
use React\EventLoop\LoopInterface;
use React\MySQL\Factory;
use React\MySQL\QueryResult;
use React\Promise\FulfilledPromise;
use React\Promise\PromiseInterface;
use React\Promise\RejectedPromise;
use function React\Promise\reject;

class Storage
{

    private $connection;

    public function __construct(LoopInterface $loop, string $uri)
    {
        $this->connection = (new Factory($loop))->createLazyConnection($uri);
    }

    /*public function saveIsNotExist(Files ...$savefiles): void // remove, if exist char, etc, instead id
    {
        foreach ($savefiles as $files) {
            $this->isNotStored($files->title)
                ->then(function () use ($files) {
                    $this->save($files);
                });
        }

    }*/


    public function save(Files ...$savefiles): void // public ... $savefiles or private Files $files
    {
        $sql = "INSERT INTO savefiles (title, rating, plot, keywords, source) VALUES (?, ?, ?, ?, ?)";
        foreach ($savefiles as $files) {
            $this->connection->query($sql, $files->toArray())
                ->then(function (QueryResult $result) {
                    var_dump($result);
                }, function (Exception $exception) {
                    echo $exception->getMessage() . PHP_EOL;
                });
        }

    }

    /*public function quit(): void
    {
        $this->connection->quit();
    }*/

    /*private function isNotStored(char $title): PromiseInterface // <- problem is here, instead char need to use int, and instead $title - $id, but i don't have this approach
    {
        $sql = 'SELECT 1 FROM savefiles WHERE $title = ?';
        return $this->connection->query($sql, [$title])
            ->then(
                function (QueryResult $result) {
                    return count($result->resultRows) ? reject() : resolve();
                },
                function (Exception $exception) {
                    echo 'Error:' . $exception->getMessage() . PHP_EOL;
                }
            );
    }*/
}
