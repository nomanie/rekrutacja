<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\ShiftService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class goShift extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shift:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Record to users_shifts table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new ShiftService())->shiftSupervisor(User::find(1), User::find(2), Carbon::yesterday(),Carbon::yesterday());
    }
}
