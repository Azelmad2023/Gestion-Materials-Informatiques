<?php

namespace App\Http\Controllers\Etablissement;

use App\Http\Controllers\Controller;
use App\Mail\AdminEmailSesetPassword;
use App\Mail\EtablissementResetPassword;
use App\Models\Commune;
use App\Models\Etablissement;
use App\Models\MaterialInformatique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\PasswordReset;




class EtablissementController extends Controller
{

    // Etablissements Auth Actions
    public function login()
    {
        return view('Etablissement.etablissement_login');
    }
    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::guard('etablissement')->attempt($credentials)) {
            // Fetch the authenticated etablissement
            $etablissement = Auth::guard('etablissement')->user();

            // Fetch the associated material informatiques using the relationship
            $materialInformatiques = $etablissement->materialInformatiques;

            // Pass the etablissement and material informatiques data to the dashboard view
            return view('Etablissement.dashboard', compact('etablissement', 'materialInformatiques'));
        }

        return redirect()->route('etablissement_login_form')->with('error', 'Invalid Credentials');
    }


    public function dashboard()
    {
        return view('Etablissement.dashboard');
    }
    public function logout()
    {
        Auth::guard('etablissement')->logout();
        return redirect()->route('etablissement_login_form')->with('error', 'Logout Seccessufully');
    }


    public function forget_password()
    {
        return view("Etablissement.forget_password");
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $etablissement = Etablissement::where('email', $request->email)->first();

        if (!$etablissement) {
            return back()->withErrors(['email' => 'Etablissement not found']);
        }

        $token = Str::random(60);

        $etablissement->forceFill([
            'remember_token' => $token,
        ])->save();

        // Send the password reset email
        Mail::to($etablissement->email)->send(new EtablissementResetPassword($token));

        return back()->with('status', 'Password reset link has been sent to your email.');
    }
    public function reset_password_form($token)
    {

        $etablissement = Etablissement::where('remember_token', $token)->firstOrFail();
        $email = $etablissement->email;
        if (!$etablissement) {
            return redirect()->route('etablissement_login_form')->with('error', 'Invalid Token or Email');
        }
        return view('Etablissement.reset_password_form', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'], // Ensure password confirmation
            'token' => ['required'], // Ensure token is present
        ]);

        // Find the admin by email
        $etablissement = Etablissement::where('email', $request->email)->first();

        // Check if admin exists and token matches
        if ($etablissement && $etablissement->remember_token === $request->token) {
            // Set the new password hash
            $etablissement->password = Hash::make($request->password);
            $etablissement->setRememberToken(Str::random(60)); // Regenerate remember token

            // Save the updated etablissement
            $etablissement->save();

            // Dispatch the PasswordReset event
            event(new PasswordReset($etablissement));

            // Redirect to the login form with success message
            return redirect()->route('etablissement_login_form')->with('status', __('Password has been reset successfully.'));
        }

        // Redirect back with error message if admin not found or token mismatch
        return back()->withErrors(['email' => __('Invalid email or token.')]);
    }
    // Login Process End
    public function show_etablissements()
    {
        // Retrieve all etablissements from the database
        $etablissements = Etablissement::all();
        // Pass the etablissements data to the view
        return view('admin.EtablissementsManagement.show_etablissements', compact('etablissements'));
    }

    public function add_etablissement_form()
    {
        $communes = Commune::all();
        return view('admin.EtablissementsManagement.add-etablissement-form', compact('communes'));
    }
    public function add_etablissement_submit(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'code_Gresa' => 'required|string|unique:etablissements',
            'nomEtabllissemnt_AR' => 'required|string',
            'nomEtabllissemnt_FR' => 'required|string',
            'email' => 'required|email|unique:etablissements',
            'cycle' => 'required|string',
            'password' => 'required|string',
            'code_Commune' => 'required|string|exists:communes,code_Commune',
        ]);

        // Hash the password
        $hashedPassword = Hash::make($request->password);

        // Create a new etablissement record
        Etablissement::create([
            'code_Gresa' => $request->code_Gresa,
            'nomEtabllissemnt_AR' => $request->nomEtabllissemnt_AR,
            'nomEtabllissemnt_FR' => $request->nomEtabllissemnt_FR,
            'email' => $request->email,
            'cycle' => $request->cycle,
            'password' => $hashedPassword,
            'code_Commune' => $request->code_Commune,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.show_etablissements')->with('success', 'Etablissement added successfully.');
    }

    public function edit_etablissement($code_Gresa)
    {
        $etablissement = Etablissement::where('code_Gresa', $code_Gresa)->firstOrFail();
        $communes = Commune::all();
        return view('admin.EtablissementsManagement.etablissement-edit', compact('etablissement', 'communes'));
    }
    public function edit_etablissement_submit(Request $request, $code_Gresa)
    {
        $request->validate([
            'code_Gresa' => 'required|string',
            'nomEtabllissemnt_FR' => 'required|string',
            'nomEtabllissemnt_AR' => 'required|string',
            'email' => 'required|email',
            'cycle' => 'required|string',
            'password' => 'required|string',
            'code_Commune' => 'required|string|exists:communes,code_Commune',
        ]);

        $etablissement = Etablissement::findOrFail($code_Gresa);

        // Hash the new password before updating
        $hashedPassword = bcrypt($request->password);

        $etablissement->update([
            'code_Gresa' => $request->code_Gresa,
            'nomEtabllissemnt_FR' => $request->nomEtabllissemnt_FR,
            'nomEtabllissemnt_AR' => $request->nomEtabllissemnt_AR,
            'email' => $request->email,
            'cycle' => $request->cycle,
            'password' => $hashedPassword, // Update with the hashed password
            'code_Commune' => $request->code_Commune,
        ]);

        return redirect()->route('admin.show_etablissements')->with('success', 'Etablissement updated successfully');
    }

    public function destroy_etablissement($code_Gresa)
    {
        $etablissement = Etablissement::findOrFail($code_Gresa);
        $etablissement->delete();

        return response()->json(['message' => 'Etablissement deleted successfully']);
    }
}


   // public function forget_password()
    // {
    //     return view("admin.forget_password");
    // }

    // public function forget_password_submit(Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //     ]);

    //     $admin = Admin::where('email', $request->email)->first();

    //     if (!$admin) {
    //         return back()->withErrors(['email' => 'Admin not found']);
    //     }

    //     $token = Str::random(60);

    //     $admin->forceFill([
    //         'remember_token' => $token,
    //     ])->save();

    //     // Send the password reset email
    //     Mail::to($admin->email)->send(new AdminEmailSesetPassword($token));

    //     return back()->with('status', 'Password reset link has been sent to your email.');
    // }
    // public function reset_password_form($token)
    // {

    //     $admin = Admin::where('remember_token', $token)->firstOrFail();
    //     $email = $admin->email;
    //     if (!$admin) {
    //         return redirect()->route('login_form')->with('error', 'Invalid Token or Email');
    //     }
    //     return view('admin.reset_password_form', compact('token', 'email'));
    // }
    // public function reset_password_submit(Request $request)
    // {
    //     $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required', 'confirmed', 'min:8'], // Ensure password confirmation
    //         'token' => ['required'], // Ensure token is present
    //     ]);

    //     // Find the admin by email
    //     $admin = Admin::where('email', $request->email)->first();

    //     // Check if admin exists and token matches
    //     if ($admin && $admin->remember_token === $request->token) {
    //         // Set the new password hash
    //         $admin->password = Hash::make($request->password);
    //         $admin->setRememberToken(Str::random(60)); // Regenerate remember token

    //         // Save the updated admin
    //         $admin->save();

    //         // Dispatch the PasswordReset event
    //         event(new PasswordReset($admin));

    //         // Redirect to the login form with success message
    //         return redirect()->route('login_form')->with('status', __('Password has been reset successfully.'));
    //     }

    //     // Redirect back with error message if admin not found or token mismatch
    //     return back()->withErrors(['email' => __('Invalid email or token.')]);
    // }


    // Etablissements End Auth Actions
