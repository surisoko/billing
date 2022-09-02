<?php

namespace Tests\Unit\Jobs;

use App\Jobs\CreateBillingUser;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateBillingUserTest extends TestCase
{
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
    }

    /** @test */
    public function it_create_a_new_billing_user()
    {
        $createBillingUser = new CreateBillingUser(
            subject: "BookingCreated",
            payload: [
                'email' => $userEmail = $this->faker->email,
                'hotel_uuid' => $hotelUuid = $this->faker->uuid,
                'name' => $userName = $this->faker->name,
            ],
        );

        $createBillingUser->handle();

        $this->assertDatabaseHas('customers', [
            'email' => $userEmail,
            'hotel_uuid' => $hotelUuid,
            'name' => $userName,
        ]);
    }
}
