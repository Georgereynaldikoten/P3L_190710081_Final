<?php

namespace App\Http\Controllers;
use App\Models\Instructure;
use App\Models\Timetable;
use App\Models\InstructurePermission;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InstructurePermissionController extends Controller
{
    public function index()
    {
        $permissions = InstructurePermission::OrderBy('id', 'asc')->paginate(7);
        return view('instructure_permission.index', ['permissions'=> InstructurePermission::with('instructure', 'timetable')->paginate(7)]);
    }

    public function give(Request $request, $id)
    {
        

        $request->validate([
            'id_instructure' => 'required',
            'id_timetable' => 'required',
            'permission_date' => 'required',
            'permission_status' => 'required',
            'subtitute_instructure' => 'required',
        ]);
        //
        $permissions = InstructurePermission::find($id);
        $timetable = Timetable::find($request->id_timetable);
        //find subtitute instructure by name instructure
        $subtitute_instructure = Instructure::where('instructure_name', $request->subtitute_instructure)->first();
        //dd($subtitute_instructure);
                 //find id instructure by name instructure
                $timetable->id_instructure = $subtitute_instructure->id;
                $timetable->timetable_status = "Izin";
                $timetable->save();
                
                $permissions->id_instructure = $request->id_instructure;
                $permissions->id_timetable = $request->id_timetable;
                $permissions->permission_date = $request->permission_date;
                $permissions->permission_status = $request->permission_status;
                $permissions->subtitute_instructure = $request->subtitute_instructure;
                $permissions->permission_att_session = $timetable->timetable_att_session;
                $permissions->save();
                return redirect()->route('instructurepermission.index')->with('success', 'Data berhasil ditambahkan');
          
    }
}
