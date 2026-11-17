<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('farm_latitude', 10, 7)->nullable();
            $table->decimal('farm_longitude', 10, 7)->nullable();
            $table->boolean('receive_disease_alerts')->default(false);
            $table->boolean('show_farm_on_map')->default(false);
            $table->index(
                ['receive_disease_alerts', 'farm_latitude', 'farm_longitude'],
                'users_alert_location_idx',
            );
            $table->index(
                ['show_farm_on_map', 'farm_latitude', 'farm_longitude'],
                'users_farm_map_location_idx',
            );
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('users_alert_location_idx');
            $table->dropIndex('users_farm_map_location_idx');
            $table->dropColumn([
                'farm_latitude',
                'farm_longitude',
                'receive_disease_alerts',
                'show_farm_on_map',
            ]);
        });
    }
};
