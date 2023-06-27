<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Instructure;
use App\Models\Timetable;
use Carbon\Carbon;


class InstructurePermission extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_instructure',
        'id_timetable',
        'permission_date',
        'permission_status',
        'subtitute_instructure',
        'permission_att_session',
    ];

    public function instructure(){
        return $this->hasOne(Instructure::class, 'id', 'id_instructure');
    }

    public function timetable(){
        return $this->hasOne(Timetable::class, 'id', 'id_timetable');
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
