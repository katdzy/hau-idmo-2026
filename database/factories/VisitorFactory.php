<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{

    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->unique->ipv4(),
            'visited_at' => Carbon::now()->subDays(rand(0, 6))->subHours(rand(0, 23)),
        ];
    }

    /**
     * Indicate visitor from a specific date
     */
    public function onDate($date): static
    {
        return $this->state(fn (array $attributes) => [
            'visited_at' => Carbon::parse($date)
                ->setHour(rand(0, 23))
                ->setMinute(rand(0, 59))
                ->setSecond(rand(0, 59)),
        ]);
    }
}
