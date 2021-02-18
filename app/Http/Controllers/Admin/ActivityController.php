<?php

namespace App\Http\Controllers\Admin;

use App\Models\Domain;
use App\Models\SubDomain;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;

class ActivityController extends Controller
{

    /**
     * Store activity with polimorphic relation (Domain or SubDomain)
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'libele' => ['required', 'string', 'min:2'],
            'activitable_type' => ['required', 'string', Rule::in([Domain::class, SubDomain::class])],
            'activitable_id' => ['required', 'numeric'],
        ]);

        /** @var Domain|SubDomain */
        $activitable = $request->activitable_type::findorFail($request->activitable_id);
        $activitable->activities()->create([
            'libele' => $request->libele,
        ]);
       
        return redirect()->route('admin.domains.index')->with('success', 'La matière a été ajouter avec succés.');
    }

    /**
     * Delete one activity on resource database
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id) : RedirectResponse
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('admin.domains.index')->with('success', 'La matière a été supprimée avec succés.');
    }
}
