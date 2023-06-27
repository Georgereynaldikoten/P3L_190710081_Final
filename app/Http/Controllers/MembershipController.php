<?php

namespace App\Http\Controllers;
use App\Models\Membership;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDF;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $memberships = Membership::OrderBy('id', 'desc')->paginate(5);
        return view('transaction.membership.index',['memberships' => Membership::with('member')->paginate(5)]);
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
       // Get Date today
       $date = Carbon::now()->toDateString();
       // Get 2 last digit of year snd put point
       $year = substr($date, 2, 2) ;
       $month = substr($date, 5, 2);
       // Get id using year month and 001
       $id = $year.'.'.$month.'.'.'001';
       // Get last id
       $lastId = Membership::select('id')->orderBy('id', 'desc')->first();
       // Check if last id is not null
       if($lastId != null)
       {
           // Get last id
           $lastId = $lastId->id;
           // Get 4 digit of last id
           $lastId = substr($lastId, 4, 4);
              // Add 1 to last id
              $lastId = $lastId + 1;
           // Add 0 if last id < 10
           if($lastId < 10)
           {
               $id = $year . $month . '00' . $lastId;
           }
           // Add 0 if last id < 100
           elseif($lastId < 100)
           {
               $id = $year . $month . '0' . $lastId;
           }
           else
           {
               $id = $year . $month . $lastId;
           }
       }
         // Add id to request
            $request->request->add(['id' => $id]);
        // Generate start date and end date
        $start_date = Carbon::now()->toDateString();
        // Add 1 year to start date
        $end_date = Carbon::now()->addYear()->toDateString();
       // Add start date and end date to request
        $request->request->add(['membership_start_date' => $start_date]);
        $request->request->add(['membership_end_date' => $end_date]);
        $request->request->add(['membership_fee' => 3000000]);
        //dd($request->all());
            $request->validate([
                'id' => 'required',
                'id_member' => 'required',
                'status_membership' => 'required',
                'membership_start_date' => 'required',
                'membership_end_date' => 'required',
                'membership_fee' => 'required',
                'membership_payment_method' => 'required',
                'membership_payment_status' => 'required',
                
            ]);
            Membership::create($request->all());
            return redirect()->route('membership.index')
                ->with('success', 'Membership created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function card($id)
    {
        $memberships = Membership::find($id);
        $members = Member::find($memberships->id_member);
        $pdf = PDF::loadview('transaction.membership.card', ['memberships' => $memberships, 'members' => $members]);
        return $pdf->download('membership-card.pdf');
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
        $request ->validate([
            'id' => 'required',
            'id_member' => 'required',
            'status_membership' => 'required',
            'membership_start_date' => 'required',
            'membership_end_date' => 'required',
            'membership_fee' => 'required',
            'membership_payment_method' => 'required',
            'membership_payment_status' => 'required',
            
        ]);


        $memberships = Membership::find($id);
        $memberships->update($request->all());
        return redirect()->route('membership.index')->with('success', 'Membership berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        
       $memberships = Membership::find($id);
       $memberships->delete();
       return redirect()->route('membership.index')->with('success', 'Membership berhasil dihapus');
    }
}
