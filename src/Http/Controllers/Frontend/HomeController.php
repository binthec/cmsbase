<?php

namespace Binthec\CmsBase\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//use App\Topimage;
//use App\Activity;
use Binthec\CmsBase\Models\Event;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//	    $topimages = Topimage::open()->get();
//	    $activities = Activity::open()->take(4)->get();
        $events = Event::getAllEvents();
//		return view('frontend.home', compact('topimages', 'activities', 'events'));

        return view('cmsbase::frontend.home', compact('events'));
    }

}
