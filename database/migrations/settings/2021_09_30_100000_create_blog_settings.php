<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBlogSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('blog.enabled', false);
    }

    public function down()
    {
        $this->migrator->delete('blog.enabled');
    }
}
