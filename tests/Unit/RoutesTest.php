<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{

  //use WithoutMiddleware;

  /**
  * @route posts.index
  */
  public function test_posts_index()
  {
    $response = $this->call('GET', '/posts');
    $this->assertEquals(200, $response->status());
  }


  /**
  * @route posts.create
  */
  public function test_posts_create()
  {
    $user = new User(array('name' => 'john'));
    $this->be($user);

    $response = $this->call('GET', '/posts/create');
    $this->assertEquals(200, $response->status());
  }


  /**
  * @route posts.store
  */
  public function test_posts_store()
  {

    $data = [
      'post_title' => 'Test Post Title',
      'post_slug' => 'Test Post Slug',
      'post_content' => 'Test Post Content'
    ];
    $response = $this->call('POST', '/posts', $data);
    $this->assertEquals(302, $response->status());
  }


  /**
  * @route posts.show
  */
  public function test_posts_show()
  {
    $user = new User(array('name' => 'john'));
    $this->be($user);

    $response = $this->call('GET', '/posts/{posts}');
    $this->assertEquals(302, $response->status());
  }


  /**
  * @route posts.edit
  */
  public function test_posts_edit()
  {
    $user = new User(array('name' => 'john'));
    $this->be($user);

    $response = $this->call('GET', '/posts/{posts}/edit');
    $this->assertEquals(404, $response->status());
  }


  /**
  * @route posts.update
  */
  public function test_posts_update()
  {
    $user = new User(array('name' => 'john'));
    $this->be($user);

    $data = [];
    $response = $this->call('PUT', '/posts/{posts}', $data);
    $this->assertEquals(302, $response->status());
  }


  /**
  * @route posts.destroy
  */
  public function test_posts_destroy()
  {
    $user = new User(array('name' => 'john'));
    $this->be($user);

    $data = [];
    $response = $this->call('DELETE', '/posts/{posts}', $data);
    $this->assertEquals(404, $response->status());
  }
}
