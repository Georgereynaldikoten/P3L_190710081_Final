<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Employee extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
    
        'id',
        'id_user',
        'id_role',
        'employee_name',
        'employee_address',
        'employee_gender',
        'employee_phone_number',
        'employee_birth_date',
        'employee_email',
        'employee_password',
    ];

    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}

