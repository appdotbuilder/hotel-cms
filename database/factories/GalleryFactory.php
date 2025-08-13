<?php

namespace Database\Factories;

use App\Models\Gallery;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Gallery>
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Hotel Exterior Gallery',
            'Room Collections',
            'Dining & Restaurant',
            'Spa & Wellness Center',
            'Events & Conferences',
            'Recreation & Activities'
        ]);
        
        return [
            'tenant_id' => Tenant::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['gallery', 'slideshow']),
            'images' => [
                [
                    'url' => $this->faker->imageUrl(800, 600, 'hotel'),
                    'alt' => 'Hotel image',
                    'caption' => $this->faker->sentence(),
                    'order' => 1
                ],
                [
                    'url' => $this->faker->imageUrl(800, 600, 'room'),
                    'alt' => 'Room image', 
                    'caption' => $this->faker->sentence(),
                    'order' => 2
                ],
                [
                    'url' => $this->faker->imageUrl(800, 600, 'amenity'),
                    'alt' => 'Amenity image',
                    'caption' => $this->faker->sentence(),
                    'order' => 3
                ],
            ],
            'settings' => [
                'autoplay' => $this->faker->boolean(),
                'show_captions' => $this->faker->boolean(),
                'transition_speed' => $this->faker->randomElement([3000, 5000, 7000]),
            ],
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'sort_order' => $this->faker->numberBetween(0, 100),
        ];
    }
}