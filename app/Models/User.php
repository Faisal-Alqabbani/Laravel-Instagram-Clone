<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'bio',
        'url',
        'status',
        'password',
        'username',
        'language'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    
    public function posts(){
        return $this->hasMany(Post::class)->orderBy('created_at','DESC');
    }
    
    public function comments(){
        return $this->hasMany(Comment::class)->orderBy('created_at','DESC');
    }

    public function follows(){
        return $this->belongsToMany(User::class,'follows','user_id','following_user_id');
    }
    public function followers(){
        return $this->belongsToMany(User::class,'follows','following_user_id','user_id');
    }
    // Insted of follow and unfollow 
    public function toggle(User $user){
        // toggle is built in function used with models
        return $this->follows()->toggle($user);
    }

    // This function will check if the user is followed you or not
    public function following(User $user){
        return $this->follows()->where('following_user_id',$user->id)->exists();
    }

    public function setAccepted(User $user){
        if($user->status == "public"){
            DB::table('follows')
            ->where('user_id',$this->id)
            ->where('following_user_id', $user->id)
            ->update(['accepted' => true]); 
        }
    }
    public function accepted(User $user){
        if($this->status == "public"){
            return true;
        }else{
            // test if the user follows another user
            (bool)DB::table('follows')
            ->where("user_id", $this->id)
            ->where('following_user_id',$user->id)
            ->where('accepted', true)->count();
        }
    }

    // Follow request 
    public function followsReq(){
        if($this->status == "private")
        {
            return $this->followers()
            ->where('following_user_id',$this->id)
            ->where('accepted',false)
            ->latest()->paginate(5);
        }
        return null;
        
    }

    public function penndingFollowingReq(){
        return $this->follows()
        ->where("user_id", $this->id)
        ->where('accepted', false)
        ->latest()->get();
    }

    public function followingAndAccepted(User $user){
        return $this->follows()->where("following_user_id",$user->id)
        ->where('accepted',true)->exists();
    }
    
    public function toggleAccepted(User $user, $status){
        return DB::table('follows')
        ->where("user_id", $user->id)
        ->where("following_user_id", $this->id)
        ->update([
            "accepted" => $status,
        ]); 
    }

    // will get all users that the user follow 
    public function home(){
        $ids = $this->follows()->where('accepted', true)->get()->pluck('id');
        return Post::whereIn('user_id', $ids)->latest()->get();
    }

    // get the latest followers 
    public function Ifollow(){
        return $this->follows()
        ->where('accepted', true)
        ->where('user_id', $this->id)
        ->latest()->get();
    }
    // users maybe I want to follow them 
    public function otherUsers(){
        $ifollow = $this->Ifollow()->pluck('id')->toArray();
        $penndingFollow = $this->penndingFollowingReq()->pluck('id')->toArray();
        array_push($ifollow, $this->id);
        $others = array_merge($ifollow, $penndingFollow);
        return User::whereNotIn('id',$others)->latest()->get();
    }

    // Explore 
    public function explore(){
        $ifllow = $this->ifollow()->pluck('id')->toArray();
        array_push($ifllow, $this->id);
        $public = User::where('status','private')->pluck('id')->toArray();
        $others = array_merge($ifllow,$public);
        return Post::whereNotIn('id',$others)->latest()->paginate(30);
    }
    // public function follow(User $user){
    //     return $this->follows()->save($user);
    // }
    // public function unFollow(User $user){
    //     return $this->follows()->detach($user);
    // }
}
