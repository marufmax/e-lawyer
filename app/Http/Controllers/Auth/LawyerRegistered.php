<?php

namespace Illuminate\Auth\Events;

use Illuminate\Queue\SerializesModels;

class LawyerRegistered
{
    use SerializesModels;

    /**
     * The authenticated user.
     *
     * @var \Illuminate\Contracts\Auth\Authenticatable
     */
    public $lawyer;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function __construct($lawyer)
    {
        $this->lawyer = $lawyer;
    }
}
