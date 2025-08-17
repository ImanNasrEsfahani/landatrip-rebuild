<?php

namespace App\Models;

use App\Enums\GenderStatusEnum;
use App\Enums\ProviderEnum;
use App\Events\InvoiceEvent;
use App\Events\RegistrationEvent;
use App\Events\ResetPasswordEvent;
use App\Http\Controllers\UserRatingController;
use App\Mail\VerifyUserEmailMail;
use App\Notifications\NewResetPasswordNotif;
use App\Notifications\VerifyEmail;
use App\Traits\Slugable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laratrust\Traits\HasRolesAndPermissions;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use Laravel\Scout\Searchable;

/**
 * @property numeric $id
 * @property string  $fname
 * @property string  $lname
 * @property string  $slug
 * @property string  $title
 * @property string  $birthday
 * @property string  $email
 * @property string  $email_verified_at
 * @property string  $phone_number
 * @property string  $password
 * @property string  $location
 * @property string  $sex
 * @property string  $about_me
 * @property string  $twitter
 * @property string  $instagram
 * @property string  $facebook
 * @property string  $linkedin
 * @property string  $suspended
 */
class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasRolesAndPermissions, HasApiTokens, HasFactory, Notifiable, HasUlids, MustVerifyEmailTrait, Slugable, CanResetPasswordTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'lname',
        'slug',
        'title',
        'email',
        'birthday',
        'email_verified_at',
        'password',
        'phone_number',
        'phone_number_verified_at',
        'remember_token',
        'verification_code',
        'verification_code_expire',
        'location',
        'sex',
        'about_me',
        'skills',
        "score",
        "provider",
        "suspended"
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fname'                    => "string",
        'lname'                    => "string",
        'slug'                     => "string",
        'title'                    => "string",
        'birthday'                 => "string",
        'email'                    => "string",
        'email_verified_at'        => 'datetime',
        'phone_number'             => "string",
        'phone_number_verified_at' => 'datetime',
        'password'                 => "string",
        'location'                 => "string",
        'sex'                      => GenderStatusEnum::class,
        'provider'                 => ProviderEnum::class,
        'about_me'                 => "string",
        'skills'                   => "array",
        "created_at"               => "datetime",
        "updated_at"               => "datetime",
    ];

    protected $appends = [
        'name'
    ];


    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray()
    {
        return [
            'fname'    => $this->fname,
            'lname'    => $this->lname,
            'email'    => $this->email,
            'slug'     => $this->slug,
            'title'    => $this->title,
            'about_me' => $this->about_me,
        ];
    }

//    protected $dispatchesEvents = [
//        'created' => RegistrationEvent::class,
//    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::created(function ($model) {
            RegistrationEvent::dispatch($model);
        });
    }

    /**
     * @param $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token): void
    {
        ResetPasswordEvent::dispatch($this, $token);
    }


    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * get verification url for email link
     *
     * @return mixed
     */
    public function verificationUrl()
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(config('auth.verification.expire', 120)),
            ['id' => $this->id, 'hash' => sha1($this->email)]
        );
    }

    /**
     * @return void
     */
