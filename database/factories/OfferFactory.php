<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Offer>
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->randomElement([
            'Early Bird Special - 25% Off',
            'Weekend Getaway Package',
            'Summer Holiday Discount',
            'Business Traveler Deal',
            'Romantic Dinner & Stay',
            'Family Fun Package',
            'Spa & Wellness Retreat'
        ]);
        
        $discountType = $this->faker->randomElement(['percentage', 'amount']);
        
        return [
            'tenant_id' => Tenant::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraphs(2, true),
            'discount_percentage' => $discountType === 'percentage' ? $this->faker->randomFloat(2, 10, 50) : null,
            'discount_amount' => $discountType === 'amount' ? $this->faker->randomFloat(2, 50, 500) : null,
            'currency' => 'USD',
            'code' => $this->faker->optional(0.6)->regexify('[A-Z0-9]{6,10}'),
            'image' => $this->faker->optional(0.7)->imageUrl(400, 300, 'hotel'),
            'valid_from' => $this->faker->dateTimeBetween('-30 days', '+30 days'),
            'valid_until' => $this->faker->dateTimeBetween('+30 days', '+180 days'),
            'conditions' => [
                'minimum_stay' => $this->faker->optional(0.5)->numberBetween(1, 7),
                'advance_booking' => $this->faker->optional(0.3)->numberBetween(7, 30),
                'blackout_dates' => $this->faker->optional(0.2)->words(3),
                'terms' => $this->faker->paragraph(),
            ],
            'status' => $this->faker->randomElement(['active', 'inactive', 'expired']),
        ];
    }
}