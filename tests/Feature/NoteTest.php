<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

//    public function setUp(): void
//    {
//        parent::setUp();
//        User::factory(1)->create();
//        Note::factory(10)->create();
//
//    }
//
//    public function tearDown(): void
//    {
//        // Eliminar los datos de prueba de la base de datos de prueba
////        Artisan::call('migrate:fresh', ['--env' => 'testing']);
////        parent::tearDown();
//    }

    /** @test */
    public function a_create_a_note()
    {

        $response = $this->post('/notes', [
            'excerpt' => 'Nota de prueba',
            'content' => 'Contenido de la nota de prueba'
        ]);

        $response->assertStatus(302); // Verificar que se redirige después de crear una nota
    }

    /** @test */
    public function it_requires_a_excerpt()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/notes', [
            'excerpt' => '',
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['excerpt']);

    }

    /** @test */
    public function it_requires_a_content()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/notes', [
            'content' => '',
        ]);

        $response->assertStatus(302)
            ->assertSessionHasErrors(['content']);

    }
    /** @test */
    public function a_delete_a_note()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $nota = Note::factory()->create([
            'excerpt' => 'my note',
            'content' => 'my content',
             'created_by' => $user->id
        ]);

        $response = $this->delete('/notes/' . $nota->id);
        $response->assertStatus(302);

    }
}
