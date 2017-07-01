<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests\UserAuthRequest;
use App\User;
use Google;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Auth or Login
     *
     * @param UserAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function auth(UserAuthRequest $request)
    {
        try {
            $access_token    = $request->input('access_token');
            $googleProfile   = Google::getProfile($access_token);
            $profileModified = [
                'email'      => $googleProfile->email,
                'first_name' => $googleProfile->given_name,
                'last_name'  => $googleProfile->family_name,
                'picture'    => $googleProfile->picture
            ];
            $user            = User::firstOrCreate(['email' => $googleProfile->email], $profileModified);

            $contacts       = [];
            $resultContacts = Google::getContacts($access_token);
            foreach ($resultContacts['feed']['entry'] as $entry) {
                if (array_key_exists('gd$email', $entry)) {
                    $contacts[] = $entry['gd$email'][0]['address'];
                }

                if (array_key_exists('gd$phoneNumber', $entry)) {
                    $contacts[] = $entry['gd$phoneNumber'][0]['$t'];
                }
            }

            $userContacts = $user->contacts;

            foreach ($contacts as $contact) {
                if (!$userContacts->where('data', $contact)->count()) {
                    Contact::create([
                        'user_id' => $user->id,
                        'data' => $contact
                    ]);
                }
            }

            Auth::attempt(['email'=>$user->email,'password'=>null]);

            return response()->json($user);

        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    /**
     * Show Home Page
     *
     * @param Request $request
     * @return mixed
     */
    public function homePage(Request $request)
    {
        return View::make('welcome');
    }
}
