<?php

namespace App\Http\Controllers;
use App\Models\Instructure;
use App\Models\User;
use Illuminate\Http\Request;

class InstructureController extends Controller
{
   public function index()
   {
       $instructures = Instructure::OrderBy('id', 'asc')->paginate(5);

         return view('instructure.index', compact('instructures'));
   }

   public function search(Request $request)
   {
       $search = $request->get('search');
      
        // Search instructure by name
         $instructures = Instructure::where('instructure_name', 'like', '%'.$search.'%')->paginate(5);   
         if($instructures->isEmpty())
         {
             return redirect()->route('instructure.index')->with('error', 'Data tidak ditemukan');
        }else{
            return view('instructure.index', compact('instructures'));
        }
    }

   public function store(Request $request)
    {
        // Validate the request...
        // See all data request
        // dd($request->all());
        $request->validate([

         'instructure_name' => 'required|unique:instructures',
         'instructure_address' => 'required',
         'instructure_gender' => 'required',
         'instructure_birth_date' => 'required',
         'instructure_phone_number' => 'required',
         'count_instructure_present' => 'min:0|max:30',
         'instructure_email' => 'required|email|unique:instructures',
         'instructure_password' => 'required',
         'count_instructure_absent' => 'min:0|max:30',
        ]);
        

        
        $user = new User;
        $user->name = $request->instructure_name;
        $user->email = $request->instructure_email;
        $user->password = bcrypt($request->instructure_password);
        $user->level = "instructure";
        $user->save();
        
        
        //   Add id user to table instructure
        $request->request->add(['id_user' => $user->id]);
        
        $instructure = Instructure::create($request->all());
        return redirect()->route('instructure.index')->with('success', 'Data berhasil ditambahkan');

    }
    public function destroy($id)
    {
        $instructure = Instructure::find($id);
        $instructure->delete();
        return redirect()->route('instructure.index')->with('success', 'Data berhasil dihapus');
    }

    public function edit($id)
    {
        $instructure = Instructure::find($id);
        return view('instructure.edit', compact('instructure'));
    }
    public function update(Request $request, $id)
    {
       // dd($request->all());
       
        $request->validate([
            'id_user' => 'required',
            'instructure_name' => 'required',
            'instructure_address' => 'required',
            'instructure_gender' => 'required',
            'instructure_phone_number' => 'required',
            'count_instructure_present' => 'min:0|max:30',
            'instructure_email' => 'required|email|unique:instructures',
            'instructure_password' => 'required',
            'count_instructure_absent' => 'min:0|max:30',
           ]);
        //    Find User based on id
        $user = User::find($request->id_user);
        $user->name = $request->instructure_name;
        $user->email = $request->instructure_email;
        $user->password = bcrypt($request->instructure_password);
        $user->level = "instructure";
        $user->save();

        $instructure = Instructure::find($id);
        $instructure->update($request->all());
        return redirect()->route('instructure.index')->with('success', 'Data berhasil diupdate');
    }

    
        

    public function delete($id)
    {
        $instructure = Instructure::find($id);
        // Delete user based on id_user
        $user = User::find($instructure->id_user);
        $instructure->delete();
        $user->delete();
        return redirect()->route('instructure.index')->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        $instructure = Instructure::find($id);
        return view('instructure.index', compact('instructure'));
    }


}
