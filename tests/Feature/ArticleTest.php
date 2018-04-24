<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Article;

class ArticleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function setUp(){
    	parent::setUp();
    	$this->initDatabase();
    }
    public function tearDown(){
    	$this->resetDatabase();
    }
    public function testEmptyResult(){
    	$articles = Article::all();
    	$this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $articles);
    	$this->assertEquals(0, count($articles));
    }
    public function testCreateAndList(){
    	for ($i=1; $i<=10;$i++){
    		Article::create([
    			'title' => 'title'.$i,
    			'body' => 'body'.$i
    		]);
    	}
    	$articles = Article::all();
    	$this->assertEquals(10, count($articles));
    }
}
