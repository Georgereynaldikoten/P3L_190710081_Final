<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\Member;
use App\Models\Classe;
use App\Models\Promo;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexdepositkelas()
    {
        //Deposit find by type
        $deposits = Deposit::where('deposit_type', 'Kelas')->paginate(5);
        return view('deposit.indexdepositkelas', ['deposits'=> Deposit::with('member', 'class', 'promo')->paginate(5)]);
        
    }

    public function indexdeposituang()  
    {
        //Deposit find by type
        $deposits = Deposit::where('deposit_type', 'Uang')->paginate(5);
        return view('transaction.deposit.indexdeposituang', ['deposits'=> Deposit::with('member', 'class', 'promo')->paginate(5)]);
        
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
    public function storedepositkelas(Request $request)
    {
        $request->validate([
            'deposit_type' => 'required',
            'deposit_amount' => 'required',
            'deposit_date' => 'required',
            'member_id' => 'required',
            'class_id' => 'required',
            'promo_id' => 'required',
        ]);

        Deposit::create($request->all());

        return redirect()->route('deposit.indexdepositkelas')
            ->with('success', 'Deposit created successfully.');
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
    public function destroy($id)
    {
        //
    }
}
