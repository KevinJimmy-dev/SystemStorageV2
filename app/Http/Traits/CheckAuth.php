<?php

namespace App\Http\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait CheckAuth
{
    /** @var User */
    private $user;

    private function boot(): bool
    {
        return $this->authorization();
    }

    /**
     * @return boolean
     */
    public function authorization(): bool
    {
        if(!$this->user = Auth::user()){
            return false;
        }

        return true;
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        $this->boot();

        return $this->user;
    }

    public function checkUserIs($types): bool
    {
        if (!is_array($types)) {
            $types = [$types];
        }

        foreach ($types as $type) {
            if ($type == User::TYPE_ADMIN && !is_null($this->user->admin)) {
                return true;
            }

            if ($type == User::TYPE_COORDINATOR && !is_null($this->user->coordinator)) {
                return true;
            }

            if ($type == User::TYPE_EMPLOYEE && !is_null($this->user->employee)) {
                return true;
            }
        }

        return false;
    }

    public function checkUserIsNot(array $types): bool
    {
        if (!is_null($this->user->admin)) {
            return !in_array(User::TYPE_ADMIN, $types);
        }

        if (!is_null($this->user->coordinator)) {
            return !in_array(User::TYPE_COORDINATOR, $types);
        }

        if (!is_null($this->user->employee)) {
            return !in_array(User::TYPE_EMPLOYEE, $types);
        }

        return true;
    }
}
