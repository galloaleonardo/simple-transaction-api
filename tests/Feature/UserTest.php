<?php

namespace Tests\Feature;

use Database\Factories\CompanyFactory;
use Database\Factories\PersonFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_get_all_users()
    {
        $response = $this->get(route('users.index'));

        $response->assertStatus(200);
    }

    public function test_can_create_a_new_person()
    {
        $person = PersonFactory::new()->make()->toArray();

        $response = $this->post(route('users.store'), $person);

        $response->assertCreated();
    }

    public function test_can_create_a_new_company()
    {
        $company = CompanyFactory::new()->make()->toArray();

        $response = $this->post(route('users.store'), $company);

        $response->assertCreated();
    }

    public function test_can_update_a_user()
    {
        $storeUser = CompanyFactory::new()->create();
        $updateUser = CompanyFactory::new()->make()->toArray();

        $response = $this->put(
            route('users.update', ['user' => $storeUser->id]),
            $updateUser
        );

        $response->assertStatus(200);
    }

    public function test_can_delete_a_user()
    {
        $user = CompanyFactory::new()->create();

        $response = $this->delete(
            route('users.destroy', ['user' => $user->id])
        );

        $response->assertStatus(200);
    }

    public function test_cannot_possible_set_another_user_type()
    {
        $user = PersonFactory::new()->make()->toArray();
        $user['user_type'] = 'ong';

        $response = $this->post(route('users.store'), $user);

        $response->assertStatus(422);
    }

    public function test_cannot_possible_set_wrong_length_document()
    {
        $user = PersonFactory::new()->make()->toArray();
        $user['document'] = '35648986';

        $response = $this->post(route('users.store'), $user);

        $response->assertStatus(422);
    }

    public function test_cannot_possible_set_wrong_email_format()
    {
        $user = PersonFactory::new()->make()->toArray();
        $user['document'] = 'email.com';

        $response = $this->post(route('users.store'), $user);

        $response->assertStatus(422);
    }

    public function test_cannot_possible_set_duplicated_email()
    {
        PersonFactory::new()->create();

        $user = PersonFactory::new()->make()->toArray();
        $user['document'] = '17462456798653';

        $response = $this->post(route('users.store'), $user);

        $response->assertStatus(422);
    }

    public function test_cannot_possible_set_duplicated_document()
    {
        PersonFactory::new()->create();

        $user = PersonFactory::new()->make()->toArray();
        $user['document'] = '17462456798653';

        $response = $this->post(route('users.store'), $user);

        $response->assertStatus(422);
    }

    public function test_cannot_possible_set_null_in_required_fields()
    {
        $user = [
            'full_name' => null,
            'user_type' => null,
            'document'  => null,
            'email'     => null,
            'password'  => null
        ];

        $response = $this->post(route('users.store'), $user);

        $response->assertStatus(422);
    }
}
