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
        $subscriptionLists = Subscription::where('status', 1)->orderBy('created_at', 'DESC')->get();

        return view('admin.subscription.index', compact('subscriptionLists'));
    }

    public function subscriptionStore(Request $request)
    {
        try {
            $rules = [
                'plan_name' => 'required|min:4|max:20',
                'plan_type' => 'required|string',
                'plan_price' => 'required|integer',
                'plan_description' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);
            // dd($validator);

            if ($validator->passes()) {
                $subscribPlan = new Subscription();
                $subscribPlan->plan_name = $request->plan_name;
                $subscribPlan->plan_type = $request->plan_type;
                $subscribPlan->price = $request->plan_price;
                $subscribPlan->description = $request->plan_description;
                $subscribPlan->save();

                // $message = trans('messages.custom.error_messages', ['attribute' => "Subscription"]);
                // return $this->sendResponse(true, $subscribPlan, $message, $this->successStatus);

                return response()->json([
                    'message' => 'Form submitted successfully',
                    'status' => true,
                    'errors' => [],
                    $this->successStatus
                ]);
                // return response()->json([true, trans(
                //     'messages.custom.create_messages',
                //     ["attribute" => "Job"]
                // ), $this->successStatus]);
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
        $data = Subscription::find($id);

        return response()->json($data);
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
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }

    //Get single data
    public function getUserDetails($userId)
    {
        $user = Subscription::find($userId); // Assuming User is your model
        return response()->json($user);
    }

    // Recruiter Methods
    public function subscriptionList()
    {
        return view('recruiter.subscription.index');
    }
}
