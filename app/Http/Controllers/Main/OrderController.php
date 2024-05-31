<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller; // Correct the namespace

use App\Mail\OrderPlaced;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Item;
use App\Models\Order;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
//    public $test = null;
//    public function placeOrder(Request $request)
//    {
//
//        // Initialize the total to 0
//        $total = 0;
//
//        // Get the user's ID
//        $userId = auth()->id();
//
//        // Create the order
//        $order = PlaceOrder::create([
//            'user_id' => $userId,
//            'items_id' => 0,
//            'total' => $total, // Set it to 0 initially
//        ]);
//
//        // Get cart items for the user
//        $cartItems = Cart::where('user_id', $userId)->get();
//
//        foreach ($cartItems as $cartItem) {
//            // Create an item for each cart item
//            $orderItems = Item::create([
//                'product_id' => $cartItem->product_id,
//                'order_id' => $order->id,
//                'quantity' => $cartItem->quantity, // Fix the typo
//                'price' => $cartItem->total,
//            ]);
//
//            // Update the total for this order
//            $total += $cartItem->total;
//        }
//
//        // Update the order's total after processing all cart items
//        $order->update(['total' => $total]);
//        Cart::destroy($cartItems);
////        Mail::to($order->user->email)->send(new OrderPlaced([
////            'byername' => $order->user->name,
////            'buyersurname'=>$order->user->email,
////            'orderid'=>$order->id,
////            'orderdate'=>$order->created_at,
////            'products' => $order->item->product,
////            'address' => $order->user->profile->address
////
////        ]));
//        return redirect()->route('my.orders');
//    }


//    public function placeOrder(Request $request)
//    {
//        // Start a database transaction
//        DB::beginTransaction();
//
//        try {
//            $userId = auth()->id();
//
//            $order = PlaceOrder::create([
//                'user_id' => $userId,
//                'total' => 0, // This will be updated after calculating the total and applying any coupon
//            ]);
//
//            $cartItems = Cart::where('user_id', $userId)->get();
//
//            $total = 0;
//
//            foreach ($cartItems as $cartItem) {
//                $total += $cartItem->price * $cartItem->quantity;
//                Item::create([
//                    'product_id' => $cartItem->product_id,
//                    'order_id' => $order->id,
//                    'quantity' => $cartItem->quantity,
//                    'price' => $cartItem->price,
//                ]);
//            }
//
//            // Check if a coupon code was provided and apply it
//            if ($request->has('coupon_code')) {
//                $coupon = ApplyCoupon::where('code', $request->input('coupon_code'))->first();
//
//                // Validate the coupon; you may want to implement additional checks (e.g., expiration)
//                if ($coupon && $this->validateCouponForUser($coupon, $userId)) {
//                    $discount = $this->calculateDiscount($coupon, $total);
//                    $total -= $discount;
//
//                    // Decrement the coupon quantity by 1
//                    $coupon->quantity -= 1;
//                    $coupon->save(); // Save the updated coupon back to the database
//                }
//            }
//
//            $order->update(['total' => $total]);
//
//            Cart::where('user_id', $userId)->delete();
//
//            DB::commit();
//
//            return redirect()->route('my.orders')->with('success', 'PlaceOrder placed successfully');
//        } catch (Exception $e) {
//            DB::rollBack();
//            \Log::error($e->getMessage());
//            return redirect()->back()->with('error', 'Error placing order: ' . $e->getMessage());
//        }
//    }

