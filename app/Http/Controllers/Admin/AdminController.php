<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdminEmailSesetPassword;
use App\Models\Admin;
use App\Models\Commune;
use App\Models\Etablissement;
use App\Models\MaterialInformatique;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\View;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.admin_login');
    }
    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin_dashboard')->with('success', 'Admin LogIn seccessufuly');
        }
        return redirect()->route('login_form')->with('error', 'Invalid Credentials');
    }
    public function dashboard()
    {
        $communes = Commune::with('etablissements')
            ->orderBy('nomcommune_FR')
            ->get();
        $etablissements = Etablissement::with('materialInformatiques')->get();
        $materielInformatiques = MaterialInformatique::all();
        return view('admin.dashboard', compact('communes', 'etablissements', 'materielInformatiques'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error', 'Logout Seccessufully');
    }

    public function forget_password()
    {
        return view("admin.forget_password");
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Admin not found']);
        }

        $token = Str::random(60);

        $admin->forceFill([
            'remember_token' => $token,
        ])->save();

        // Send the password reset email
        Mail::to($admin->email)->send(new AdminEmailSesetPassword($token));

        return back()->with('status', 'Password reset link has been sent to your email.');
    }
    public function reset_password_form($token)
    {

        $admin = Admin::where('remember_token', $token)->firstOrFail();
        $email = $admin->email;
        if (!$admin) {
            return redirect()->route('login_form')->with('error', 'Invalid Token or Email');
        }
        return view('admin.reset_password_form', compact('token', 'email'));
    }
    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'], // Ensure password confirmation
            'token' => ['required'], // Ensure token is present
        ]);

        // Find the admin by email
        $admin = Admin::where('email', $request->email)->first();

        // Check if admin exists and token matches
        if ($admin && $admin->remember_token === $request->token) {
            // Set the new password hash
            $admin->password = Hash::make($request->password);
            $admin->setRememberToken(Str::random(60)); // Regenerate remember token

            // Save the updated admin
            $admin->save();

            // Dispatch the PasswordReset event
            event(new PasswordReset($admin));

            // Redirect to the login form with success message
            return redirect()->route('login_form')->with('status', __('Password has been reset successfully.'));
        }

        // Redirect back with error message if admin not found or token mismatch
        return back()->withErrors(['email' => __('Invalid email or token.')]);
    }
    public function fetchEtablissements($communeId)
    {
        $etablissements = Etablissement::where('code_Commune', $communeId)->pluck('nomEtabllissemnt_FR', 'code_Gresa');
        return response()->json($etablissements);
    }


    public function showMaterialInformatique($etablissementId)
    {
        $materialInformatiques = MaterialInformatique::where('code_Gresa', $etablissementId)->get();
        $communes = Commune::with('etablissements')->get();
        $etablissements = Etablissement::with('materialInformatiques')->get();
        $etablissementName = Etablissement::findOrFail($etablissementId);
        return view('admin.show_material_informatique', compact('materialInformatiques', 'communes', 'etablissements', 'etablissementName'));
    }


    public function showAddMaterialForm($etablissementId)
    {
        $etablissement = Etablissement::findOrFail($etablissementId);
        return view('admin.add_material_form', compact('etablissement'));
    }
    public function addMaterialSubmit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'etablissement_id' => 'required|string|exists:etablissements,code_Gresa',
            'Num_Inv' => 'required|string|unique:material_informatiques',
            'type' => 'required|string',
            'marque' => 'required|string',
            'dateDacquisition' => 'required|date',
            'EF' => 'required|date',
            'etat' => 'required|string',
            // Add validation rules for other material informatique properties
        ]);

        // Create a new material informatique record
        MaterialInformatique::create([
            'code_Gresa' => $request->etablissement_id,
            'Num_Inv' => $request->Num_Inv,
            'type' => $request->type,
            'marque' => $request->marque,
            'dateDacquisition' => $request->dateDacquisition,
            'EF' => $request->EF,
            'etat' => $request->etat,
            // Assign other material informatique properties from the form
        ]);
        // Redirect back with success message
        return redirect()->route('admin.show_material_informatique', ['etablissementId' => $request->etablissement_id]);
    }
    public function destroyMaterial($id)
    {
        $materialInformatique = MaterialInformatique::findOrFail($id);
        $materialInformatique->delete();

        return response()->json(['message' => 'Material informatique deleted successfully']);
    }
    public function editMaterial($Num_Inv, $code_Gresa)
    {
        // Assuming $code_Gresa is used to retrieve the etablissement details
        $etablissement = Etablissement::where('code_Gresa', $code_Gresa)->firstOrFail();

        // Assuming $Num_Inv is used to retrieve the material informatique details
        $materialInformatique = MaterialInformatique::where('Num_Inv', $Num_Inv)->firstOrFail();

        return view('admin.material-informatique-edit', compact('materialInformatique', 'etablissement'));
    }


    public function updateMaterialSubmit(Request $request, $Num_Inv)
    {
        $request->validate([
            'type' => 'required|string',
            'marque' => 'required|string',
            'dateDacquisition' => 'required|date',
            'EF' => 'required|date',
            'etat' => 'required|string',
        ]);

        $materialInformatique = MaterialInformatique::findOrFail($Num_Inv);
        $materialInformatique->update($request->all());
        return redirect()->route('admin.show_material_informatique', ['etablissementId' => $request->code_Gresa]);
    }
    public function back()
    {
        return redirect()->back();
    }


    public function downloadPdf(Request $request)
    {
        // Find the etablissement by ID
        $etablissement = Etablissement::findOrFail($request->code_Gresa);

        // Fetch material informatiques that belong to the etablissement
        $materialInformatiques = MaterialInformatique::where('code_Gresa', $etablissement->code_Gresa)->get();

        // Pass the data to the PDF view
        $data = [
            'materialInformatiques' => $materialInformatiques,
            'etablissementName' => $etablissement->nomEtabllissemnt_FR,
        ];

        // Generate PDF
        $pdf = new Dompdf();
        $html = View::make('pdf.material_informatique', $data)->render();
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        // Download the PDF
        return $pdf->stream('material_informatique.pdf');
    }
}
