<?php

namespace App\Http\Controllers;

use App\Models\subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{      public function createSubscription(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|string',
            'bundle_id' => 'required|string',

        ]);
        $subscription = new Subscription();
        $subscription->user_id = $validated['user_id'];
        $subscription->bundle_id = $validated['bundle_id'];

        try{
            $subscription->save();
            return response()->json($subscription);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to create subscription',
                'message' => $exception->getMessage()
            ]);
        }

    }
    public function readAllSubscriptions(){
        try{
            $subscriptions = subscription::all();
            return response()->json($subscriptions);
        }
        catch(\Exception $exception){
            return response()->json([
                'error' => 'failed to fetch subscriptions',
                'message' => $exception->getMessage()
            ]);
        }
        }
        public function readSubscription($id){
            try{
                $subscription = Subscription::findOrFail($id);
                return response()->json($subscription);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to fetch subscription',                    
                    'message' => $exception->getMessage()
                ]);
            }
        }
        public function updateSubscription(Request $request, $id){
              $validated = $request->validate([
            'user_id' => 'required|string',
            'bundle_id' => 'required|string',
        ]);
        $subscription = new Subscription();
        $subscription->user_id = $validated['user_id'];
        $subscription->bundle_id = $validated['bundle_id'];
            try{
                $subscription = Subscription::findOrFail($id);
                $subscription->user_id = $validated['user_id'];
                $subscription->bundle_id = $validated['bundle_id'];
                $subscription->save();
                return response()->json($subscription);
            }
            catch(\Exception $exception){
                return response()->json([
                    'error' => 'failed to update subscription',
                    'message' => $exception->getMessage()
                ]);
            }

        }
        public function deleteSubscription($id){
            try{
                $subscription = Subscription::findOrFail($id);
                $subscription->delete();
                return response("Subscription deleted succesfully");
            }
            catch(\Exception $exception){
                return response()->json([
                    
                    'error' => 'failed to delete subscription',
                    'message' => $exception->getMessage()
                ]);
            }
        }
}
