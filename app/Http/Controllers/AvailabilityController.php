<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Category;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Symfony\Component\Clock\DatePoint;

class AvailabilityController extends Controller
{
    public function index(Request $request)
    {   
        $category_id = $request->query('category_id', '');
        // Get the date from the request or default to today's date
        $currentDate = $request->query('date', Carbon::now()->format('Y-m-d'));

        // Calculate the start and end dates for the 3-day range
        $startDate = Carbon::parse($currentDate)->startOfDay();
        $endDate = $startDate->copy()->addDays(3);

        // Calculate previous and next dates
        $previousDate = $startDate->copy()->subDays(3)->format('Y-m-d');
        $nextDate = $startDate->copy()->addDays(3)->format('Y-m-d');

        // Fetch availabilities for the 3-day range
        $availabilitiesData = Availability::whereBetween('date', [$startDate, $endDate])->get();
        

        if(!empty($category_id)){
            $availabilitiesData = Availability::with('category')
            ->whereBetween('date', [$startDate, $endDate])
            ->where('category_id',$category_id)
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->groupBy('date');
        }else{
            $availabilitiesData = Availability::with('category')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date')
            ->orderBy('start_time')
            ->get()
            ->groupBy('date');
        }
        // Fetch availabilities for the period
        
       
        $categories = Category::all();
    
        $interval = new DateInterval('P1D');

        
        $period = new DatePeriod(new DateTime($startDate), $interval, new DateTime($endDate));
        $availabilities = [];
        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $availabilities[$formattedDate] = $availabilitiesData->get($formattedDate, []);
        }
        return view('availabilities.check', compact('availabilities', 'categories', 'previousDate', 'nextDate', 'currentDate','period','category_id'));
    }

    public function createAvailabilityView()
    {
        $categories = Category::all();
        // Fetch availabilities for the 3-day range
        $availabilities = Availability::all();
        return view('availabilities.create', compact('categories','availabilities'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'interval' => 'required|integer|min:1',
        ]);

        // Check for overlapping availability
        $overlapping = Availability::where('category_id', $request->category_id)
            ->whereDate('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('start_time', '<=', $request->start_time)
                                ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->exists();

        if ($overlapping) {
            return redirect()->route('create-availabilities')->withErrors(['date' => 'The selected time slot overlaps with an existing availability.',
        ]);
        }

        // Store the new availability
        Availability::create($request->all());

        return redirect()->route('create-availabilities')->with('success', 'Availability created successfully.');
    }

}
