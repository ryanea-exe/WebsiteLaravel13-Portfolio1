<?php

namespace App\Http\Controllers\api;

use App\Models\Education;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('id', 'desc')->get();
        return response()->json([
            'educations' => $educations,
        ], 200);
    }

    public function store (Request $request)
    {
        $education = new Education();
        $education->institution = $request->institution;
        $education->period = $request->period;
        $education->degree = $request->degree;
        $education->departement = $request->departement;
        $education->save();
    }

    public function update (Request $request, $id)
    {
        $education = Education::find($id);
        $education->institution = $request->institution;
        $education->period = $request->period;
        $education->degree = $request->degree;
        $education->departement = $request->departement;
        $education->save();
    }

    public function destroy($id)
    {
        $education = Education::find($id);
        $education->delete();
    }
}
