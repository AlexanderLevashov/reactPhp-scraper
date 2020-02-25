<?php

use React\MySQL\QueryResult;

require __DIR__ . '/vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();
$browser = new \Clue\React\Buzz\Browser($loop);
$scraper = new \AsyncScraper\Scraper($browser);

$urls = [
    'https://www.imdb.com/title/tt0111161/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=C963E04XGBB7EWKPNFQQ&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_1',
    'https://www.imdb.com/title/tt0068646/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=SV4XC0JN9NQ25F7WVAEZ&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_2',
];


/*$factory = new \React\MySQL\Factory($loop);
$connection = $factory->createLazyConnection('root@127.0.0.1/savefiles');*/
$storage = new \AsyncScraper\Storage($loop,'root@127.0.0.1/savefiles');

$scraper->scrape(... $urls)->then(function (array $savefiles) use ($storage) {
    $storage->save( ... $savefiles);
    $storage->quit();

});
$loop->run();


/* $connection->query($sql, $files->toArray())
            ->then(function (QueryResult $result) {
                var_dump($result);
            }, function (Exception $exception) {
                echo $exception->getMessage() . PHP_EOL;
            });*/

/* $sql = 'INSERT INTO savefiles (title, rating, plot, keywords, source) VALUES (?, ?, ?, ?, ?)';
    foreach ($savefiles as $files) {
       $connection->query($sql, $files->toArray())
           ->then(function (QueryResult $result) {
               var_dump($result);
           }, function (Exception $exception) {
               echo $exception->getMessage() . PHP_EOL;
           });
    }*/