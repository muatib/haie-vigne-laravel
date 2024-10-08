<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Form;
use App\Models\SliderImage;
use App\Models\Activity;
class AdminController extends Controller
{
    public function index()
{
    $users = [];
    $forms = [];
    $images = [];

    try {
        $users = User::all();
    } catch (\Exception $e) {
        Log::error('Erreur lors de la récupération des utilisateurs: ' . $e->getMessage());
    }

    try {
        $forms = Form::all();
    } catch (\Exception $e) {
        Log::error('Erreur lors de la récupération des formulaires: ' . $e->getMessage());
    }

    try {
        $images = SliderImage::all();

        $images = $images->map(function ($image) {
            $image->full_path = 'data:image/png;base64,' . base64_encode($image->image_data);
            return $image;
        });
    } catch (\Exception $e) {
        Log::error('Erreur lors de la récupération des images: ' . $e->getMessage());
    }

    return view('dashboard', compact('users', 'forms', 'images'));
}

    public function filterUsersByCourse(Request $request)
    {
        $course = $request->get('course');

        if (!empty($course)) {
            $filteredUsers = User::whereHas('form', function ($query) use ($course) {
                $query->where('courses', 'like', '%' . $course . '%');
            })->with('form')->get();
        } else {

            $filteredUsers = [];
            return redirect()->route('dashboard')->with('error', 'Veuillez sélectionner un cours pour exporter.');
        }

        return view('dashboard', compact('filteredUsers', 'course'));
    }

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


    public function updateActivities(Request $request)
{
    try {

        $activities = $request->input('activities');

        foreach ($activities as $index => $activity) {

            $activityModel = Activity::find($index + 1);
            if ($activityModel) {
                $activityModel->title = $activity['title'];
                $activityModel->description = $activity['description'];
                $activityModel->location = $activity['location'];
                $activityModel->schedule = $activity['schedule'];
                $activityModel->coach = $activity['coach'];
                $activityModel->additional_line1 = $activity['additional_line1'];
                $activityModel->additional_line2 = $activity['additional_line2'];
                $activityModel->save();
            }
        }

        return redirect()->route('dashboard')->with('success', 'Activités mises à jour avec succès');
    } catch (\Exception $e) {
        return redirect()->route('dashboard')->with('error', 'Erreur lors de la mise à jour des activités');
    }
}





}
