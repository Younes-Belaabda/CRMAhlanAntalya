<?php

namespace App;


use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;


use App\Models\Movement;
use App\Models\MovementUser;
use App\Models\Notification;
use App\Models\NotificationUser;

class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'email', 'password','full_name','background','color',
        'type','status','remember_token','token','image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatarAttribute()
    {
      $image = @$this->image;
      if($image == '' || $image == ' ' || $image == null)
        $image = 'default.png';

      //return url('assets/img/team-2.jpg');
      return admin_url('images/'. $image);
    }
    public function getTypenameAttribute()
    {
        $type = "";
        if($this->type == "1"){
            $type = "Admin";
        }
        elseif($this->type == "2"){
            $type = "Driver";
        }
        elseif($this->type == "3"){
            $type = "Agent";
        }
        elseif($this->type == "4"){
            $type = "Vendor";
        }
        elseif($this->type == "5"){
            $type = "Partner";
        }
        return $type;
    }

    public function notification()
    {
       return $this->hasMany(Notification::class,'from_user_id','id')->orderby("created_at","DESC");
    }

    public function movements()
    {
        return $this->belongsToMany(Movement::class,'movement_user','user_id','movement_id')->where("status",1);
    }
    public function movement()
    {
       return $this->hasMany(MovementUser::class,'user_id','id');
    }

    public function allnotification()
    {
       return $this->hasMany(NotificationUser::class,'user_id',"id")->wherehas("notification")->orderby("created_at","DESC")->with("notification");
    }
    public function tonotification()
    {
       return $this->hasMany(NotificationUser::class,'user_id',"id")->GroupBy("notification_id")
       ->wherehas("notification", function(Builder $query){
           $query->where("status",0);
       })->orderby("created_at","DESC");;
       //->whereNotNull("notification_ids");
    }
    // public function tonotification()
    // {
    //   return $this->belongsToMany(Notification::class,'notification_user','notification_id','notification_id','user_id','user_id');//->whereNotNull("notification_ids");
    // }
    // public function partner()
    // {
    //    return $this->belongsToMany(Partners::class,'partners_users');
    // }
    //
    // public function partner(){
    //     return $this->hasOne(Partners::class,'partner_id' , 'partner_id');
    // }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function sum($currancy){
        //$this->Movement
    }
    public static function store($data)
    {
        $instance = new self;
        if(isset($data['id']) && $data['id'] != null){
          $instance = self::find($data['id']);
        }
        $instance->fill($data);
        $instance->save();
        return $instance;
    }

    public function scopeActive($q){
        $q->where('status','1');
    }
    public function scopeAdmin($q){
        $q->where('type','1');
    }
    public function scopePartners($q){
        $q->where('type','2');
    }
    public function scopeSearchers($q){
        $q->where('type','3');
    }
    public function scopeNotadmin($q){
        $q->where('type','!=','1');
    }

}
