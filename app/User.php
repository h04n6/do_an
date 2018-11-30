<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;
    
    const ROLE_SUPERADMIN = 1;
    const ROLE_ADMIN = [1,2,3,4,5];
    const ROLE_CUSTOMER = 6;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'password', 'role_id','email','phone','address', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role');
    }
    
    public function created_at() {
        return date( "d/m/Y", strtotime($this->created_at));
    }
    public function updated_at() {
        return date( "d/m/Y", strtotime($this->updated_at));
    }
     public function phone() {
        return '0'.$this->phone;
    }
}
