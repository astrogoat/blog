<?php

namespace Astrogoat\Blog\Actions;

use Helix\Lego\Apps\Actions\Action;

class BlogAction extends Action
{
    public static function actionName(): string
    {
        return 'Blog action name';
    }

    public static function run(): mixed
    {
        return redirect()->back();
    }
}
