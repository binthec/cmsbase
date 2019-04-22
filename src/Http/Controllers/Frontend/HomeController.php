<?php

namespace Binthec\CmsBase\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Binthec\CmsBase\Models\Topimage;
use Binthec\CmsBase\Models\Activity;
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
        $topimages = Topimage::open()->get();
        $activities = Activity::open()->take(4)->get();
        $events = Event::getAllEvents();
        return view('cmsbase::frontend.home', compact('topimages', 'activities', 'events'));
    }

}
