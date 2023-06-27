<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\Classe;
use App\Models\Promo;

class Deposit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_member',
        'id_class',
        'id_promo',
        'deposit_type',
        'deposit_date',
        'deposit_amount',
        'deposit_bonus',
        'deposit_remaining',
        'deposit_total',
        'deposit_expired_date',
        'deposit_status',
    ];
    public function member(){
        return $this->hasOne(Member::class, 'id', 'id_member');
    }
    public function class(){
        return $this->hasOne(Classe::class, 'id', 'id_class');
    }
    public function promo(){
        return $this->hasOne(Promo::class, 'id', 'id_promo');
    }
    
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
