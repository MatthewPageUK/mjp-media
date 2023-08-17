<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::macro('fileSlug', function ($title, $separator = '-', $language = 'en', $dictionary = ['@' => 'at']) {
            $title = $language ? Str::ascii($title, $language) : $title;

            // Convert all dashes/underscores into separator
            $flip = $separator === '-' ? '_' : '-';

            $title = preg_replace('!['.preg_quote($flip).']+!u', $separator, $title);

            // Replace dictionary words
            foreach ($dictionary as $key => $value) {
                $dictionary[$key] = $separator.$value.$separator;
            }

            $title = str_replace(array_keys($dictionary), array_values($dictionary), $title);

            // Remove all characters that are not the separator, letters, numbers, or whitespace
            $title = preg_replace('![^\.'.preg_quote($separator).'\pL\pN\s]+!u', '', Str::lower($title));

            // Replace all separator characters and whitespace by a single separator
            $title = preg_replace('!['.preg_quote($separator).'\s]+!u', $separator, $title);

            return trim($title, $separator);
        });

    }
}
