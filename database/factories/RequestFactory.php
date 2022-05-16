<?php

namespace Database\Factories;

use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\RequestStatus;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Request>
 */
class RequestFactory extends Factory
{
    /**
     * @var string $model
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $active = $this->faker->boolean;

        $data = [
            'name' => $this->faker->firstName(),
            'email' => $this->faker->safeEmail(),
            'status' => $active ? RequestStatus::ACTIVE : RequestStatus::RESOLVED,
            'message' => $this->faker->realText(100),
        ];

        if (!$active) {
            $data['comment'] = $this->faker->sentence;
        }
        return $data;
    }
}
