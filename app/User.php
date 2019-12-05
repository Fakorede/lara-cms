<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getBioHtmlAttribute($value)
    {
        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : null;
    }

    public function gravatar()
    {
        $email = $this->email;
        $default = asset("img/author.jpg");
        $size = 100;
        return "https://www.gravatar.com" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
    }
}
