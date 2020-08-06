<?php

namespace App\Http\Controllers;

use App\Leads\Lead;
use Illuminate\Auth\AuthManager;

class LeadController extends Controller
{
    protected $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        // The market id for the user's vendor
        $vendorMarketId = $this->auth->user()->vendor->market_id;

        // Fetch leads for market which the current user's vendor is associated with
        $leads = Lead::where(
            'market_id',
            $vendorMarketId
        )->get();

        return response()->json([
            'data' => $leads,
        ]);
    }

    /**
     * @param Lead $lead Laravel uses route model binding to automatically convert the lead id passed in the url to
     *  a lead object
     */
    public function get(Lead $lead)
    {
        // --- You should add code here to return a lead from the endpoint ---
    }
}
