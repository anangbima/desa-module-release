<?php

namespace Modules\DesaModuleRelease\Models;

use DesaDigitalSupport\RegionManager\Services\RegionService;
use Modules\DesaModuleRelease\Models\BaseAuthModel;
use Modules\DesaModuleRelease\Traits\HasSlug;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\DesaModuleRelease\Database\Factories\UserFactory;
use Modules\DesaModuleRelease\Notifications\ResetPasswordNotification;
use Modules\DesaModuleRelease\Notifications\VerifyEmailNotification;
use Modules\DesaModuleRelease\Traits\HasMedia;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends BaseAuthModel implements AuthMustVerifyEmail, JWTSubject
{
    use Notifiable, HasRoles, SoftDeletes, MustVerifyEmail, HasSlug, HasMedia;

    protected $guard_name = 'desa_module_release_web';
    protected $slugSource = 'name';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('users.tables.users', 'users');
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'status',
        'slug',
        'province_code',
        'city_code',
        'district_code',
        'village_code',
    ];

    protected $casts = [
        'last_activity'     => 'datetime',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    protected static function newFactory()
    {
        return UserFactory::new();
    }

    /**
     * Custom= notification method to send password reset notification.
     */
    public function sendPasswordResetNotification($token, $guard = 'web')
    {
        $this->notify(new ResetPasswordNotification($token, $guard));
    }

    /**
     * Custom notification method to send email verification notification.
     */
    public function sendEmailVerificationNotification($guard = 'web')
    {
        $this->notify(new VerifyEmailNotification($guard));
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * 
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get the user's role.
     *
     * @return string|null
     */
    public function getRoleAttribute()
    {
        return $this->getRoleNames()->first();
    }

    /**
     * Check if the user has a verified email.
     *
     * @return bool
     */
    public function getIsVerifiedAttribute()
    {
        return $this->hasVerifiedEmail();
    }

    /**
     * Get the route key name for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Check if the user is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Get profile image URL.
     */
    public function getProfileImageUrlAttribute()
    {
        $media = $this->getSingleMedia('profile_image');

        if ($media) {
            return asset('storage/' . $media->path);
        }
        
        return null;
    }

    /**
     * Get province name
     */
    public function getProvinceNameAttribute()
    {
        return app(RegionService::class)->getProvinceByCode($this->province_code)->name ?? null;
    }

    /**
     * Get city name
     */
    public function getCityNameAttribute()
    {
        return app(RegionService::class)->getCityByCode($this->city_code)->name ?? null;
    }

    /**
     * Get district name
     */
    public function getDistrictNameAttribute()
    {
        return app(RegionService::class)->getDistrictByCode($this->district_code)->name ?? null;
    }

    /**
     * Get village name
     */
    public function getVillageNameAttribute()
    {
        return app(RegionService::class)->getVillageByCode($this->village_code)->name ?? null;
    }

    // Get last activity user
    public function lastActivity()
    {
        return $this->hasOne(LogActivity::class)
                    ->latestOfMany('logged_at');
    }
}