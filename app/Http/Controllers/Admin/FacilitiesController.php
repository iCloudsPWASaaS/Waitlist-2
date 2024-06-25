<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\FacilityDetails;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;


class FacilitiesController extends Controller
{
    public function facilities(){
        $data['facilities'] = Facility::latest()->get();
        return view('admin.facilities.index', $data);
    }

    public function facilitiesCreate(){
        $languages = Language::all();
        return view('admin.facilities.create', compact('languages'));
    }

    public function FacilitiesStore(Request $request, $language){
        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));

        $rules = [
            'title.*' => 'required|max:191',
        ];

        $message = [
            'title.*.required' => 'Title Field is required',
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $Facility = new Facility();

        if ($request->has('status')){
            $Facility->status = $request->status;
        }
        $Facility->save();

        return back()->with('success', __('Facility Successfully Saved'));
    }

    public function FacilitiesEdit($id)
    {
        $data['languages']      = Language::all();
        $data['FacilityDetails'] = FacilityDetails::with('Facility')->where('Facility_id', $id)->get()->groupBy('language_id');
        return view('admin.Facilities.edit', $data, compact('id'));
    }

    public function FacilitiesUpdate(Request $request, $id, $language_id){

        $purifiedData = Purify::clean($request->except('image', '_token', '_method'));

        $rules = [
            'title.*' => 'required|max:191',
            'icon' => 'sometimes|required|max:100',
        ];

        $message = [
            'title.*.required' => 'Title field is required',
            'icon.required' => 'Icon field is required',
        ];

        $validate = Validator::make($purifiedData, $rules, $message);

        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $Facility = Facility::findOrFail($id);
        if ($request->has('status')){
            $Facility->icon = $request->icon;
            $Facility->status = $request->status;
        }

        $Facility->save();

        $Facility->details()->updateOrCreate([
            'language_id' => $language_id
        ],
            [
                'title' => $purifiedData["title"][$language_id],
            ]
        );

        return back()->with('success', __('Facilities Successfully Updated'));
    }
}
