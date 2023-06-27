<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructurePresentController extends Controller
{
   function index()
   {
       return view('instructure_present.index');
   }

   
}
