<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Association;
use App\Models\Group;
use App\Models\Diocese;
use App\Models\Media;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'persons' => Person::count(),
            'associations' => Association::count(),
            'groups' => Group::count(),
            'dioceses' => Diocese::count(),
            'media' => Media::count(),
        ];

        return view('dashboard', compact('stats'));
    }
}