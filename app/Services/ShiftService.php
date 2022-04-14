<?php
namespace App\Services;

use App\Models\Estate;
use App\Models\User;
use App\Models\UserShift;
use Carbon\Carbon;
use Exception;

class ShiftService{
    private $shift;

    public function __construct(UserShift $shift = null)
    {
        $this->shift = $shift ? $shift : new UserShift();
    }

    public function shiftSupervisor(User $user, User $substitute_user,Carbon $date_from,Carbon $date_to): UserShift
    {
        $estates = $user->estate;
        $this->shift->user_id = $user->user_id;
        $this->shift->substitute_user_id = $substitute_user->user_id;
        $this->shift->temp_changes = $estates;
        $this->shift->date_from = $date_from;
        $this->shift->date_to = $date_to;
        $this->shift->save();

        foreach($estates as $estate){
            (new EstateService($estate))->changeSupervisor($substitute_user);
        }

        return $this->shift;
    }

    public function checkEndDate(): void
    {

        foreach(UserShift::all() as $shift) {
            if(Carbon::now()->gt(new Carbon($shift->date_to))){
                $this->backSupervisor($shift);
            }
        }
    }

    private function backSupervisor(UserShift $userShift): void
    {
        try{
            $estates = $userShift->temp_changes;
            if(!($estates === null)){
                $user = User::find($userShift->user_id);
                foreach($estates as $estate){
                    $estate = Estate::find($estate['id']);
                    (new EstateService($estate))->changeSupervisor($user);
                }
            }
            $userShift->delete();
        }catch(\Exception $e){
            echo $e;
        }
    }
}
