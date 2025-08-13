<?php

namespace Database\Factories;

use App\Models\HotelPackage;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HotelPackage>
 */
class HotelPackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\HotelPackage>
     */
    protected $model = HotelPackage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Deluxe Suite Package',
            'Romantic Getaway',
            'Family Fun Package',
            'Business Traveler Special',
            'Weekend Escape',
            'Spa & Wellness Package',
            'Adventure Package',
            'Honeymoon Suite'
        ]);
        
        return [
            'tenant_id' => Tenant::factory(),
            'parent_id' => null,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 150, 1500),
            'currency' => 'USD',
            'features' => [
                $this->faker->randomElement(['Free WiFi', 'Breakfast included', 'Airport transfer']),
                $this->faker->randomElement(['Pool access', 'Gym access', 'Spa treatments']),
                $this->faker->randomElement(['Room service', 'Concierge', 'Late checkout']),
                $this->faker->randomElement(['Mini bar', 'Balcony view', 'Premium amenities']),
            ],
            'images' => [
                $this->faker->imageUrl(800, 600, 'hotel room'),
                $this->faker->imageUrl(800, 600, 'hotel amenity'),
                $this->faker->imageUrl(800, 600, 'hotel view'),
            ],
            'max_occupancy' => $this->faker->numberBetween(1, 6),
            'duration_days' => $this->faker->optional(0.7)->numberBetween(1, 14),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the package is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }
}