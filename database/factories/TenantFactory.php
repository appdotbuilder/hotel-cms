<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Tenant>
     */
    protected $model = Tenant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->company();
        $slug = Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1, 999);
        
        return [
            'name' => $name . ' Hotel',
            'slug' => $slug,
            'domain' => $this->faker->optional(0.3)->domainName(),
            'database_name' => 'hotel_' . str_replace('-', '_', $slug),
            'config' => [
                'theme' => $this->faker->randomElement(['modern', 'classic', 'luxury']),
                'currency' => $this->faker->randomElement(['USD', 'EUR', 'GBP']),
                'timezone' => $this->faker->timezone(),
            ],
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
        ];
    }

    /**
     * Indicate that the tenant is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}