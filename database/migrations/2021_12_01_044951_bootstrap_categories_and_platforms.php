<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BootstrapCategoriesAndPlatforms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Category::firstOrCreate([
            'name' => 'Admin tools',
            'description' => 'Tools for server administrators to use that are generally not player-facing.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Chat',
            'description' => 'Chat moderation, customization, logging, or other chat-related plugins.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Developer tools',
            'description' => 'Tools for helping developers make or maintain plugins, not for normal server administrators.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Economy',
            'description' => 'Money management, donations, shops, anything that has to do with server currency.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Gameplay',
            'description' => 'Custom mechanics, balancing changes, weapons tweaks, anything that affects normal gameplay mechanics.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Games',
            'description' => 'Minecraft minigames eschew the standard multiplayer world in favor of fun, challenging group games.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Protection',
            'description' => 'Prevent griefers, trolls, spammers, and hackers; or control where players can build to avoid conflicts.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Role Playing',
            'description' => 'Every player has an inner wizard! Or dragon. Or glow squid.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'World Management',
            'description' => 'Boring stuff you should not ignore, like backups or software updates.',
        ]);
        \App\Models\Category::firstOrCreate([
            'name' => 'Miscellaneous',
            'description' => 'Anything that does not fit in categories we already have.',
        ]);
        \App\Models\Platform::firstOrCreate([
            'name' => 'Paper',
            'description' => 'The Paper Minecraft Server Software. (It\'s great.)',
        ]);
        \App\Models\Platform::firstOrCreate([
            'name' => 'Velocity',
            'description' => 'The Best Proxy System for Paper. (It\'s super great.)',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Platform::where('name', 'Paper')->delete();
        \App\Models\Platform::where('name', 'Velocity')->delete();
        \App\Models\Category::where('name', 'Admin tools')->delete();
        \App\Models\Category::where('name', 'Chat')->delete();
        \App\Models\Category::where('name', 'Developer tools')->delete();
        \App\Models\Category::where('name', 'Economy')->delete();
        \App\Models\Category::where('name', 'Gameplay')->delete();
        \App\Models\Category::where('name', 'Games')->delete();
        \App\Models\Category::where('name', 'Protection')->delete();
        \App\Models\Category::where('name', 'Role Playing')->delete();
        \App\Models\Category::where('name', 'World Management')->delete();
        \App\Models\Category::where('name', 'Miscellaneous')->delete();
    }
}
