<?php

namespace Database\Factories;

use App\Models\SocialMediaConfig;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SocialMediaConfig>
 */
class SocialMediaConfigFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\SocialMediaConfig>
     */
    protected $model = SocialMediaConfig::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $platform = $this->faker->randomElement(['facebook', 'instagram', 'twitter', 'youtube', 'tiktok', 'linkedin']);
        $username = $this->faker->userName();
        
        return [
            'tenant_id' => Tenant::factory(),
            'platform' => $platform,
            'username' => $username,
            'url' => "https://{$platform}.com/{$username}",
            'access_token' => $this->faker->optional(0.3)->sha256(),
            'settings' => [
                'auto_post' => $this->faker->boolean(),
                'show_feed' => $this->faker->boolean(),
                'feed_limit' => $this->faker->numberBetween(5, 20),
                'hashtags' => $this->faker->words(3),
            ],
            'is_active' => $this->faker->boolean(80),
        ];
    }
}