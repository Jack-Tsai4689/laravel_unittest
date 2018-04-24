<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\ArticleRepository;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;

class ArticleRepositoryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    protected $repository = null;

    protected function seedData(){
    	for ($i=1;$i<=100;$i++){
    		Article::create([
    			'title' => 'title'.$i,
    			'body' => 'body'.$i
    		]);
    	}
    }
    public function setUp(){
    	parent::setUp();
    	$this->initDatabase();
    	$this->seedData();
    	$this->repository = new ArticleRepository();
    }
    public function tearDown(){
    	$this->resetDatabase();
    	$this->repository = null;
    }
    public function testFetchLatest10Articles(){
    	$articles = $this->repository->latest10();
    	$this->assertEquals(10, count($articles));

    	$i = 100;
    	foreach ($articles as $article) {
    		$this->assertEquals('title'.$i, $article->title);
    		$i -=1;
    	}
    }
}
