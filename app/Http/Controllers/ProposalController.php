<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProposalRequest;
use App\Http\Resources\ProposalResource;
use App\Models\Proposal;
use Illuminate\Http\Request;

class ProposalController extends Controller
{

    private $fileDirectory = 'uploads/proposals/';
    private function generateTrackingId()
    {
        $currentYear = date('y'); // Current year (last two digits)
        $currentMonth = date('m'); // Current month (01 to 12)
        $currentMonthYear = $currentMonth . $currentYear; // Format as MMYY

        // Get the highest counter for the current month/year
        $highestCounter = Proposal::where('trackingId', 'LIKE', "$currentMonthYear%")
            ->pluck('trackingId') // Get all matching tracking IDs
            ->map(function ($trackingId) {
                list(, $counter) = explode(' - ', $trackingId);
                return (int) $counter; // Convert to integer
            })
            ->max(); // Find the maximum counter

        // Initialize the counter
        $counter = $highestCounter ? $highestCounter + 1 : 1; // Increment or start at 1

        // Return the new tracking ID, padded to 3 digits
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
        // Validate the request data
        $validatedRequest = $request->validated();

        // Check if the request has a file
        if ($request->hasFile('attachment')) {
            // Generate a tracking ID
            $validatedRequest['trackingId'] = $this->generateTrackingId();

            // Get the original file name
            $fileExtension = $request->file('attachment')->getClientOriginalExtension();
            $filename = str_replace(' ', '', $validatedRequest['trackingId'] . '.' . $fileExtension);
            // Store the file and get the path
            $uploadAttachment = $request->file('attachment')->storeAs($this->fileDirectory, $filename);
            // Proceed only if the file was uploaded successfully
            if ($uploadAttachment) {
                // Store the original file name in the validatedRequest array
                $validatedRequest['attachment'] = $filename;
                // Create the proposal
                $proposal = Proposal::create($validatedRequest);
                // Return a successful response with the resource
                return response()->json(new ProposalResource($proposal), 201);
            } else {
                return response()->json(['error' => 'File upload failed.'], 500);
            }
        } else {
            return response()->json(['error' => 'No attachment found.'], 400);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(ProposalResource $proposal)
    {

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
