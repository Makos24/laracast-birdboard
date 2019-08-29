<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker,RefreshDatabase;

    /** @test */
    public function guest_cannot_create_project()
    {
        //$this->actingAs(factory('App\User')->create());
        //$this->withoutExceptionHandling();
        $attributes = factory('App\Project')->raw();
        $this->post('/projects', $attributes)->assertRedirect('login');
    }

   /** @test */
    public function guest_cannot_view_project()
    {
        $this->get('/projects')->assertRedirect('login');
    }

   /** @test */
    public function guest_cannot_view_single_project()
    {
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->actingAs(factory('App\User')->create());
        $this->withoutExceptionHandling();

        $this->get('projects/create')->assertStatus(200);

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function user_can_view_their_project()
    {
        $this->withoutExceptionHandling();

        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);

        //dd( $this->get($project->path()));
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    public function user_can_update_their_project()
    {
        $this->withoutExceptionHandling();

        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create(['owner_id' => auth()->id()]);
        $attributes = ['title' => 'updated title', 'description' => 'updated body', 'notes' => 'updated notes'];
        $this->patch($project->path(), $attributes);
            $this->assertDatabaseHas('projects', $attributes);
    }
    /** @test */
    public function only_owner_can_update_their_project()
    {
        $this->be(factory('App\User')->create());

        $project = factory('App\Project')->create();
        $attributes = ['title' => 'updated title', 'description' => 'updated body', 'notes' => 'updated notes'];
        $this->patch($project->path(), $attributes)->assertStatus(403);
        $this->assertDatabaseMissing('projects', $attributes);
    }

    /** @test */
    public function user_cannot_view_other_peoples_project()
    {
        $this->be(factory('App\User')->create());

        //$this->withoutExceptionHandling();

        $project = factory('App\Project')->create();

        //dd( $this->get($project->path()));
        $this->get($project->path())
            ->assertStatus(403);
    }


    /** @test */
    public function a_project_has_a_title()
    {
        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_has_a_description()
    {
        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_project_has_a_notes()
    {
        $this->actingAs(factory('App\User')->create());
        $attributes = factory('App\Project')->raw(['notes' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

}
