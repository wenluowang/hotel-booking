<?php

namespace HotelBooking\Http\Controllers\Admin;

use HotelBooking\Http\Controllers\Controller;

/**
 * AdminBaseController
 */

class AdminBaseController extends Controller
{
  public function index(){
    return view('admin.index');
  }
}