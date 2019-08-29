<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use WithFaker,RefreshDatabase;
    /** @test */
    public function a_project_has_path()
    {
        $this->withoutExceptionHandling();
        $project = factory('App\Project')->create();

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function a_project_has_user()
    {
        $project = factory('App\Project')->create();

        $this->assertInstanceOf('App\User',$project->owner);
    }
    /** @test */
    public function a_project_can_add_task()
    {
        $project = factory('App\Project')->create();


        $task = $project->addTask('Test task');

        $this->assertCount(1, $project->tasks);

        $this->assertTrue($project->tasks->contains($task));
    }
}
