<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_project_can_have_task()
    {
        $this->withoutExceptionHandling();
        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $this->post($project->path().'/tasks', ['body' => 'Test task']);

        $this->get($project->path())->assertSee('Test task');
        
    }
    /** @test */
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        $task = $project->addTask('test Task');

        $this->patch($task->path(), [
           'body' => 'changed',
            'completed' => true
        ]);
        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);

    }

    /** @test */
    public function only_project_owner_can_add_task()
    {
        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create();

        $this->post($project->path().'/tasks', ['body' => 'Test task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);

    }
    /** @test */
    public function only_project_owner_can_update_task()
    {
        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create();

        $task = $project->addTask('new task');

        $this->patch($task->path(), ['body' => 'task changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'task changed']);

    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->actingAs(factory('App\User')->create());
        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        $attributes = factory('App\Task')->raw(['body' => '']);
        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('body');
    }
}
