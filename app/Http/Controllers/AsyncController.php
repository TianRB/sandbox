<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AsyncController extends Controller
{
  public function getView(Request $r)
  {
    Job::dispatch();
  }

}
