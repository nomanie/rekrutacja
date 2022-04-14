<?php
namespace App\Services;

use App\Models\Estate;
use App\Models\User;

class EstateService{
    private $estate;

    public function __construct(Estate $estate = null)
    {
        $this->estate = $estate ? $estate : new Estate();
    }

    public function changeSupervisor(User $substitute_supervisor): Estate
    {
        $this->estate->supervisor_user_id = $substitute_supervisor->user_id;
        $this->estate->save();

        return $this->estate;
    }
}
