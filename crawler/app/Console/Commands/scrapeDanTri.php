<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte;
use App\Post;
class scrapeDanTri extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraper:dantri';
    //protected $category

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $crawler = Goutte::request('GET', 'https://dantri.com.vn/xa-hoi.htm');
    
    $linkPost = $crawler->filter('a.fon6')->each(function ($node) {
    return $node->attr("href");
    });
    foreach ($linkPost as $link) {
        $l=env("DAN_TRI").$link;
       self::scrapePost($l);
    }
    }

    public static function scrapePost($url){
    $crawler = Goutte::request('GET', $url);
    
    $title = $crawler->filter('h1.fon31.mgb15')->each(function ($node) {
    return $node->text();
    });
    if(isset($title[0])){
        $title=$title[0];
    }

        $slug= str_slug($title);

        $description=$crawler->filter('h2.fon33.mt1.sapo')->each(function ($node) {
     return $node->text();
    });

         if(isset($description[0])){
        $description=$description[0];
    }
        $description= str_replace('Dan Tri', '', $description);

    $content=$crawler->filter('h2.fon33.mt1.sapo')->each(function ($node) {
    return $node->text();
    });
     if(isset($content[0])){
        $content=$content[0];
    }

      
    $thumbnail=$crawler->filter('div.VCSortableInPreviewMode img')->each(function ($node) {
    return $node->attr('src');
    }); 
     if(isset($thumbnail[0])){
        $thumbnail=$thumbnail[0];
    }


    $data = [
        'title' =>$title,
        'slug' =>$slug,
        'description' =>$description,
        'content' => $content,
        'thumbnail' =>$thumbnail
    ];

    Post::create($data);

    print("done!" ."\n");

    }
}
