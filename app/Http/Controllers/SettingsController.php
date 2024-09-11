<?php

namespace App\Http\Controllers;

use App\Models\EmailSettings;
use App\Models\Review;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Settings::orderBy('id', 'desc')->first();
        $email_data = EmailSettings::orderBy('id', 'desc')->first();
        $dateFormats = [
            'Y-m-d' => 'YYYY-MM-DD',
            'm/d/Y' => 'MM/DD/YYYY',
            'd/m/Y' => 'DD/MM/YYYY',
            'd-m-Y' => 'DD-MM-YYYY',
            'm-d-Y' => 'MM-DD-YYYY',
            'Y/m/d' => 'YYYY/MM/DD',
            'd.m.Y' => 'DD.MM.YYYY',
            'M d, Y' => 'Month Day, Year',
            'l, F j, Y' => 'Day, Month Day, Year',
        ];

        return view('settings.index', compact('data', 'dateFormats', 'email_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('settings')->ignore($id),
            ],
            'company_name' => [
                'required',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s&\/\-_]*$/',
                Rule::unique('settings')->ignore($id),
            ],
            'gst_no' => [
                'required',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s&\/\-_]*$/',
                Rule::unique('settings')->ignore($id),
            ],
            'ph_no' => [
                'required',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s&\/\-_]*$/',
                Rule::unique('settings')->ignore($id),
            ],
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            // Add other rules as needed
        ];

        $messages = [
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address format is invalid.',
            'email.unique' => 'The email address must be unique.',
            'company_name.required' => 'The company name is required.',
            'company_name.unique' => 'The company name must be unique.',
            'gst_no.required' => 'The GST number is required.',
            'gst_no.unique' => 'The GST number must be unique.',
            'ph_no.required' => 'The phone number is required.',
            'ph_no.unique' => 'The phone number must be unique.',
            'company_logo.image' => 'The company logo must be an image.',
            'company_logo.mimes' => 'The company logo must be a file of type: jpeg, png, jpg.',
            'company_logo.max' => 'The company logo must not be larger than 2MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = Settings::find($id);
        if (!$data) {
            return response()->json(['message' => 'Settings not found.'], 404);
        }

        if ($request->hasFile('company_logo')) {
            $file = $request->file('company_logo');
            $filename = 'logo.jpg'; // Set filename as needed
            $path = public_path('assets/images/settings');

            // Create directory if it doesn't exist
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }

            // Store the file
            $filePath = $file->move($path, $filename);
            $data->logo_path = 'public/assets/images/settings/' . $filename;
        }

        // Update other fields
        $data->company_name = $request->company_name;
        $data->email = $request->email;
        $data->gst_no = $request->gst_no;
        $data->ph_no = $request->ph_no;
        $data->date_format = $request->date_format;
        $data->footer = $request->footer;
        $data->footer_url = $request->footer_url;
        $data->address = $request->address;
        $data->updated_by = Auth::id();
        $data->save();

        return response()->json([
            'message' => 'Settings updated successfully.',
            'data' => $data
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }

    public function email_update(Request $request, string $id)
    {
        // dd($id);
        $rules = [
            'mail_mailer' => 'required|string',
            'mail_host' => 'required|string',
            'mail_encryption' => 'required|in:TLS,SSL',
            'mail_port' => 'required|numeric',
            'mail_username' => 'required|string',
            'mail_from_address' => 'required|string',
            'mail_from_name' => 'required|string',
        ];

        $messages = [
            'mail_mailer.required' => 'The mail mailer is required.',
            'mail_host.required' => 'The mail host is required.',
            'mail_encryption.required' => 'The mail encryption is required.',
            'mail_port.required' => 'The mail port is required.',
            'mail_username.required' => 'The mail username is required.',
            'mail_password.required' => 'The mail password is required.',
            'mail_from_address.required' => 'The mail from address is required.',
            'mail_from_name.required' => 'The mail from name is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $email_data = EmailSettings::find($id);

        if (!$email_data) {
            return response()->json(['message' => 'Email settings not found.'], 404);
        }

        $email_data->mail_mailer = $request->mail_mailer;
        $email_data->mail_host = $request->mail_host;
        $email_data->mail_encryption = $request->mail_encryption;
        $email_data->mail_port = $request->mail_port;
        $email_data->mail_username = $request->mail_username;
        if ($request->filled('mail_password')) {
            $email_data->mail_password = md5($request->mail_password);
        }
        $email_data->mail_from_address = $request->mail_from_address;
        $email_data->mail_from_name = $request->mail_from_name;
        $email_data->updated_by = Auth::id();

        $email_data->save();

        return response()->json([
            'message' => 'Email settings updated successfully.',
            'data' => $email_data
        ], 200);
    }
}
