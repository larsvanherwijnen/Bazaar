<?php

namespace App\Http\Controllers\Admin;

use App\Enum\RolesEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadContractRequest;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\PdfBuilder;
use function Spatie\LaravelPdf\Support\pdf;

class ContractController extends Controller
{
    public function index(): View
    {
        $users = User::with(['contract', 'company'])->where('type', RolesEnum::BUSINESS, RolesEnum::ADMIN)->get();

        return view('admin.contracts', compact('users'));
    }

    public function exportContract(User $user): PdfBuilder
    {
        return pdf('admin.pdf.contract', [
            'company' => $user->company,
        ])->withBrowsershot(function(Browsershot $browsershot) {
            $browsershot->setNodeBinary('/Users/larsvanherwijnen/.nvm/versions/node/v20.11.1/bin/node')
                ->setNpmBinary('/Users/larsvanherwijnen/.nvm/versions/node/v20.11.1/bin/npm');
        })
            ->name("contract-{$user->company->name}.pdf")
            ->download();
        // Export contract
    }

    public function uploadContract(UploadContractRequest $request, User $user): RedirectResponse
    {
        /** @phpstan-ignore-next-line  */
        $file = $request->file('contract')->getClientOriginalName();

        $fileLocation = 'public/contracts/'.$user->company->name.'/'.$file;

        $user->contract()->create([
            'path' => $fileLocation,
        ]);

        Storage::put($fileLocation, $file, 'public');

        return redirect()->route('admin.contracts')->with('success', 'Contract uploaded successfully');
    }

    public function approveContract(Contract $contract): RedirectResponse
    {
        $contract->update([
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('admin.contracts')->with('success', 'Contract approved successfully');
    }

}
