<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsFormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings')->with(['company' => auth()->user()->company]);
    }

    public function update(SettingsFormRequest $request)
    {
        $user = $request->user();

        if ($user->company) {
            $company = $user->company;

            if ($company->config) {
                $config = $company->config->merge($request->only(['description']));
            }
            else {
                $config = collect($request->only(['description']));
            }


            $config = $this->uploadFile($request->file('logo'),$config, 'logo', $company);
            $config = $this->uploadFile($request->file('banner'), $config, 'banner', $company);

            $company->update(['config' => $config]);
        }

        $user->update($request->all());

        return redirect()->route('my-account.settings');
    }

    private function uploadFile($file, $config, $fieldName)
    {
        if (!$file) {
            return $config;
        }

        if ($config->get($fieldName)) {
            Storage::delete($config->get($fieldName));
        }

        $url = Auth::user()->url;
        $fileLocation = "public/$url/images";
        $filePath = Storage::put($fileLocation, $file, 'public');
        return $config->merge([$fieldName => $filePath]);
    }
}
