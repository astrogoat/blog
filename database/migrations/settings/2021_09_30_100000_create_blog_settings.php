<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateBlogSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('blog.enabled', false);
        // $this->migrator->add('blog.url', '');
        // $this->migrator->addEncrypted('blog.access_token', '');
    }

    public function down()
    {
        $this->migrator->delete('blog.enabled');
        // $this->migrator->delete('blog.url');
        // $this->migrator->delete('blog.access_token');
    }
}
