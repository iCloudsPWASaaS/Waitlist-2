<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\User;
use App\Services\GatewayService;
use App\Services\SubscriptionService;
use App\Http\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

//extra
use App\Models\Gateway;

class ReferralController extends Controller
{
    use ResponseTrait;
    public function __construct()
    {
        $this->theme = template();
    }
    
    public function index(Request $request)
    {
        $data['pageTitle'] = __('My Subscription');
        return view($this->theme.'user.referral.index', $data);
    }

    
}
