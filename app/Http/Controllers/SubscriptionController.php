<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    // Admin Methods
    public function subscriptionListData()
    {
        $subscriptionLists = Subscription::orderBy('created_at', 'DESC')->get();

        return view('admin.subscription.index', compact('subscriptionLists'));
    }

    public function subscriptionStore(Request $request)
    {
        try {
            $rules = [
                'plan_name' => 'required|min:4|max:20',
                // 'plan_type' => 'required|string',
                // 'plan_price' => 'required|integer',
                'plan_description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            // dd($validator);

            if ($validator->passes()) {
                $subscribPlan = new Subscription();
                $subscribPlan->plan_name = $request->plan_name;
                $subscribPlan->montly_price = $request->monthly_price;
                $subscribPlan->yearly_price = $request->yearly_price;
                $subscribPlan->description = $request->plan_description;
                $subscribPlan->save();

                // return $this->sendResponse(true, $subscribPlan, $message, $this->successStatus);

                return response()->json([
                    'message' => 'Subscription Pland Added Successfully.',
                    'status' => true,
                    'errors' => [],
                    $this->successStatus
                ]);
                // return response()->json([true, $message, $this->successStatus]);

                // return $this->sendResponse(true, $message, $this->successStatus);
            } else {
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    //Edit method
    public function subscriptionEdit(Request $request, $id)
    {
        $data = Subscription::findOrFail($id);

        return response()->json($data);
    }

    // Mehod for update
    public function subscriptionUpdate(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'get_plan_name' => 'required|min:4|max:20',
            'get_plan_description' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->toArray()
            ]);
        }

        try {
            // Update the subscription
            $subscription = Subscription::findOrFail($request->subs_id);
            $subscription->plan_name = $request->get_plan_name;
            $subscription->montly_price = $request->get_monthly_price;
            $subscription->yearly_price = $request->get_yearly_price;
            $subscription->description = $request->get_plan_description;
            $subscription->save();

            return response()->json([
                'status' => true,
                'message' => 'Subscription Plan updated successfully',
                'errors' => []
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to update subscription',
                'errors' => $e->getMessage()
            ]);
        }
    }

    //Delete Method
    public function subscriptionDelete(Request $request)
    {
        try {

            Subscription::where('id', $request->subscriptionId)->delete();

            // return response()->json([
            //     'status' => true,
            //     'data' => $subscribeDelete
            // ]);

            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "Subscription Plan"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }
    //Stauts update
    public function statusUpdateSubscription(Request $request)
    {
        $id = $request->input('id');
        $status = $request->input('status');

        // Update the status in the database
        Subscription::where('id', $id)->update(['status' => $status]);

        // You can optionally return a response to confirm the status update
        return response()->json([
            'message' => 'Status Updated successfully.',
            'status' => true,
            'errors' => [],
            $this->successStatus
        ]);
        // return response()->json(['message' => 'Status updated successfully']);
    }

    // Recruiter Methods
    public function subscriptionList()
    {
        $subsPlanLists = Subscription::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('recruiter.subscription.index', compact('subsPlanLists'));
    }
}
