<?php

namespace App\Http\Controllers\Commune;

use App\Http\Controllers\Controller;
use App\Models\Commune;
use Illuminate\Http\Request;

class CommuneController extends Controller
{
    public function show_communes()
    {
        // Retrieve all communes from the database
        $communes = Commune::all();
        // Pass the communes data to the view
        return view('admin.show_communes', compact('communes'));
    }

    public function add_cummune_form()
    {
        return view('admin.add-comune-form');
    }
    public function add_cummune_submit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'code_Commune' => 'required|string|unique:communes',
            'nomcommune_AR' => 'required|string',
            'nomcommune_FR' => 'required|string',
            'code_Milieu' => 'required|integer',
        ]);

        // Create a new commune record
        Commune::create([
            'code_Commune' => $request->code_Commune,
            'nomcommune_AR' => $request->nomcommune_AR,
            'nomcommune_FR' => $request->nomcommune_FR,
            'code_Milieu' => $request->code_Milieu,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.show_communes')->with('success', 'Commune added successfully.');
    }

    public function editCommune($code_Commune)
    {
        $commune = Commune::where('code_Commune', $code_Commune)->firstOrFail();
        return view('admin.commune-edit', compact('commune'));
    }
    public function editCommuneSubmit(Request $request, $code_Commune)
    {
        $request->validate([
            'code_Commune' => 'required|string',
            'nomcommune_FR' => 'required|string',
            'nomcommune_AR' => 'required|string',
            'code_Milieu' => 'required|integer',
        ]);

        $commune = Commune::findOrFail($code_Commune);

        $commune->update([
            'code_Commune' => $request->code_Commune,
            'nomcommune_FR' => $request->nomcommune_FR,
            'nomcommune_AR' => $request->nomcommune_AR,
            'code_Milieu' => $request->code_Milieu,
        ]);
        return redirect()->route('admin.show_communes')->with('success', 'Commune updated successfully');
    }

    public function destroyCommune($code_Commune)
    {
        $commune = Commune::findOrFail($code_Commune);
        $commune->delete();

        return response()->json(['message' => 'Commune deleted successfully']);
    }
}
