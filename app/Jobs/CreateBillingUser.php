<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateBillingUser implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        private string $subject,
        private array $payload
    )
    {
    }

    public function handle(): void
    {
        Customer::query()->updateOrCreate([
            'email' => $this->payload['email'],
        ], [
            'email' => $this->payload['email'],
            'hotel_uuid' => $this->payload['hotel_uuid'],
            'name' => $this->payload['name'],
        ]);
    }
}
