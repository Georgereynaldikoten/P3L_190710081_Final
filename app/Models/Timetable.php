<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Instructure;
use Carbon\Carbon;

class Timetable extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_class',
        'id_instructure',
        'timetable_type',
        'timetable_day',
        'timetable_date',
        'timetable_time',
        'timetable_status',
    ];
    public function class(){
        return $this->hasOne(Classe::class, 'id', 'id_class');
    }
    public function instructure(){
        return $this->hasOne(Instructure::class, 'id', 'id_instructure');
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
