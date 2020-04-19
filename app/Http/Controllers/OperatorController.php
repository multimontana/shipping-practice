<?php

namespace App\Http\Controllers;

use App\Operator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index()
    {
        $data = Operator::all();
        return response()->json($data);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $formData = $this->validate($request,[
            'name' => 'required|string|max:32',
            'surname' => 'required|string|max:32',
            'phone' => 'required|string|max:32|unique:operators|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9',
        ]);

        $operator = Operator::create($formData);
        return response()->json($operator);
    }

    /**
     * @param Operator $operator
     * @return JsonResponse
     */
    public function show(Operator $operator)
    {
        $operatorById = Operator::find($operator);
        return response()->json($operatorById);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $formData = $request->validate([
            'name' => 'required|string|max:32',
            'surname' => 'required|string|max:32',
            'phone' => 'required|string|max:32|regex:/(0)[0-9]/|not_regex:/[a-z]/|min:9|unique:operators,phone,' . $id,
        ]);

        Operator::whereId($id)->update($formData);
        return response()->json($formData);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        if($operator = Operator::find($id)){
            $operator->delete();
            return response()->json(['message' => 'Operator was deleted']);
        }else{
            return response()->json(['message' => 'Operator not found']);
        }
    }
}
