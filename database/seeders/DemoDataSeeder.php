<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comic;
use App\Models\ComicPage;
use App\Models\Character;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $characters = Character::factory(30)->create();

        Series::factory(6)->create()->each(function (Series $series) use ($characters) {
            // Create 12 comics per series with sequential issue numbers
            for ($issueNumber = 1; $issueNumber <= 12; $issueNumber++) {
                $comic = Comic::factory()->create([
                    'series_id' => $series->id,
                    'issue_number' => $issueNumber, // Ensures unique issue per series
                ]);

                // Attach 2-5 random characters per comic
                $comic->characters()->attach(
                    $characters->random(rand(2, 5))->pluck('id')->toArray(),
                    ['role' => 'main']
                );

                // Create pages for the comic
                $pageTotal = $comic->page_count ?: 22;
                $pages = [];
                for ($i = 1; $i <= $pageTotal; $i++) {
                    $pages[] = [
                        'comic_id' => $comic->id,
                        'page_number' => $i,
                        'image_url' => "https://picsum.photos/seed/{$comic->id}-{$i}/1200/1800",
                        'alt_text' => "Page {$i} of {$comic->title}",
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                ComicPage::insert($pages);
            }

            // Update series total_issues
            $series->update([
                'total_issues' => $series->comics()->count(),
            ]);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
