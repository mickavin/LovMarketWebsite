<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Customer;
use Validator;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;

class CustomerController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request) {

        if (Auth::guard('web-customers')->attempt(['email' => request('email'), 'password' => request('password')])) {
            $customer = $request->user('web-customers');
            $oClient = OClient::where('password_client', 1)->first();
            $token = $this->getTokenAndRefreshToken($oClient, request('email'), request('password'));
            return response()->json(['tokens' => $token, 'user' => $customer],200);
        }
        else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            return response()->json(['error'=>['message' => 'Ces identifiants sont incorrects.']], 401);
        }
    }

    public function register(Request $request) {
        $messages = [
            'email.unique' => 'L\'adresse e-mail donnée est déjà utilisée.',
            'c_password.same' => 'Les mots de passe donnés sont différents.',
            'c_password.required' => 'Le champ confirmation de mot de passe est obligatoire.',
            'password' => 'Le mot de passe doit contenir au moins 8 caractères.'

    ];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:8',
            'c_password' => 'required|same:password',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $password = $request->password;
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $customer = Customer::create([
            'name'      => $input['name'],
            'email'     => $input['email'],
            'password'  => $input['password'],
        ]);
        $oClient = OClient::where('password_client', 1)->first();
        $token = $this->getTokenAndRefreshToken($oClient, $customer->email, $password);

        return response()->json(['tokens' => $token, 'user' => $customer],200);
    }

    public function details() {
        $user = Auth::guard('api-customers')->user();
        return response()->json($user, $this->successStatus);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Vous êtes bien déconnecté.'
        ]);
    }

    public function unauthorized() {
        return response()->json("unauthorized", 401);
    }

    public function refreshToken(Request $request) {
        $customer = $request->user();
        $refresh_token = $request->header('Refreshtoken');
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;

        try {
            $response = $http->request('POST', route('passport.token'), [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $refresh_token,
                    'client_id' => $oClient->id,
                    'client_secret' => $oClient->secret,
                    'scope' => '*',
                ],
            ]);
            $result = json_decode((string) $response->getBody(), true);
            return response()->json(['tokens' => $result, 'user' => $customer],200);
        } catch (Exception $e) {
            return response()->json("unauthorized", 401);
        }
    }

    public function phoneNumber(Request $request) {
        $customer = $request->user();
        $phone_number = $request->header('PhoneNumber');
        try {
            $customer->update(['phoneNumber' => $phone_number]);
            return response()->json(['response' => 'Le téléphone a bien été modifié.'],200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue.'],500);
        }

    }

    public function getTokenAndRefreshToken(OClient $oClient, $email, $password) {
        $oClient = OClient::where('password_client', 1)->first();
        $http = new Client;
        $response = $http->request('POST', route('passport.token'), [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => $oClient->id,
                'client_secret' => $oClient->secret,
                'username' => $email,
                'password' => $password,
                'scope' => '*',
                'theNewProvider' => 'api-customers'
            ],
        ]);
        $result = json_decode((string) $response->getBody(), true);
        return $result;
    }
}
