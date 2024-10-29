<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProposalRequest;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{

    private $fileDirectory = 'uploads/proposals/';
    /**
     * Generates a tracking ID in the format mmYY - 001.
     *
     * The tracking ID is incremented for each new proposal in the same month.
     * If the month changes, the counter is reset to 001.
     *
     * @param string|null $lastId The last tracking ID issued
     * @return string The new tracking ID
     */
    private function generateTrackingId($lastId)
    {
        $currentMonth = date('m');
        $currentYear = date('y');
        $currentMonthYear = $currentMonth . $currentYear;

        // If there's no last ID, start with 001
        if (empty($lastId)) {
            return sprintf('%s - 001', $currentMonthYear);
        }

        // Split the last ID into month-year and counter
        list($lastMonthYear, $counter) = explode(' - ', $lastId);
        $counter = (int)$counter; // Convert counter to an integer for safe increment

        // Check if the month/year has changed
        if ($lastMonthYear === $currentMonthYear) {
            $counter++;
        } else {
            $counter = 1; // Reset counter if it's a new month
        }

        // Return the new tracking ID
        return sprintf('%s - %03d', $currentMonthYear, $counter);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Proposal::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProposalRequest $request)
    {
        $validatedRequest = $request->validated();

        if ($request->hasFile('attachment')) {
            $uploadAttachment = $request['attachment']->storeAs($this->fileDirectory, $validatedRequest['']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
