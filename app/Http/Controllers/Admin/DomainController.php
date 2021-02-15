<?php
namespace App\Http\Controllers\Admin;

use App\Models\Domain;
use App\Models\Niveau;
use App\Models\Program;
use App\Models\SubDomain;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DomainController extends Controller
{

    /**
     * Home of domaine page index
     *
     * @return View
     */
    public function index () : View
    {
        // $niveaux = Niveau::all();
        // $domains = Domain::all();
        $programs = Program::with('domains')->with('domains.sub_domains')->get();
        return view('admin.domains.index', compact('programs'));
    }

    /**
     * Record one domain on database table
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'program' => ['required', 'numeric'],
            'libele' => ['required', 'string', 'min:2'],
        ]);
        
        Domain::create([
            'program_id' => $request->program,
            'libele' => $request->libele,
        ]);
        
        return redirect()->route('admin.domains.index')->with('success', 'Votre domaine a été ajouté avec succés');
    }

    /**
     * Record one domain on database table
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeSubDomain(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'sub_domain_domain' => ['required', 'numeric'],
            'sub_domain_libele' => ['required', 'string', 'min:2'],
        ]);
        // dd($request->all());
        SubDomain::create([
            'domain_id' => $request->sub_domain_domain,
            'libele' => $request->sub_domain_libele,
        ]);

        return redirect()->route('admin.programs.index')->with('success', 'Le sous domaine a été ajouté avec succés');
    }

    public function update(Request $request, int $id) : RedirectResponse
    {
        $this->validate($request, [
            'program' => ['required', 'numeric'],
            'libele' => ['required', 'string', 'min:2'],
        ]);
        $domain = Domain::findOrFail($id);
        $domain->update([
            'libele' => $request->libele,
            'program_id' => $request->program,
        ]);

        return redirect()->route('admin.domains.index')->with('success', 'Le domaine a été modifié avec succés');
    }

    public function destroy(int $id) : RedirectResponse
    {
        $domain = Domain::findOrFail($id);
        $domain->delete();

        return redirect()->route('admin.domains.index')->with('success', 'Le domaine a été supprimé avec succés ');
    }
    
}