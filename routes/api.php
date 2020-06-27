<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['guest:api']], function () {

    Route::get('/', function () {
        return 'Api running guess';
    });

    // Route::any('login', [LoginController::class, 'login']);
    Route::any('login', function (Request $request) {
        dd($request->all(6));
    });
});

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('/dados', function () {
        return 'Api running authenticated';
    });

    Route::any('logout', [LoginController::class, 'logout']);
});


/**
 * Converting Authorization Codes To Access Tokens
 * If the user approves the authorization request, they will be redirected back to the consuming application.
 *  The consumer should first verify the state parameter against the value that was stored prior to the redirect.
 * If the state parameter matches the consumer should issue a POST request to your application to request an access token.
 *  The request should include the authorization
 * code that was issued by your application when the user approved the authorization request.
 *  In this example, we'll use the Guzzle HTTP library to make the POST request:
 */
Route::get('/callback', function (Request $request) {
    $state = $request->session()->pull('state');

    throw_unless(
        strlen($state) > 0 && $state === $request->state,
        InvalidArgumentException::class
    );

    $http = new GuzzleHttp\Client;

    $response = $http->post(getenv('APP_URL') . '/oauth/token', [
        'form_params' => [
            'grant_type' => 'authorization_code',
            'client_id' => 'client-id',
            'client_secret' => 'client-secret',
            'redirect_uri' => getenv('APP_URL') . '/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string) $response->getBody(), true);
});



/**
 * #Redirecting For Authorization
 * Once a client has been created, you may use the client ID and the generated code verifier and code challenge to request an authorization code
 * and access token from your application. First, the consuming application should make a redirect request to your application's /oauth/authorize route:
 */
Route::get('/redirect', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    $request->session()->put('code_verifier', $code_verifier = Str::random(128));

    $codeChallenge = strtr(rtrim(
        base64_encode(hash('sha256', $code_verifier, true)),
        '='
    ), '+/', '-_');

    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => getenv('APP_URL').'/callback',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
        'code_challenge' => $codeChallenge,
        'code_challenge_method' => 'S256',
    ]);

    return redirect(getenv('APP_URL').'/oauth/authorize?' . $query);
});
