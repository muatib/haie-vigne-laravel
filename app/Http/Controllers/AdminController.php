<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Form;
use App\Models\SliderImage;
use App\Models\Activity;
use App\Models\SliderImage2;
use App\Models\Actuality;
/**
 * Controller for handling administrative functions.
 */
class AdminController extends Controller
{
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
    /**
     * Filter users by course.
     *
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function filterUsersByCourse(Request $request)
    {
        $course = $request->get('course');

        if (!empty($course)) {
            $filteredUsers = User::whereHas('form', function ($query) use ($course) {
                $query->where('courses', 'like', '%' . $course . '%');
            })->with('form')->get();
        } else {
            $filteredUsers = [];
            return redirect()->route('dashboard')->with('error', 'Please select a course to export.');
        }

        return view('dashboard', compact('filteredUsers', 'course'));
    }

    /**
     * Export users by course to CSV.
     *
     * @param string $course
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function exportUsersByCourse($course)
    {
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

    /**
 * Show the dashboard with activities and actualities.
 *
 * @return \Illuminate\View\View
 */
public function showDashboard()
{
    $activities = Activity::with('image')->orderBy('id', 'asc')->get();
    $actualities = Actuality::with('image')->orderBy('id', 'asc')->get();

    return view('dashboard', [
        'images' => $activities,
        'actualities' => $actualities
    ]);
}

    /**
 * Update activities.
 *
 * @param Request $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function updateActivities(Request $request)
{
    try {
        $activitiesData = $request->input('activities');

        foreach ($activitiesData as $index => $activityData) {
            $activity = Activity::find($activityData['id']);

            if ($activity) {
                // Update only the fields that have been sent
                if (isset($activityData['title'])) $activity->title = $activityData['title'];
                if (isset($activityData['description'])) $activity->description = $activityData['description'];
                if (isset($activityData['location'])) $activity->location = $activityData['location'];
                if (isset($activityData['schedule'])) $activity->schedule = str_replace("\r\n", "\n", $activityData['schedule']);
                if (isset($activityData['coach'])) $activity->coach = str_replace("\r\n", "\n", $activityData['coach']);
                if (isset($activityData['additional_line1'])) $activity->additional_line1 = $activityData['additional_line1'];
                if (isset($activityData['additional_line2'])) $activity->additional_line2 = $activityData['additional_line2'];

                $activity->save();
            }
        }

        return redirect()->route('dashboard')->with('success', 'Activities updated successfully');
    } catch (\Exception $e) {
        return redirect()->route('dashboard')->with('error', 'Error updating activities: ' . $e->getMessage());
    }
}
public function updateSliderImages(Request $request)
{
    foreach ($request->file('images') as $id => $image) {
        $sliderImage = SliderImage::find($id);
        if ($sliderImage && $image) {
            $sliderImage->image_data = file_get_contents($image->getRealPath());
            $sliderImage->image_path = $image->getClientOriginalName();
            $sliderImage->save();
        }
    }
    return redirect()->back()->with('success', 'Images mises à jour avec succès.');
}

public function updateActualities(Request $request)
{
    try {
        $actualitiesData = $request->input('actualities');

        foreach ($actualitiesData as $index => $actualityData) {
            $actuality = Actuality::find($actualityData['id']);

            if ($actuality) {
                // Update only the fields that have been sent
                if (isset($actualityData['title'])) $actuality->title = $actualityData['title'];
                if (isset($actualityData['description'])) $actuality->description = $actualityData['description'];
                if (isset($actualityData['location'])) $actuality->location = $actualityData['location'];
                if (isset($actualityData['additional_info_1'])) $actuality->additional_info_1 = $actualityData['additional_info_1'];
                if (isset($actualityData['additional_info_2'])) $actuality->additional_info_2 = $actualityData['additional_info_2'];

                $actuality->save();
            }
        }

        return redirect()->route('dashboard')->with('success', 'Actualities updated successfully');
    } catch (\Exception $e) {
        return redirect()->route('dashboard')->with('error', 'Error updating actualities: ' . $e->getMessage());
    }
}

public function updateSliderImages2(Request $request)
{
    foreach ($request->file('images2') as $id => $image) {
        $sliderImage = SliderImage2::find($id);
        if ($sliderImage && $image) {
            $sliderImage->image_data = file_get_contents($image->getRealPath());
            $sliderImage->image_path = $image->getClientOriginalName();
            $sliderImage->save();
        }
    }
    return redirect()->back()->with('success', 'Images des actualités mises à jour avec succès.');
}
}
