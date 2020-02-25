<?php

use Clue\React\Buzz\Browser;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\DomCrawler\Crawler;

require __DIR__ . '/vendor/autoload.php';

// https://www.pexels.com/photo/adorable-animal-blur-cat-617278/

$loop = \React\EventLoop\Factory::create();

$browser = new Browser($loop);
$browser
    ->get('https://www.imdb.com/title/tt0111161/?pf_rd_m=A2FGELUUNOQJNL&pf_rd_p=e31d89dd-322d-4646-8962-327b42fe94b1&pf_rd_r=C963E04XGBB7EWKPNFQQ&pf_rd_s=center-1&pf_rd_t=15506&pf_rd_i=top&ref_=chttp_tt_1')
    ->then(function (ResponseInterface $response) {
        $crawler = new Crawler((string) $response->getBody());
        $title = $crawler->filter('h1')->text();
        $rating = $crawler->filter('#title-overview-widget > div.vital > div.title_block > div > div.ratings_wrapper > div.imdbRating > div.ratingValue > strong > span')->text();
        $plot = $crawler->filter('#title-overview-widget > div.plot_summary_wrapper > div.plot_summary > div.summary_text')->text();
        $keywords = $crawler->filter('#titleStoryLine > div:nth-child(6) > a')->each(function (Crawler $node, $i) {
            return $node->text();
        });
        $link = $crawler->filter('#title-overview-widget > div.plot_summary_wrapper > div.titleReviewBar > div:nth-child(1) > div > div:nth-child(2) > span > a');
        $source = $link->attr('href');

        print_r([
           $title,
            $rating,
            $plot,
            $keywords,
            $source
        ]);
    });

$loop->run();
