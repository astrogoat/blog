<?php

namespace Astrogoat\Blog\Settings;

use Helix\Lego\Settings\AppSettings;
use Astrogoat\Blog\Actions\BlogAction;

class BlogSettings extends AppSettings
{
    // public string $url;
    // public string $access_token;

    protected array $rules = [
        // 'url' => ['required', 'url'],
        // 'access_token' => ['required'],
    ];

    protected static array $actions = [
        // BlogAction::class,
    ];

    // public static function encrypted(): array
    // {
    //     return ['access_token'];
    // }

    public function description(): string
    {
        return 'Interact with Blog.';
    }
}
