<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Article>
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6, true);
        
        return [
            'tenant_id' => Tenant::factory(),
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => $this->faker->paragraph(2),
            'content' => implode("\n\n", $this->faker->paragraphs(5)),
            'featured_image' => $this->faker->optional(0.7)->imageUrl(800, 600, 'hotel'),
            'meta_data' => [
                'meta_title' => $title,
                'meta_description' => $this->faker->sentence(15),
                'keywords' => implode(', ', $this->faker->words(5)),
            ],
            'status' => $this->faker->randomElement(['draft', 'published', 'scheduled']),
            'published_at' => $this->faker->optional(0.8)->dateTimeBetween('-30 days', '+30 days'),
            'author_id' => null, // Will be set in seeder
        ];
    }

    /**
     * Indicate that the article is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }
}