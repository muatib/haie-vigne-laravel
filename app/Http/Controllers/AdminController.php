<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Form;
use App\Models\SliderImage;
use App\Models\Activity;
use App\Models\SliderImage2;
use App\Models\Actuality;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = [];
        $forms = [];
        $images = [];
        $actualities = [];

        try {
            $users = User::all();
        } catch (\Exception $e) {
            Log::error('Error while retrieving users: ' . $e->getMessage());
        }

        try {
            $forms = Form::all();
        } catch (\Exception $e) {
            Log::error('Error while retrieving forms: ' . $e->getMessage());
        }

        try {
            $images = Activity::with('image')->orderBy('id', 'asc')->get();

            $images = $images->map(function ($activity) {
                $activity->image->full_path = 'data:image/png;base64,' . base64_encode($activity->image->image_data);
                return $activity;
            });
        } catch (\Exception $e) {
            Log::error('Error while retrieving activities: ' . $e->getMessage());
        }

        try {
            $actualities = Actuality::with('image')->orderBy('id', 'asc')->get();

            $actualities = $actualities->map(function ($actuality) {
                $actuality->image->full_path = 'data:image/png;base64,' . base64_encode($actuality->image->image_data);
                return $actuality;
            });
        } catch (\Exception $e) {
            Log::error('Error while retrieving actualities: ' . $e->getMessage());
        }

        return view('dashboard', compact('users', 'forms', 'images', 'actualities'));
    }

    public function filterUsersByCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $course = $request->get('course');

        $filteredUsers = User::whereHas('form', function ($query) use ($course) {
            $query->where('courses', 'like', '%' . $course . '%');
        })->with('form')->get();

        if ($request->ajax()) {
            return view('partials.filtered_users', compact('filteredUsers', 'course'))->render();
        }

        return view('dashboard', compact('filteredUsers', 'course'));
    }

    public function exportUsersByCourse($course)
    {
        $validator = Validator::make(['course' => $course], [
            'course' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')->withErrors($validator);
        }

        $filteredUsers = User::whereHas('form', function ($query) use ($course) {
            $query->where('courses', 'like', '%' . $course . '%');
        })->with('form')->get();

        $csvFileName = 'users_' . $course . '.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Nom', 'Prénom', 'Téléphone');

        $callback = function () use ($filteredUsers, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($filteredUsers as $user) {
                fputcsv($file, array($user->lastname, $user->firstname, $user->form->phone ?? 'N/A'));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function showDashboard()
    {
        $activities = Activity::with('image')->orderBy('id', 'asc')->get();
        $actualities = Actuality::with('image')->orderBy('id', 'asc')->get();

        return view('dashboard', [
            'images' => $activities,
            'actualities' => $actualities
        ]);
    }

    public function updateActivities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activities' => 'required|array',
            'activities.*.id' => 'required|exists:activities,id',
            'activities.*.title' => 'sometimes|string|max:255',
            'activities.*.description' => 'sometimes|string',
            'activities.*.location' => 'sometimes|string|max:255',
            'activities.*.schedule' => 'sometimes|string',
            'activities.*.coach' => 'sometimes|string',
            'activities.*.additional_line1' => 'sometimes|string|max:255',
            'activities.*.additional_line2' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')->withErrors($validator)->withInput();
        }

        try {
            $activitiesData = $request->input('activities');

            foreach ($activitiesData as $activityData) {
                $activity = Activity::findOrFail($activityData['id']);
                $activity->update(array_filter($activityData, function ($key) {
                    return in_array($key, ['title', 'description', 'location', 'schedule', 'coach', 'additional_line1', 'additional_line2']);
                }, ARRAY_FILTER_USE_KEY));
            }

            return redirect()->route('dashboard')->with('success', 'Activities updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating activities: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'An error occurred while updating activities.');
        }
    }

    public function updateSliderImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            foreach ($request->file('images') as $id => $image) {
                $sliderImage = SliderImage::findOrFail($id);
                $sliderImage->image_data = file_get_contents($image->getRealPath());
                $sliderImage->image_path = $image->getClientOriginalName();
                $sliderImage->save();
            }
            return redirect()->back()->with('success', 'Images mises à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Error updating slider images: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour des images.');
        }
    }

    public function updateActualities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'actualities' => 'required|array',
            'actualities.*.id' => 'required|exists:actualities,id',
            'actualities.*.title' => 'sometimes|string|max:255',
            'actualities.*.description' => 'sometimes|string',
            'actualities.*.location' => 'sometimes|string|max:255',
            'actualities.*.additional_info_1' => 'sometimes|string|max:255',
            'actualities.*.additional_info_2' => 'sometimes|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dashboard')->withErrors($validator)->withInput();
        }

        try {
            $actualitiesData = $request->input('actualities');

            foreach ($actualitiesData as $actualityData) {
                $actuality = Actuality::findOrFail($actualityData['id']);
                $actuality->update(array_filter($actualityData, function ($key) {
                    return in_array($key, ['title', 'description', 'location', 'additional_info_1', 'additional_info_2']);
                }, ARRAY_FILTER_USE_KEY));
            }

            return redirect()->route('dashboard')->with('success', 'Actualities updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating actualities: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'An error occurred while updating actualities.');
        }
    }

    public function updateSliderImages2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'images2' => 'required|array',
            'images2.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            foreach ($request->file('images2') as $id => $image) {
                $sliderImage = SliderImage2::findOrFail($id);
                $sliderImage->image_data = file_get_contents($image->getRealPath());
                $sliderImage->image_path = $image->getClientOriginalName();
                $sliderImage->save();
            }
            return redirect()->back()->with('success', 'Images des actualités mises à jour avec succès.');
        } catch (\Exception $e) {
            Log::error('Error updating slider images 2: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour des images des actualités.');
        }
    }
}
