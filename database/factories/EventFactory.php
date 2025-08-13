<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Event>
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->randomElement([
            'Wine Tasting Evening',
            'Live Jazz Performance',
            'Chef\'s Table Experience',
            'Yoga & Meditation Session',
            'Art Exhibition Opening',
            'Business Networking Event',
            'Holiday Celebration Dinner',
            'Cooking Class with Master Chef'
        ]);
        
        $startDate = $this->faker->dateTimeBetween('+1 week', '+3 months');
        $endDate = $this->faker->optional(0.7)->dateTimeBetween($startDate, $startDate->format('Y-m-d H:i:s') . ' +6 hours');
        
        return [
            'tenant_id' => Tenant::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(3, true),
            'location' => $this->faker->randomElement([
                'Main Restaurant',
                'Poolside Terrace',
                'Conference Room A',
                'Garden Pavilion',
                'Rooftop Lounge',
                'Spa Wellness Center',
                'Private Dining Room'
            ]),
            'start_datetime' => $startDate,
            'end_datetime' => $endDate,
            'price' => $this->faker->optional(0.6)->randomFloat(2, 25, 250),
            'currency' => 'USD',
            'max_attendees' => $this->faker->optional(0.8)->numberBetween(10, 100),
            'featured_image' => $this->faker->optional(0.8)->imageUrl(600, 400, 'event'),
            'additional_info' => [
                'contact_email' => $this->faker->email(),
                'contact_phone' => $this->faker->phoneNumber(),
                'requirements' => $this->faker->optional(0.4)->sentence(),
                'dress_code' => $this->faker->optional(0.3)->randomElement(['Casual', 'Smart Casual', 'Formal']),
                'includes' => $this->faker->words(3),
            ],
            'status' => $this->faker->randomElement(['upcoming', 'ongoing', 'completed', 'cancelled']),
        ];
    }
}