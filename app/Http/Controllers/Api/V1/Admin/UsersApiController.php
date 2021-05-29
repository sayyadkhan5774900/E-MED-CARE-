<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\CustomerDetail;
use App\Models\User;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\isEmpty;

class UsersApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => [
                    'string',
                    'required',
                ],
                'email' => [
                    'required',
                    'unique:users',
                ],
                'password' => [
                    'required',
                ]
            ]
        );

        $user = User::create($request->all());
        $user->roles()->sync([4]);
        CustomerDetail::create([
            'customer_id' => $user->id,
            'province' => 'test',
            'city' => 'test',
            'phone' => 'test',
            'address' => 'test',
        ]);

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email|',
        ]);

        $user = User::where('email',$request->email)->first();

        if($user != null){
            if(Hash::check($request->password,$user->password)){
                return new UserResource($user);
            }
        }

        return [
            'error' => 'Invalid email or password'
        ];
    }

}