//    public function placeOrder(Request $request)
//    {
//        // Start a database transaction
//        DB::beginTransaction();
//
//        try {
//            $userId = auth()->id();
//
//            $order = Order::create([
//                'user_id' => $userId,
//                'total' => 0, // Initial total, to be updated
//            ]);
//
//            $cartItems = Cart::where('user_id', $userId)->get();
//
//            $total = 0;
//
//            // Calculate the total from cart items
//            foreach ($cartItems as $cartItem) {
//                $total += $cartItem->price * $cartItem->quantity;
//                Item::create([
//                    'product_id' => $cartItem->product_id,
//                    'order_id' => $order->id,
//                    'quantity' => $cartItem->quantity,
//                    'price' => $cartItem->price,
//                ]);
//            }
//
//            // Check if a coupon discount has been applied via the session
//            if ($this->test->has('applied_coupon_discount')) {
//                $discount = $this->test->has('applied_coupon_discount');
//                $total -= $discount;
//
//                // Optional: Save the applied coupon code to the order for record-keeping
//                if ($this->test->has('applied_coupon_code')) {
//                    $couponCode = $this->test->has('applied_coupon_code');
//                    $coupon = Coupon::where('code', $couponCode)->first();
//                    if ($coupon) {
//                        $order->coupon_id = $coupon->id;
//                        // Decrement the coupon quantity by 1, if your logic requires
//                        $coupon->quantity -= 1;
//                        $coupon->users()->attach($userId, ['used_at' => now()]); // Add used_at if you're tracking when the coupon was used
//                        $coupon->save();
//                    }
//                }
//
//                // Clear the applied coupon data from the session
//                session()->forget(['applied_coupon_code', 'applied_coupon_discount']);
//            }
//
//            // Update the order's total with the final calculated total
//            $order->update(['total' => $total]);
//
//            // Empty the cart
//            Cart::where('user_id', $userId)->delete();
//
//            DB::commit();
//
//            return redirect()->route('my.orders')->with('success', 'Order placed successfully');
//        } catch (\Exception $e) {
//            DB::rollBack();
//            \Log::error($e->getMessage());
//            return redirect()->back()->with('error', 'Error placing order: ' . $e->getMessage());
//        }
//    }
//
//
//
//    public function applyCoupon(Request $request)
//    {
//        $couponCode = $request->input('coupon_code');
//        $userId = auth()->id(); // Ensure you have the user's ID for validation
//
//        DB::beginTransaction();
//
//        try {
//            $coupon = Coupon::where('code', $couponCode)
//                ->where('expiration_date', '>=', now())
//                ->first();
//
//            if (!$coupon) {
//                return redirect()->back()->with('error', 'Invalid or expired coupon.');
//            }
//
//            if (!$this->validateCouponForUser($coupon, $userId)) {
//                return redirect()->back()->with('error', 'This coupon cannot be applied.');
//            }
//
//            // Placeholder: Implement getCartTotal to calculate the cart's total for the user
//            $cartTotal = $this->getCartTotal($userId);
//            $discount = $this->calculateDiscount($coupon, $cartTotal);
//
//
//
//            // Store the coupon code and discount amount in the session
//            $this->test=session([
//                'applied_coupon_code' => $couponCode,
//                'applied_coupon_discount' => $discount,
//            ]);
//            session()->forget(['applied_coupon_code', 'applied_coupon_discount']);
//
//
//            DB::commit();
//
//            return redirect()->back()->with('success', "ApplyCoupon applied successfully. Discount: $discount");
//
//
//        } catch (\Exception $e) {
//            DB::rollBack();
//            return redirect()->back()->with('error', 'Error applying coupon: ' . $e->getMessage());
//        }
//
//    }
//
//    protected function getCartTotal($userId)
//    {
//        $cartItems = Cart::where('user_id', $userId)->get(); // Get the items as a collection
//
//        // Use the collection's sum() method with a Closure
//        return $cartItems->sum(function($cartItem) {
//            return $cartItem->price * $cartItem->quantity;
//        });
//    }
//
//
//
//    protected function calculateDiscount($coupon, $total)
//    {
//        if ($coupon->type == 'percentage') {
//            // Assuming 'value' is the percentage discount
//            $discount = ($total * $coupon->value) / 100;
//        } else if ($coupon->type == 'fixed') {
//            // Assuming 'value' is the fixed amount discount
//            $discount = $coupon->value;
//        } else {
//            $discount = 0;
//        }
//
//        return min($discount, $total); // Ensure discount does not exceed the order total
//    }
//
//    protected function validateCouponForUser($coupon, $userId)
//    {
//        // Assuming you have the ApplyCoupon model loaded with the 'users' relationship
//        // Check if the coupon is expired
//        if ($coupon->expiration_date && $coupon->expiration_date->isPast()) {
//            return false;
//        }
//
//        // Utilize the established relationship to check if this user has used the coupon
//        if ($coupon->users()->where('user_id', $userId)->exists()) {
//            // The user has already used this coupon
//            return false;
//        }
//
//        if($coupon->quantity<=0)
//        {
//            return false;
//        }
//
//        // Add any other coupon validation logic here
//
//        return true; // The coupon is valid for this user
//    }
//
//
//
//    public function placeOrderV2(Request $request)
//    {
//
//        $total = 0;
//
//        $userId = auth()->id();
//
//        // Create the order
//        $order = Order::query()->make([
//            'user_id' => $userId,
//            'items_id' => 0,
//            'total' => $total, // Set it to 0 initially
//        ]);
//
//        // Get cart items for the user
//        $cartItems = Cart::where('user_id', $userId)->get();
//
//
//        $orderItems = collect([]);
//        foreach ($cartItems as $cartItem) {
//            // Create an item for each cart item
//            $orderItems->push(Item::query()->make([
//                'product_id' => $cartItem->product_id,
//                'order_id' => $order->id,
//                'quantity' => $cartItem->quantity, // Fix the typo
//                'price' => $cartItem->total /$cartItem->quantity ,
//
//            ]));
//
//            // Update the total for this order
//            $total += $cartItem->total;
//        }
//
//        $order->update(['total' => $total]);
//        Cart::destroy($cartItems);
//
//        DB::beginTransaction();
//        try {
//            $order->save();
//            $order->item->upsert($orderItems->toArray(), $orderItems->id);
//            DB::commit();
//        }catch(\Exception$e){
//            DB::rollBack();
//        }
////        Mail::to($order->user->email)->send(new OrderPlaced([
////            'byername' => $order->user->name,
////            'buyersurname'=>$order->user->email,
////            'orderid'=>$order->id,
////            'orderdate'=>$order->created_at,
////            'products' => $order->item->product,
////            'address' => $order->user->profile->address
////
////        ]));
//        return redirect()->route('my.orders');
//    }
//
    public function orderDetails($order_id)
    {

        return view('main.order.order-details',
            ['order' => $this->orderService->getOrderById($order_id)['order']]
        );
    }

    public function myOrders()
    {
        $id = Auth::id();
        return view('main.order.my-orders',
            ['orders' =>
                $this->orderService->getOrderByUserId($id)]
        );
    }

}
