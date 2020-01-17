<?php

namespace Tests\Feature;

use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddFieldTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_field_requires_a_title_a_type_and_a_subscriber_id()
    {
        $this->post('/api/fields', [
            'title' => null,
            'type' => null,
            'subscriber_id' => null
        ])->assertSessionHasErrors([
            'title' => 'The title field is required.',
            'type' => 'The type field is required.',
            'subscriber_id' => 'The subscriber id field is required.'
        ]);
    }

    /** @test */
    public function a_field_cannot_be_repeated_for_a_subscriber()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => 'generic',
            'type' => 'string',
            'subscriber_id' => 1
        ];

        factory('App\Field')->create($attributes);

        $this->ExpectException(QueryException::class);

        $this->post('/api/fields', $attributes);
    }

    /** @test */
    public function a_field_can_be_created_with_correct_data()
    {
    	$attributes = [
            'title' => 'birthplace',
            'type' => 'string',
            'subscriber_id' => 1
        ];

        $this->post('/api/fields', $attributes)
        	->assertCreated()
            ->assertJsonFragment($attributes);

        $this->assertDatabaseHas('fields', $attributes);
    }
}
