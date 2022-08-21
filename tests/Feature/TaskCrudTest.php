<?php
// Copyright
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskCrudTest extends TestCase
{
    use RefreshDatabase;

    private $admin;

    private $user;

    public function setup(): void
    {
        parent::setup();

        $this->admin = User::factory([
            'user_type' => 'admin'
        ])->create();

        $this->user = User::factory([
            'user_type' => 'user'
        ])->create();
    }

    public function test_admin_can_store_new_task()
    {
        $response = $this->actingAs($this->admin)->post('/task', [
            'title' => 'test title',
            'description' => 'test description',
            'assigned_to_id' => $this->user->id,
            'assigned_by_id' => $this->admin->id
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/task');
        $this->assertCount(1, Task::all());
        $this->assertDatabaseHas('tasks', [
            'title' => 'test title',
            'description' => 'test description',
            'assigned_to_id' => $this->user->id,
            'assigned_by_id' => $this->admin->id
        ]);
    }

    public function test_admin_can_see_the_edit_task_page()
    {
        $task = Task::factory()->create();
        $response = $this->actingAs($this->admin)->get('/task/' . $task->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee($task->title);
    }

    public function test_admin_can_update_task()
    {
        Task::factory()->create();
        $this->assertCount(Task::query()->count(), Task::all());
        $task = Task::first();
        $response = $this->actingAs($this->admin)->patch('/task/' . $task->id, [
            'title' => 'test title2',
            'description' => 'test description2',
            'assigned_to_id' => $this->user->id,
            'assigned_by_id' => $this->admin->id
        ]);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect('/task');
        $this->assertEquals('test title2', $task->title);
    }

    public function test_admin_can_delete_task()
    {
        $task = Task::factory()->create();
        $this->assertEquals(1, Task::count());
        $response = $this->actingAs($this->admin)->delete('/task/' . $task->id);
        $response->assertStatus(302);
        $this->assertEquals(0, Task::count());
    }
}
