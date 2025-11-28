<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ClearOldIpAddresses extends Command
{
    protected $signature = 'ip:clear';
    protected $description = 'Удаляет IP-адреса старше 7 дней из posts, comments, reports';

    public function handle()
    {
        $cutoff = Carbon::now()->subDays(7);

        DB::table('posts')
            ->where('created_at', '<', $cutoff)
            ->update(['ip_address' => null]);

        DB::table('comments')
            ->where('created_at', '<', $cutoff)
            ->update(['ip_address' => null]);

        DB::table('reports')
            ->where('created_at', '<', $cutoff)
            ->update(['ip_address' => null]);

        $this->info('Старые IP-адреса очищены.');
    }
}
