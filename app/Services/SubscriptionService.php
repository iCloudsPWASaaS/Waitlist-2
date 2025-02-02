<?php

namespace App\Services;

use App\Models\GatewayCurrency;
use App\Models\OwnerPackage;
use App\Models\Package;
use App\Models\User;
use App\Http\Traits\ResponseTrait;

class SubscriptionService
{
    use ResponseTrait;

    public function getCurrentPlan($userId = null)
    {
        $userId = $userId == null ? auth()->id() : $userId;
        $ownerPackage = OwnerPackage::query()
            ->where('user_id', $userId)
            ->whereIn('owner_packages.status', [1])
            ->whereDate('end_date', '>=', now())
            ->select('owner_packages.*')
            ->first();
        return $ownerPackage?->makeHidden(['created_at', 'updated_at', 'deleted_at', 'is_trail', 'order_id', 'package_id', 'user_id']);
    }

    public function getAllPackages()
    {
        return Package::where('status', 1)->where('is_trail', '!=', 1)->get();
    }

    public function getById($id)
    {
        $package = Package::query()->findOrFail($id);
        return $package?->makeHidden(['created_at', 'deleted_at', 'updated_at']);
    }

    public function getCurrencyByGatewayId($id)
    {
        $userId = User::where('role', USER_ROLE_ADMIN)->first()->id;
        $currencies = GatewayCurrency::where(['owner_user_id' => $userId, 'gateway_id' => $id])->get();
        foreach ($currencies as $currency) {
            $currency->symbol =  $currency->symbol;
        }
        return $currencies?->makeHidden(['created_at', 'updated_at', 'deleted_at', 'gateway_id', 'owner_user_id']);
    }

    public function cancel()
    {
        return OwnerPackage::query()
            ->where(['user_id' => auth()->id(), 'status' => 1])
            ->whereDate('end_date', '>=', now()->toDateTimeString())
            ->update(['status' => DEACTIVATE]);
    }
}
