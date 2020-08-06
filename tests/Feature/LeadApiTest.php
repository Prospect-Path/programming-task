<?php

namespace Tests\Feature;

use App\Market;
use App\User;
use Tests\TestCase;

class LeadApiTest extends TestCase
{
    /**
     * A user should be able to make a call to the leads.index route and see the leads which are in their vendor's market
     */
    public function test_as_a_user_i_want_to_get_leads_in_my_market_using_the_lead_index_api_endpoint()
    {
        $user = User::where('name', 'Jack')->first();

        // The route() method looks up routes based on the name in /routes/api.index
        $leadIndexRoute = route('leads.index');

        // This simulates making a http get request to the route above
        $response = $this->actingAs($user, 'api')->get($leadIndexRoute);

        // Assert that the http request is successful
        $response->assertSuccessful();

        // Assert that the response contains the company name of the first lead from the market which the user's vendor
        // is associated with.
        $response->assertSee(
            $user->vendor->market->leads()->first()->company_name
        );
    }

    /**
     * A user should not receive leads from other markets when they call the lead index api endpoint
     */
    public function test_as_a_user_i_do_not_get_leads_in_other_markets_using_the_lead_index_api_endpoint()
    {
        $user = User::where('name', 'Jack')->first(); // This user id associated with the HRMS market
        $erpMarket = Market::where('name', 'ERP')->first();

        // The route() method looks up routes based on the name in /routes/api.index
        $leadIndexRoute = route('leads.index');

        // This simulates making a http get request to the route above
        $response = $this->actingAs($user, 'api')->get($leadIndexRoute);

        // Assert that the http request is successful
        $response->assertSuccessful();

        // Assert that the response doesn't contain leads from another market
        $response->assertDontSee(
            $erpMarket->leads()->first()->company_name
        );
    }

    /**
     * A user should be able to make a call to the leads.get route and see an individual lead. This test will
     * fail until you have added code for the get lead endpoint in app/Http/Controllers/LeadController
     */
    public function test_as_a_user_i_want_to_get_an_individual_lead_from_the_lead_get_api_endpoint()
    {
        $user = User::where('name', 'Jack')->first();

        // The lead which the user is going to get
        $lead = $user->vendor->market->leads()->first();

        // The route() method looks up routes based on the name in /routes/api.index

        // We pass the lead which we want to get to the route method, behind the scenes this will pass the
        // lead id in the address so this is the equivalent to going to the url example.com/leads/1 where the lead id is 1
        $leadGetRoute = route('leads.get', [
            'lead' => $lead,
        ]);

        // This simulates making a http get request to the route above
        $response = $this->actingAs($user, 'api')->get($leadGetRoute);

        // Assert that the http request is successful
        $response->assertSuccessful();

        // Assert that the lead can be seen
        $response->assertSee(
            $lead->company_name
        );
    }

    /**
     * A user should not be able to get a lead from another market using the get lead endpoint. A 404 not found response
     *  should be sent.
     */
    public function test_as_a_user_i_cannot_get_an_individual_lead_from_another_market_from_the_get_api_endpoint()
    {
        $user = User::where('name', 'Jack')->first(); // This user id associated with the HRMS market
        $erpMarket = Market::where('name', 'ERP')->first();


        // The lead from another market which the user should be unable to get
        $lead = $erpMarket->leads()->first();

        // The route() method looks up routes based on the name in /routes/api.index

        // We pass the lead which we want to get to the route method, behind the scenes this will pass the
        // lead id in the address so this is the equivalent to going to the url example.com/leads/1 where the lead id is 1
        $leadGetRoute = route('leads.get', [
            'lead' => $lead,
        ]);

        // This simulates making a http get request to the route above
        $response = $this->actingAs($user, 'api')->get($leadGetRoute);

        // Assert that the http request is not found
        $response->assertNotFound();
    }

    /**
     * There is a boolean flag on the vendor model called active. If a user who is associated with a vendor
     * who is not active makes a call to the lead index api endpoint they should get a 403 forbidden http response
     */
    public function test_as_a_user_whos_vendor_is_not_active_i_cannot_use_the_lead_index_api_endpoint()
    {
        $user = User::where('name', 'Jess')->first(); //This user is associated with a vendor which is disabled

        // The route() method looks up routes based on the name in /routes/api.index
        $leadIndexRoute = route('leads.index');

        // This simulates making a http get request to the route above
        $response = $this->actingAs($user, 'api')->get($leadIndexRoute);

        // Assert that the http request is forbidden
        $response->assertForbidden();
    }

    /**
     * There is a boolean flag on the vendor model called active. If a user who is associated with a vendor
     * who is not active makes a call to the lead get api endpoint they should get a 403 forbidden http response
     */
    public function test_as_a_user_whos_vendor_is_not_active_i_cannot_use_the_lead_get_api_endpoint()
    {
        $user = User::where('name', 'Jess')->first(); //This user is associated with a vendor which is disabled
        $lead = $user->vendor->market->leads()->first();

        // The route() method looks up routes based on the name in /routes/api.index
        $leadIndexRoute = route('leads.get', [
            'lead' => $lead
        ]);

        // This simulates making a http get request to the route above
        $response = $this->actingAs($user, 'api')->get($leadIndexRoute);

        // Assert that the http request is forbidden
        $response->assertForbidden();
    }
}