//    public function sendEmailVerificationNotification()
//    {
//        $this->notify(new VerifyEmail);
//    }

    /**
     * Get the images for this user.
     */
    public function images(): MorphMany|Image|array
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the profile's image for this user
     */
    public function profileImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type', '=', 'profile',);
    }

    /**
     * Get the header's image for this user.
     */
    public function headerImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type', '=', 'header',);
    }

    /**
     * get the followers of this user
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'followings', 'followed_id', 'follower_id')->withTimestamps();
    }

    /**
     * get the following of this user
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'followings', 'follower_id', 'followed_id')->withTimestamps();
    }

    /**
     * The Views that belong to the user.
     */
    public function views(): BelongsToMany
    {
        return $this->belongsToMany(UserView::class);
    }

    //public function userPost

    /**
     * @return HasMany
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * @return HasMany
     */
    public function userDocuments(): HasMany
    {
        return $this->hasMany(UserDocument::class);
    }

    /**
     * @return HasMany
     */
    public function userCompanies(): HasMany
    {
        return $this->hasMany(UserCompany::class);
    }

    /**
     * @return HasMany
     */
    public function userEducations(): HasMany
    {
        return $this->hasMany(UserEducation::class);
    }

    /**
     * Get the posts for this user.
     */
    public function userPosts(): HasMany
    {
        return $this->hasMany(UserPost::class)->orderByDesc('created_at');
    }

    /**
     * Get the posts for this user.
     */
    public function communityUserPosts()
    {
        return $this->hasMany(CommunityUserPost::class);
    }

    /**
     * @return HasMany
     */
    public function groupTutors()
    {
        return $this->hasMany(GroupTutor::class);
    }

    /**
     * @return HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * @return HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, "user_id");
    }

    /**
     * @return HasMany
     */
    public function assignedUser()
    {
        return $this->hasMany(Conversation::class, "assigned_agent_id");
    }

    /**
     * @return HasMany
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class, "user_id");
    }

    /**
     * @return HasMany
     */
    public function certification(): HasMany
    {
        return $this->hasMany(TeacherCertificate::class, "user_id");
    }

    /**
     * @return HasMany
     */

    /**
     * Get the User that owns this certification
     */
    public function userRating(): HasMany
    {
        return $this->hasMany(UserRating::class, "user_id");
    }

    /**
     * Get the User that owns this certification
     */
    public function userRated(): HasMany
    {
        return $this->hasMany(UserRating::class, "user_rated_id");
    }

    public function userPrivacy()
    {
        return $this->hasMany(UserPrivacy::class);
    }

    /**
     * @return HasMany
     */
    public function userBadgeLevels(): HasMany
    {
        return $this->hasMany(UserBadgeLevel::class);
    }

    /**
     * Get the language that owns this skill.
     */
    public function userPostSaved(): HasMany
    {
        return $this->hasMany(UserPostSave::class);
    }

    /**
     * @return BelongsToMany
     */
    public function settings(): BelongsToMany
    {
        return $this->belongsToMany(Setting::class)->withPivot("enabled", "created_at", "update_at");
    }

    /**
     * @return BelongsToMany
     */
    public function agreements(): BelongsToMany
    {
        return $this->belongsToMany(Agreement::class, 'user_agreements')->withTimestamps()->withPivot('acceptance', 'status');
    }

    /**
     * @return BelongsToMany
     */
    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class, 'user_coupons')->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function communities(): BelongsToMany
    {
        return $this->belongsToMany(Community::class, 'community_user')->withTimestamps();
    }

    /**
     * Get the groups for this user
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_users')->withPivot("status")->withTimestamps();
    }

    /**
     * @return BelongsToMany
     */
    public function socialMedia(): BelongsToMany
    {
        return $this->belongsToMany(SocialMedia::class, 'user_social_media')->withTimestamps()->withPivot("address", "social_media_id");
    }

    /**
     * Interact with the user's first name.
     *
     * @return Attribute
     */
    protected function fname(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower(trim($value))
        );
    }

    /**
     * Interact with the user's last name.
     *
     * @return Attribute
     */
    protected function lname(): Attribute
    {
        return Attribute::make(
            get: fn($value) => ucfirst($value),
            set: fn($value) => strtolower(trim($value)),
        );
    }

    /**
     * create a virtual column name from fname and lname
     *
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attributes) => ucfirst($attributes['fname']) . " " . ucfirst($attributes['lname']),
        );
    }

    /**
     * Interact with the user's email
     *
     * @return Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(
        //get: fn ($value) => ucfirst($value),
            set: fn($value) => strtolower(trim($value))
        );
    }

    /**
     * Get all the posts for the country.
     */
    public function groupPosts()
    {
        return $this->belongsToMany(Group::class, 'group_posts')->withTimestamps();
    }

    /**
     * Get the language that owns this skill.
     */
    public function groupPriceItems(): BelongsToMany
    {
        return $this->belongsToMany(GroupPriceItem::class, 'group_price_item_users');
    }

    /**
     * Get the language that owns this skill.
     */
    public function groupRequirements(): BelongsToMany
    {
        return $this->belongsToMany(GroupRequirement::class, 'group_requirement_users');
    }

    /**
     * @return HasMany
     */
    public function userCertificate(): HasMany
    {
        return $this->hasMany(UserCertificate::class);
    }

    /**
     * @return HasMany
     */
    public function userArticles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function conversation()
    {
        return $this->hasMany(Conversation::class);
    }

    public function records()
    {
        return $this->hasMany(ConversationRecord::class);
    }

//    /**
//     * Get the posts for this user.
//     */
//    public function savePost(Post $post, User $user): MorphMany|Post|array
//    {
//        $post->user_id = $user->id;
//        return $this->posts()->save($post);
//    }
//
//    /**
//     * Get the profile's posts for this user
//     */
//    public function profilePosts(): MorphMany|Post|null
//    {
//        return $this->MorphMany(Post::class, 'parentable')->where('post_type', 'profile');
//    }
}


