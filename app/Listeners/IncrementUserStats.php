<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class IncrementUserStats
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreated $event): void
    {
        $stat = DB::table('stats')
            ->where('key', 'users_count')
            ->first();

        if (!$stat) {
            DB::table('stats')->insert([
                'key' => 'users_count',
                'value' => 1,
            ]);
        } else {
            DB::table('stats')
                ->where('key', 'users_count')
                ->increment('value');
        }
    }
}
