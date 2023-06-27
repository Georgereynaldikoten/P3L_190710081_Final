<?php

namespace App\Http\Controllers;
use App\Models\Timetable;
use App\Models\Classe;
use App\Models\Instructure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timetables = Timetable::OrderBy('id', 'asc')->paginate(7);
        return view('timetable.index', ['timetables'=> Timetable::with('class', 'instructure')->paginate(7)]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'timetable_day' => 'required',
            'timetable_time' => 'required',
            'id_class' => 'required',
            'id_instructure' => 'required',
            'timetable_status' => 'required',
            'timetable_type' => 'required',
            'timetable_date' => 'required',
            'timetable_time' => 'required',
        ]);
        Timetable::create($request->all());
        return redirect()->route('timetable.index')->with('success', 'Data berhasil ditambahkan');
    }
    //Generate Random Timetable for 1 week
    public function generate()
    {
        //Get all classes
        $classes = Classe::all();
        //Get number of classes
        $count = $classes->count();
        //Get all instructure
        $instructures = Instructure::all();
        //Get number of instructure
        $count_instructure = $instructures->count();
        //Get Date today
        $date = Carbon::now();
        // List of Time
        $time = ['08:00', '09:30', '13:00', '09:00', '17:00', '18:30', '20:00', '21:30'];
        //Get  number of time
        $count_time = count($time);
        //foreach classes for 7 days
        for($i=0; $i<=7; $i++)
        {
                    $timetable = new Timetable();
                    $timetable->id_class = $classes[rand(0,$count-1)]->id;
                    $timetable->id_instructure = $instructures[rand(0,$count_instructure-1)]->id;
                    $timetable->timetable_type = 'generate';
                    $timetable->timetable_day = $date->dayName;
                    $timetable->timetable_date = $date;
                    $timetable->timetable_time = $time[rand(0,$count_time-1)];
                    $timetable->timetable_status = '-';
                    $timetable->save();

                    $date->addDay();
                    $i++;
        }

        return redirect()->route('timetable.index')->with('success', 'Timetable Generated Successfully');
        
        
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timetable = Timetable::find($id);
        return view('timetable.edit', compact('timetable'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
                Timetable::find($id)->delete();
                return redirect()->route('timetable.index')->with('success', 'Timetable Deleted Successfully');
    }
}
