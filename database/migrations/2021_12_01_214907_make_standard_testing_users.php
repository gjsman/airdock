<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeStandardTestingUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = new \App\Models\User;
        $user->name = "Developer Account";
        $user->email = "developer@test.com";
        $user->password = '$2y$10$WgY2oQcKIdXuhj1MhJbMfOgZLub0IRfKjDCxBCueSEVlXgv/1Fo5C';
        $user->save();

        $user_2 = new \App\Models\User;
        $user_2->name = "Administrator Account";
        $user_2->email = "admin@test.com";
        $user_2->password = '$2y$10$WgY2oQcKIdXuhj1MhJbMfOgZLub0IRfKjDCxBCueSEVlXgv/1Fo5C';
        $user_2->staff = true;
        $user_2->save();

        $user_3 = new \App\Models\User;
        $user_3->name = "Visitor Account";
        $user_3->email = "visitor@test.com";
        $user_3->password = '$2y$10$WgY2oQcKIdXuhj1MhJbMfOgZLub0IRfKjDCxBCueSEVlXgv/1Fo5C';
        $user_3->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
