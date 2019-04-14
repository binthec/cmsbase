<?php

namespace Binthec\CmsBase\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Topimage;
use Binthec\CmsBase\Models\Activity;
//use App\Event;

class HomeController extends Controller
{

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
//        $topimages = Topimage::open()->get();
        $activities = Activity::open()->take(4)->get();
//	    $events = Event::getAllEvents();
//		return view('backend.dashboard', compact('topimages', 'activities', 'events'));
        return view('cmsbase::backend.dashboard', compact('topimages', 'activities', 'events'));
	}

}
