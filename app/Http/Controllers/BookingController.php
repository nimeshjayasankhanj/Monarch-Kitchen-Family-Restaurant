<?php


namespace App\Http\Controllers;


use App\Cart;
use App\CateringOrderItems;
use App\DeliveryOrderItems;
use App\Order;
use App\OrderItems;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function deliveryOrder()
    {
        $orders = DeliveryOrderItems::where('status', 1)->get();
        return view('booking.delivery-order', ['title' => 'Delivery Order', 'orders' => $orders]);
    }


    public function addToCart(Request $request)
    {
        DB::beginTransaction();
        try {
            $cart = Cart::where('delivery_order_items_iddelivery_order_items', $request['id'])->where('type', 1)
                ->where('user_master_iduser_master', Auth::user()->iduser_master)
                ->first();

            if ($cart !== null) {
                $cart->qty += 1;
                $cart->save();
            } else {
                $record = new Cart();
                $record->delivery_order_items_iddelivery_order_items = $request['id'];
                $record->qty = 1;
                $record->type = 1;
                $record->user_master_iduser_master = Auth::user()->iduser_master;
                $record->save();
            }
            DB::commit();
            return response()->json(['success' => 'added to the cart']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function cart()
    {
        $carts = Cart::where('user_master_iduser_master', Auth::user()->iduser_master)->where('type', 1)->get();
        $user = User::find(Auth::user()->iduser_master);
        $name = $user->first_name . ' ' . $user->last_name;
        $address = '';
        return view('cart.cart', ['title' => 'Cart', 'carts' => $carts, 'name' => $name, 'address' => $address]);
    }

    public function changeQty(Request $request)
    {
        DB::beginTransaction();
        try {
            $record = Cart::find($request['id']);
            if ($request['type'] === 'plus') {
                if ($record->deliveryOrderItems->qty < $record->qty + 1) {
                    return $record->deliveryOrderItems->qty;
                } else {
                    $record->qty += 1;
                    $record->save();
                    DB::commit();
                    return $record->qty;
                }
            } else if ($request['type'] === 'minus') {
                if ($record->qty - 1 < 1) {
                    $total = $this->total();
                    return 1;
                } else {
                    $record->qty -= 1;
                    $record->save();
                    DB::commit();
                    return $record->qty;
                }
            }
            return 0;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getTotalCost()
    {
        $carts = Cart::where('user_master_iduser_master', Auth::user()->iduser_master)->get();
        $itemCosts = 0;
        foreach ($carts as $cart) {
            $itemCosts += $cart->qty * $cart->deliveryOrderItems->item_price;
        }
        return ['itemPrice' => number_format($itemCosts, 2), 'total' => number_format($itemCosts + env('DELIVERY_CHARGE'), 2)];
    }

    public function deleteChartRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            $record = Cart::find($request['id']);
            $record->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function payDeliveryOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [

                'name' => 'required',
                'address' => 'required',
                'paymentType' => 'required',
            ], [
                'name.required' => 'Name should be provided!',
                'address.required' => 'Address should be provided!',
                'paymentType.required' => 'Payment Type should be provided!',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $carts = Cart::where('user_master_iduser_master', Auth::user()->iduser_master)->get();
            foreach ($carts as $cart) {
                $deliveryItem = DeliveryOrderItems::find($cart->delivery_order_items_iddelivery_order_items);
                if ($deliveryItem->qty < $cart->qty) {
                    return response()->json(['qty_error' => 'Not enough quantity for product ' . $deliveryItem->name]);
                }
            }

            $total = 0;
            foreach ($carts as $cart) {
                $total += $cart->qty * $cart->deliveryOrderItems->item_price;
            }

            $record = new Order();
            $record->total_cost = $total;
            $record->name = $request['name'];
            $record->address = $request['address'];
            $record->status = 0;
            $record->date = Carbon::now()->format('y-m-d');
            $record->type = 'Delivery Order';
            $record->user_master_iduser_master = Auth::user()->iduser_master;
            $record->save();

            foreach ($carts as $cart) {
                $stock = DeliveryOrderItems::find($cart->delivery_order_items_iddelivery_order_items);
                if ($stock->qty == 0) {
                    $stock->status = '0';
                    $stock->update();
                } else if ($cart->qty < $stock->qty) {
                    $stock->qty -= $cart->qty;
                    $stock->save();
                } else if ($cart->qty == $stock->qty) {
                    $stock->qty -= $cart->qty;
                    $stock->status = 0;
                    $stock->save();
                }

                $item = new OrderItems();
                $item->id = $cart->delivery_order_items_iddelivery_order_items;
                $item->qty = $cart->qty;
                $item->order_idorder = $record->idorder;
                $item->save();

                $cart->delete();
            }
            DB::commit();
            return response()->json(['success' => 'Order saved']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function cateringOrders()
    {
        $orders = CateringOrderItems::where('status', 1)->get();
        return view('booking.catering-order', ['title' => 'Catering Order', 'orders' => $orders]);
    }

    public function placeCateringOrder(Request $request)
    {
        $order = CateringOrderItems::find($request['idOrder']);
        return view('booking.place-catering-order', ['id' => $request['idOrder'], 'title' => 'Place Catering Order', 'order' => $order]);
    }

    public function getTotalCostWithExtra(Request $request)
    {
        $order = CateringOrderItems::find($request['id']);
        $total = number_format($order->price + env('EXTRA_CHARGE'), 2);
        return $total;
    }

    public function payCateringOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [

                'noOfPersons' => 'required|not_in:0|gt:0',
                'extraItem' => 'required',
                'date' => 'required',
                'time' => 'required',
            ], [
                'noOfPersons.required' => 'No of Persons should be provided!',
                'extraItem.required' => 'Extra Item should be provided!',
                'date.required' => 'Date should be provided!',
                'time.required' => 'Date should be provided!',
                'noOfPersons.not_in' => 'No of Persons may not be 0!',
                'noOfPersons.gt' => 'No of Persons may not be minus!',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }
            $date = $request['date'];
            $time = $request['time'];
            $todayDate = Carbon::now()->format('Y-m-d');
            $timeNow = Carbon::now()->format('H:i:s');

            if ($date < $todayDate) {
                return response()->json(['error' => 'Invalid date']);
            }
            if ($time < $timeNow) {
                return response()->json(['error' => 'Invalid time']);
            }
            if ($request['noOfPersons'] > 150) {
                return response()->json(['error' => 'No of person should be less than 150']);
            }
            $order = CateringOrderItems::find($request['cateringItemId']);
            if ($order->qty === 0) {
                return response()->json(['error' => 'Quantity not available']);
            }

            $record = new Order();
            $record->total_cost = $order->price;
            $record->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            $record->address = null;
            $record->date = $date;
            $record->time = $time;
            $record->status = 0;
            $record->type = 'Catering Order';
            $record->no_of_persons = $request['noOfPersons'];
            $record->user_master_iduser_master = Auth::user()->iduser_master;
            $record->save();


            $item = new OrderItems();
            $item->id = $order->idcatering_order_items;
            $item->qty = 1;
            $item->order_idorder = $record->idorder;
            $item->save();


            if ($order->qty == 0) {
                $order->status = '0';
                $order->update();
            } else if (1 < $order->qty) {
                $order->qty -= 1;
                $order->save();
            } else if (1 == $order->qty) {
                $order->qty -= 1;
                $order->status = 0;
                $order->save();
            }

            DB::commit();
            return response()->json(['success' => 'Order Saved']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function reservationOrders()
    {
        $items = DeliveryOrderItems::where('status', 1)->get();
        return view('booking.reservation-orders', ['title' => 'Reservation Order', 'items' => $items]);
    }

    public function getProductDetails(Request $request)
    {
        try {
            $orderItem = DeliveryOrderItems::find($request['id']);
            $caryQty = Cart::sum('qty');
            return response()->json(['item_price' => $orderItem->item_price, 'qty' => $orderItem->qty - $caryQty]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getReservationTable()
    {
        $items = Cart::where('user_master_iduser_master', Auth::user()->iduser_master)->where('type', 2)->get();
        $tableData = '';
        $total = 0;
        if (count($items) != 0) {
            foreach ($items as $item) {

                $total += $item->deliveryOrderItems->item_price * $item->qty;
                $tableData .= "<tr>";
                $tableData .= "<td>" . $item->deliveryOrderItems->name . "</td>";

                $tableData .= "<td>" . number_format($item->qty, 2) . "</td>";
                $tableData .= "<td style=\"text-align: right\">"
                    . number_format($item->item_price, 2) . "</td>";
                $tableData .= "<td style='text-align: right'>";
                $tableData .= "<button type='button'  class='btn btn-sm btn-danger  waves-effect waves-light' onClick='deleteItem($item->idcart)' > ";
                $tableData .= " <i class=\"fa fa-edit\"></i>";
                $tableData .= "  </button>";
                $tableData .= " </td>";
                $tableData .= "</tr>";
            }
        } else {
            $tableData = "<tr><td colspan='8' style='text-align: center'><b>Sorry No Results Found.</b></td></tr>";
        }

        return response()->json(['total' => $total, 'tableData' => $tableData]);
    }

    public function addReservationItem(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [
                'productId' => 'required',
                'qty' => 'required|not_in:0|gt:0'
            ], [
                'productId.required' => 'Product should be provided!',
                'qty.required' => 'Qty should be provided!',
                'qty.not_in' => 'Qty may not be 0!',
                'qty.gt' => 'Qty may not minus!'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $cart = Cart::where('delivery_order_items_iddelivery_order_items', $request['productId'])->where('type', 2)
                ->where('user_master_iduser_master', Auth::user()->iduser_master)
                ->first();

            if ($cart !== null) {
                $cart->qty += 1;
                $cart->save();
            } else {
                $record = new Cart();
                $record->delivery_order_items_iddelivery_order_items = $request['productId'];
                $record->qty = 1;
                $record->type = 2;
                $record->user_master_iduser_master = Auth::user()->iduser_master;
                $record->save();
            }
            DB::commit();
            return response()->json(['success' => 'Item saved']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function saveReservation(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = \Validator::make($request->all(), [
                'date' => 'required',
                'time' => 'required',
                'noOfPersons' => 'required|not_in:0|gt:0'
            ], [
                'productId.required' => 'Product should be provided!',
                'date.required' => 'Date should be provided!',
                'time.required' => 'Time should be provided!',
                'noOfPersons.required' => 'No of Persons should be provided!',
                'noOfPersons.not_in' => 'No of Persons may not be 0!',
                'noOfPersons.gt' => 'No of Persons may not minus!'
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()]);
            }

            $date = $request['date'];
            $time = $request['time'];
            $todayDate = Carbon::now()->format('Y-m-d');
            $timeNow = Carbon::now()->format('H:i:s');

            if ($date < $todayDate) {
                return response()->json(['error' => 'Invalid date']);
            }
            if ($time < $timeNow) {
                return response()->json(['error' => 'Invalid time']);
            }
            if ($request['noOfPersons'] > 50) {
                return response()->json(['error' => 'No of person should be less than 50']);
            }

            $carts = Cart::where('user_master_iduser_master', Auth::user()->iduser_master)->get();
            foreach ($carts as $cart) {
                $deliveryItem = DeliveryOrderItems::find($cart->delivery_order_items_iddelivery_order_items);
                if ($deliveryItem->qty < $cart->qty) {
                    return response()->json(['error' => 'Not enough quantity for product ' . $deliveryItem->name]);
                }
            }

            $total = 0;
            foreach ($carts as $cart) {
                $total += $cart->qty * $cart->deliveryOrderItems->item_price;
            }

            $record = new Order();
            $record->total_cost = $total;
            $record->name = Auth::user()->first_name . ' ' . Auth::user()->last_name;;
            $record->address = null;
            $record->date = $date;
            $record->time = $time;
            $record->no_of_persons = $request['noOfPersons'];
            $record->status = 0;
            $record->type = 'Reservation Order';
            $record->user_master_iduser_master = Auth::user()->iduser_master;
            $record->save();

            foreach ($carts as $cart) {
                $stock = DeliveryOrderItems::find($cart->delivery_order_items_iddelivery_order_items);
                if ($stock->qty == 0) {
                    $stock->status = '0';
                    $stock->update();
                } else if ($cart->qty < $stock->qty) {
                    $stock->qty -= $cart->qty;
                    $stock->save();
                } else if ($cart->qty == $stock->qty) {
                    $stock->qty -= $cart->qty;
                    $stock->status = 0;
                    $stock->save();
                }

                $item = new OrderItems();
                $item->id = $cart->delivery_order_items_iddelivery_order_items;
                $item->qty = $cart->qty;
                $item->order_idorder = $record->idorder;
                $item->save();

                $cart->delete();
            }
            DB::commit();
            return response()->json(['success' => 'Reservation saved']);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
