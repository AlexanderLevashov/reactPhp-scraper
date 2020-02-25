<?php


namespace AsyncScraper;


class Files
{

    public $title;

    public $rating;

    public $plot;

    public $keywords;

    public $source;

    public function __construct(string $title, string  $rating, string $plot, string $source, string ...$keywords)
    {
        $this->title = $title;
        $this->rating = $rating;
        $this->plot = $plot;
        $this->keywords = $keywords;
        $this->source = $source;
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'rating' => $this->rating,
            'plot' => $this->plot,
            'keywords' => json_encode($this->keywords),
            'source' => $this->source,
        ];
    }
}