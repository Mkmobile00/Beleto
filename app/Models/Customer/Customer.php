<?php

namespace App\Models\Customer;

use App\Models\Api\CustomerDeviceList;
use App\Models\Api\CustomerWishList;
use App\Models\CurrencyRate;
use App\Models\CustomerDefaultCurrency;
use App\Models\CustomerDetail;
use App\Models\CustomerMovieHistory;
use App\Models\CustomerNotificationList;
use App\Models\PaymentHistory;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use HasFactory;
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'verify_otp',
        'status',
        'email_or_phone',
        'verified_from',
        'country_code',
        'password',
        'login_type',
        'platform',
        'deleted_at',
        'email_verified_at',
        'reset_otp',
        'from_old',
        'old_user_id',
        'manual_subscription'
    ];

    protected $casts = [
        'status' => \App\Enum\Customer\CustomerStatusEnum::class,
        'login_type' =>\App\Enum\Customer\LoginTypeEnum::class,
    ];

    public function customerDetail()
    {
        return $this->hasOne(CustomerDetail::class, 'customer_id', 'id');
    }

    public function subscription()
    {
        return $this->hasMany(SubscriptionPayment::class, 'customer_id', 'id')->orderBy('id',"DESC");
    }

    public function cutomerDefaultCurrency()
    {
        return $this->hasOne(CustomerDefaultCurrency::class, 'customer_id', 'id');
    }

    public function paymentHistories()
    {
        return $this->hasMany(PaymentHistory::class, 'customer_id', 'id');
    }

    public function getViewHistory()
    {
        return $this->hasMany(CustomerMovieHistory::class, 'customer_id', 'id');
    }

    public function wishList()
    {
        return $this->hasMany(CustomerWishList::class, 'customer_id', 'id');
    }

    public function notificationList()
    {
        return $this->hasMany(CustomerNotificationList::class, 'customer_id', 'id');
    }

    public function deviceList(){
        return $this->hasMany(CustomerDeviceList::class,'customer_id','id');
    }

    public function deviceListAdmin(){
        return $this->hasMany(CustomerDeviceList::class,'customer_id','id')->withTrashed();
    }

    

   
}