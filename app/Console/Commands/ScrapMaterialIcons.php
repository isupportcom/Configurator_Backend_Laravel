<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ScrapMaterialIcons extends Command
{
    protected $signature = 'scrap:material-icons';
    protected $description = 'Scrape Material Icons and save to a JSON file';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $response = Http::get('https://jossef.github.io/material-design-icons-iconfont/');

        if ($response->successful()) {
            $html = $response->body();
            $iconNames = [];

            // Use appropriate selectors to target the icon names
            // Modify this selector to match the actual structure of the web page
            // For example, '.icons-gallery-content-gallery-category-icons-wrapper-name'
            $iconSelector = 'icons-gallery-content-gallery-category-icons-wrapper-name';
            $pattern = '/<div class="' . $iconSelector . '">\s*(.*?)\s*<\/div>/';

            $matches = [];

            preg_match_all($pattern, $html, $matches);

            $iconNames = [];

            foreach ($matches[1] as $iconName) {
                if (preg_match('/\b\b/', $iconName)) {
                    $iconNames[] = ['name' => trim(preg_replace('/\n/', '', $iconName))];
                }
            }

            // Store the icon names in a JSON file
            File::put(storage_path('app/material-icons.json'), json_encode($iconNames, JSON_PRETTY_PRINT));
        }
    }
}
