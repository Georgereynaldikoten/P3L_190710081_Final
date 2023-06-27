<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PDF;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $members = Member::OrderBy('id', 'desc')->paginate(5);
         return view('member.index', compact('members'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $members = DB::table('members')->where('member_name', 'like', '%' . $search . '%')->paginate(5);
        if($members->isEmpty())
        {
            return redirect()->route('member.index')->with('error', 'Data tidak ditemukan');
    }else{
        return view('member.index', ['members' => $members]);
    }
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
        $lastId = Member::select('id')->orderBy('id', 'desc')->first();
        // Check if last id is not null
        if($lastId != null)
        {
            // Get last id
            $lastId = $lastId->id;
            // Get 4 digit of last id
            $lastId = substr($lastId, 4, 4);
            // Increment last id
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
        // Add birth date to request
        $request->request->add(['member_birth_date' => Carbon::parse($request->member_birth_date)->format('Y-m-d')]);
        
        $request->validate([
            'id' => 'required',
            'member_name' => 'required',
            'member_status' => 'required',
            'member_address' => 'required',
            'member_gender' => 'required',
            'member_phone_number' => 'required',
            'member_birth_date' => 'required',
            'member_email' => 'required',
           ]);
        //dd($request->all());

        
        // request password from request birth date
        $request->request->add(['member_password' => Carbon::parse($request->member_birth_date)->format('dmY')]);
        //dd($request->all());
        $user = new User;
        $user->name = $request->member_name;
        $user->email = $request->member_email;
        $user->password = bcrypt($request->member_password);
        $user->level = "member";
        $user->save();

        //   Add id user to table member
        $request->request->add(['id_user' => $user->id]);
        $request->request->add(['member_password' => Carbon::parse($request->member_birth_date)->format('dmY')]);
        $member = Member::create($request->all());
        return redirect()->route('member.index')->with('success', 'Member has been added');       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $member = Member::find($id);
        return view('member.index', compact('member'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->request->add(['member_birth_date' => Carbon::parse($request->member_birth_date)->format('dmY')]);
        $request->request->add(['member_password' => Carbon::parse($request->member_birth_date)->format('dmY')]);
        $request->validate([
            'id' => 'required',
            'id_user' => 'required',
            'member_name' => 'required',
            'member_status' => 'required',
            'member_address' => 'required',
            'member_gender' => 'required',
            'member_birth_date' => 'required',
            'member_phone_number' => 'required',
            'member_email' => 'required',
            'member_password' => 'required',
           ]);
        //    Find user by id
        $user = User::find($request->id_user);
        //    Update user
        $user->name = $request->member_name;
        $user->email = $request->member_email;
        $user->password = bcrypt($request->member_password);
        $user->level = "member";
        $user->save();
        //    Find member by id
        $member = Member::find($id);
        //    Update member
        $member->update($request->all());
        return redirect()->route('member.index')->with('success', 'Member has been updated');
    }

    public function card(Request $request, $id)
    {
        //dd($id);
        $data = Member::find($id);
        // share data to view
        view()->share('member.card', $data);
        $generatePDF = PDF::loadView('member.card', compact('data'));
        return $generatePDF->download('member-card.pdf');

    }

    public function resetPassword(Request $request, $id)
    {
       
        $request->validate([
            'id' => 'required',
            'id_user' => 'required',
            'member_password' => 'required',
        ]);
        //dd($request->all());
        $user = User::find($request->id_user);
        $user->password = bcrypt($request->member_password);
        $user->save();

        $member = Member::find($id);
        $member->member_password = bcrypt($request->member_password);
        $member->save();
        return redirect()->route('member.index')->with('success', 'Member password has been reset');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $member = Member::find($id);
        $user = User::find($member->id_user);
        $member->delete();
        $user->delete();
        return redirect()->route('member.index')->with('success', 'Member has been deleted');

    }
}
