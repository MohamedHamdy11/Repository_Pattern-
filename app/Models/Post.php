<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;



class Post extends Model
{
    use HasFactory;

    protected $guard = [];

    function comments(){
    	return $this->hasMany(Comment::class)->orderBy('id','desc');
    }


} // end Post
