<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
	use RefreshDatabase;
	use WithFaker;
	/** @test */
	public function it_has_a_path(){
		$project = factory('App\Project')->create();

		$this->assertEquals(url('/projects')."/".$project->id, $project->path());
	}

	/** @test */
	public function it_belongs_to_an_owner(){
		$project = factory('App\Project')->create();

		$this->assertInstanceOf('App\User',$project->owner);
	}

	/** @test */
	public function it_can_add_a_task(){
		$project = factory('App\Project')->create();

		$body = $this->faker->sentence;
		$task = $project->addTask($body);

		$this->assertCount(1, $project->tasks);
		$this->assertTrue($project->tasks->contains($task));
		$this->assertEquals($task->body, $body);
	}


	/** @test */
	public function it_can_invite_a_user(){
		$project = factory('App\Project')->create();

		$project->invite($user = factory(User::class)->create());

		$this->assertTrue($project->members->contains($user));
	}
}
