<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\UserShift;
use App\Services\ShiftService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckShiftsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * The UserShift instance.
     *
     * @var \App\Models\UserShift
     */
    protected $shift;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserShift $shift = null)
    {
        $this->shift = $shift;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        (new ShiftService())->checkEndDate();
    }
}
