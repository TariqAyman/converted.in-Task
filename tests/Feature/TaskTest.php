<?php
// Copyright
declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private $task;

    private $user;

    public function setup(): void
    {
        parent::setup();

        $this->user = User::factory([
            'user_type' => 'admin'
        ])->create();

        $this->task = Task::factory()->create();
    }

    public function test_tasks_route_return_ok()
    {
        $response = $this->actingAs($this->user)->get('/task');

        $response->assertSee('Assigned by');

        $response->assertSee('Assigned To');

        $response->assertStatus(200);
    }

    public function test_task_has_name()
    {
        $this->assertNotEmpty($this->task->title);
    }

    public function test_tasks_are_not_empty()
    {
        $response = $this->actingAs($this->user)->get('/task');
        $response->assertSee($this->task->title);
    }

    public function test_unauth_user_cannot_see_buy_button()
    {
        $response = $this->get('/task');
        $response->assertDontSee('count');
    }

    public function test_auth_admin_user_can_see_create_link()
    {
        $admin = User::factory()->create(['user_type' => 'admin']);

        $response = $this->actingAs($admin)->get('/task');
        $response->assertSee('task');
    }

    public function test_unauth_user_cannot_see_create_link()
    {
        $response = $this->get('/task');

        $response->assertDontSee('created at');
    }

    public function test_auth_admin_user_can_visit_the_tasks_create_route()
    {
        $admin = User::factory()->create(['user_type' => 'admin']);
        $response = $this->actingAs($admin)->get('/task/create');
        $response->assertStatus(200);
    }

    public function test_unauth_user_cannot_visit_the_tasks_create_route()
    {
        $response = $this->get('/task/create');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }
}
