<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        $data = Orders::all();
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $formData = $this->validate($request, [
            'firstname' => 'required|string|max:32',
            'lastname' => 'required|string|max:32',
            'email' => 'required|string|email|max:96',
            'phone' => 'required|string|max:32|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'payment_firstname' => 'string|max:32',
            'payment_lastname' => 'string|max:32',
            'payment_company' => 'string|max:60',
            'payment_city' => 'string|max:128',
            'payment_postcode' => 'string|max:10',
            'payment_country' => 'string|max:128',
            'payment_address' => 'string',
            'payment_method' => 'string|max:128',
            'shipping_firstname' => 'string|max:32',
            'shipping_lastname' => 'string|max:32',
            'shipping_city' => 'string|max:128',
            'shipping_postcode' => 'string|max:10',
            'shipping_country' => 'string|max:128',
            'shipping_address' => 'string',
            'shipping_method' => 'string|max:128',
            'comment' => 'string',
            'total' => 'float',
            'commission' => 'float',
            'tracking' => 'string|max:64',
            'currency_code' => 'string',
            'currency_value' => 'float',
        ]);
        $order = Orders::create($formData);
        return response()->json($order);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $orderById = Orders::find($id);
        return response()->json($orderById);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            'firstname' => 'required|string|max:32',
            'lastname' => 'required|string|max:32',
            'email' => 'required|string|email|max:96',
            'phone' => 'required|string|max:32|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
            'payment_firstname' => 'string|max:32',
            'payment_lastname' => 'string|max:32',
            'payment_company' => 'string|max:60',
            'payment_city' => 'string|max:128',
            'payment_postcode' => 'string|max:10',
            'payment_country' => 'string|max:128',
            'payment_address' => 'string',
            'payment_method' => 'string|max:128',
            'shipping_firstname' => 'string|max:32',
            'shipping_lastname' => 'string|max:32',
            'shipping_city' => 'string|max:128',
            'shipping_postcode' => 'string|max:10',
            'shipping_country' => 'string|max:128',
            'shipping_address' => 'string',
            'shipping_method' => 'string|max:128',
            'comment' => 'string',
            'total' => 'float',
            'commission' => 'float',
            'tracking' => 'string|max:64',
            'currency_code' => 'string',
            'currency_value' => 'float',
        ]);

        Orders::whereId($id)->update($formData);
        return response()->json($formData);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if ($orders = Orders::find($id)) {
            $orders->delete();
            return response()->json(['message' => 'Order was deleted']);
        }
        return response()->json(['message' => 'Order not found']);
    }
}
