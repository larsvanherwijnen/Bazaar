<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTokenRequest;
use App\Http\Requests\SettingsFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        return view('settings')->with(['company' => auth()->user()->company]);
    }

    public function update(SettingsFormRequest $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->company) {
            $company = $user->company;

            if ($company->config) {
                $config = $company->config->merge($request->only(['description']));
            } else {
                $config = collect($request->only(['description']));
            }

            $config = $this->uploadFile($request, $config, 'logo', 'images');
            $config = $this->uploadFile($request, $config, 'banner', 'images');

            $company->update(['config' => $config]);
        }

        $user->update($request->all());

        return redirect()->route('my-account.settings');
    }

    /**
     * Upload a file and return the new config.
     */
    private function uploadFile(SettingsFormRequest $request, Collection $config, string $fileName, string $folder, string $disk = 'public'): Collection
    {
        $file = $request->file($fileName);

        if (! $file) {
            return $config;
        }

        if ($config->get($fileName)) {
            Storage::delete($config->get($fileName));
        }

        $url = Auth::user()->url;
        $fileLocation = "$disk/$url/$folder";
        /** @phpstan-ignore-next-line */
        $filePath = Storage::put($fileLocation, $file, 'public');

        return $config->merge([$fileName => $filePath]);
    }

    public function createToken(CreateTokenRequest $request): View
    {
        $user = Auth::user();
        $token = $user->createToken($request->name);
        return view('settings')->with(['company' => $user->company, 'token' => preg_replace('/^\d+\|/','', $token->plainTextToken)]);
    }
}
