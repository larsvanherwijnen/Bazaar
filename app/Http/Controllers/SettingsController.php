<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsFormRequest;
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
            $config = $company->config->merge($request->only(['primary_color', 'secondary_color', 'description']));

            $config = $this->uploadFile($request->file('logo'),$config, 'logo', $company);
            $config = $this->uploadFile($request->file('banner'), $config, 'banner', $company);

            $company->update(['config' => $config]);
        }

        $user->update($request->all());

        return redirect()->route('my-account.settings');
    }

    private function uploadFile($file, $config, $fieldName, $company)
    {
        if (!$file) {
            return $config;
        }

        if ($config->get($fieldName)) {
            Storage::delete($config->get($fieldName));
        }

        $fileLocation = "public/{$company->url}/images";
        $filePath = Storage::put($fileLocation, $file, 'public');
        return $config->merge([$fieldName => $filePath]);
    }
}
