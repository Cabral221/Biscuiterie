<?php

namespace App\Http\Controllers\Admin;

use App\Models\Domain;
use App\Models\SubDomain;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SubDomainController extends Controller
{
    /**
    * Store a sub domain on database
    *
    * @param Request $request
    * @return RedirectResponse
    */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'sub_domain_domain' => ['required', 'numeric'],    
            'sub_domain_libele' => ['required', 'string', 'min:2'],
        ]);

        /** @var Domain */
        $domain = Domain::findOrFail($request->sub_domain_domain);

        $domain->sub_domains()->create([
            'libele' => $request->sub_domain_libele,
        ]);

        return redirect()->route('admin.domains.index')->with('success', 'Le sous domain a été crée avec succés !');
    }

    /**
     * Delete the sub Domain on database
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function destroy(int $id) : RedirectResponse
    {
        /** @var SubDomain */
        $subdomain = SubDomain::findOrFail($id);
        $subdomain->delete();

        return redirect()->route('admin.domains.index')->with('success', 'Le sous domaine a été supprimé avec succés ');
    }
}