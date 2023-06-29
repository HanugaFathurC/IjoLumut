<?php

namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Criteria;

class CriteriaController extends Controller
{
    public function index(){
        $criterias = Criteria::all();
        return view('backoffice.criteria.index', compact('criterias'));
    }

    public function edit(Criteria $criteria){
    return view('backoffice.criteria.edit', compact('criteria'));
    }

    public function update(Request $request, Criteria $criteria){
    $request->validate([
        'weight' => 'required|numeric|between:0,1',
    ]);

    $totalWeight = Criteria::sum('weight');

    $totalWeight -= $criteria->weight;
    $totalWeight += $request->weight;

    if ($totalWeight > 1) {
        return back()->with('toast_error','Total bobot kriteria melebihi 1. Silakan atur ulang bobot kriteria.');
    }

    if ($totalWeight < 0) {
        return back()->with('toast_error' ,'Total bobot kriteria kurang dari 0. Silakan atur ulang bobot kriteria.');
    }

    $criteria->update([
        'weight' => $request->weight,
    ]);

    return back()->with('toast_success', 'Bobot kriteria berhasil diperbarui');
}


}
