<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\HotelPackage;
use App\Models\Offer;
use App\Models\SocialMediaConfig;
use App\Models\Tenant;
use App\Models\TenantUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample tenants
        $tenants = Tenant::factory()->count(3)->active()->create([
            'name' => function () {
                return fake()->randomElement([
                    'Grand Palace Hotel',
                    'Seaside Resort & Spa',
                    'Mountain View Lodge'
                ]);
            }
        ]);

        foreach ($tenants as $tenant) {
            // Create tenant users
            $adminUser = TenantUser::factory()->create([
                'tenant_id' => $tenant->id,
                'name' => 'Hotel Admin',
                'email' => "admin@{$tenant->slug}.com",
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]);

            TenantUser::factory()->count(2)->create([
                'tenant_id' => $tenant->id,
                'role' => fake()->randomElement(['editor', 'contributor']),
            ]);

            // Create articles
            Article::factory()->count(8)->create([
                'tenant_id' => $tenant->id,
                'author_id' => $adminUser->id,
                'status' => fake()->randomElement(['published', 'published', 'published', 'draft']),
            ]);

            // Create hotel packages with sub-packages
            $mainPackages = HotelPackage::factory()->count(4)->create([
                'tenant_id' => $tenant->id,
                'parent_id' => null,
                'status' => 'active',
            ]);

            foreach ($mainPackages->take(2) as $package) {
                HotelPackage::factory()->count(random_int(1, 3))->create([
                    'tenant_id' => $tenant->id,
                    'parent_id' => $package->id,
                    'price' => fake()->randomFloat(2, 50, 300),
                    'status' => 'active',
                ]);
            }

            // Create galleries
            Gallery::factory()->count(3)->create([
                'tenant_id' => $tenant->id,
                'type' => fake()->randomElement(['gallery', 'slideshow']),
                'images' => [
                    [
                        'url' => fake()->imageUrl(800, 600, 'hotel'),
                        'alt' => 'Hotel exterior view',
                        'caption' => 'Beautiful hotel exterior'
                    ],
                    [
                        'url' => fake()->imageUrl(800, 600, 'room'),
                        'alt' => 'Luxury room interior',
                        'caption' => 'Spacious and comfortable rooms'
                    ],
                    [
                        'url' => fake()->imageUrl(800, 600, 'pool'),
                        'alt' => 'Swimming pool area',
                        'caption' => 'Relaxing pool area'
                    ],
                ],
                'status' => 'active',
            ]);

            // Create offers
            Offer::factory()->count(3)->create([
                'tenant_id' => $tenant->id,
                'valid_from' => now()->subDays(random_int(1, 30)),
                'valid_until' => now()->addDays(random_int(30, 90)),
                'status' => 'active',
            ]);

            // Create events
            Event::factory()->count(5)->create([
                'tenant_id' => $tenant->id,
                'start_datetime' => now()->addDays(random_int(1, 60)),
                'end_datetime' => now()->addDays(random_int(61, 120)),
                'status' => 'upcoming',
            ]);

            // Create social media configurations
            $platforms = ['facebook', 'instagram', 'twitter', 'youtube', 'tiktok'];
            foreach ($platforms as $platform) {
                SocialMediaConfig::create([
                    'tenant_id' => $tenant->id,
                    'platform' => $platform,
                    'username' => strtolower($tenant->slug),
                    'url' => "https://{$platform}.com/" . strtolower($tenant->slug),
                    'is_active' => fake()->boolean(80),
                    'settings' => [
                        'auto_post' => fake()->boolean(),
                        'show_feed' => fake()->boolean(),
                    ],
                ]);
            }
        }
    }
}