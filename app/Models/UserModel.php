<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    function get_users($user=[]): ?object
    {
        $tb = DB::table($this->table);
        if (isset($user['user_id']))
            $tb->whereRaw("BINARY `user_id`= ?",[$user['user_id']]);
        if (isset($user['user_email']))
            $tb->where('user_email',$user['user_email']);
        if (isset($user['user_password']))
            $tb->whereRaw("BINARY `user_password`= ?",[$user['user_password']]);
        return $tb->get();
    }

}
