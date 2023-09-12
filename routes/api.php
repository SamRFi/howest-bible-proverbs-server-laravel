<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BibleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InsightController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/**
 * @OA\Get(
 *      path="/proverbs/{chapter_number}",
 *      operationId="getChapter",
 *      tags={"Bible"},
 *      summary="Get a specific chapter from the bible",
 *      description="Returns a chapter object",
 *      @OA\Parameter(
 *          name="chapter_number",
 *          description="Chapter number",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *      ),
 *      @OA\Parameter(
 *          name="language",
 *          description="Language code (optional)",
 *          required=false,
 *          in="query",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\JsonContent(ref="#/components/schemas/Chapter")
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 *      @OA\Response(response=404, description="Chapter not found"),
 * )
 */
Route::get('/proverbs/{chapter_number}', [BibleController::class, 'getChapter']);


/**
 * @OA\Post(
 *      path="/register",
 *      operationId="register",
 *      tags={"Authentication"},
 *      summary="Register a new user",
 *      description="Registers a new user and returns a success message",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful registration",
 *          @OA\JsonContent(ref="#/components/schemas/SuccessMessage")
 *       ),
 *      @OA\Response(response=400, description="Bad request"),
 * )
 */
Route::post('register', [AuthController::class, "register"]);

/**
 * @OA\Post(
 *      path="/login",
 *      operationId="login",
 *      tags={"Authentication"},
 *      summary="Authenticate a user",
 *      description="Authenticates a user and returns a success message and token",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful login",
 *          @OA\JsonContent(ref="#/components/schemas/SuccessMessage")
 *       ),
 *      @OA\Response(response=401, description="Invalid credentials"),
 * )
 */
Route::post('login', [AuthController::class, "login"]);

Route::middleware('auth:api')->group(function() {
    /**
     * @OA\Post(
     *      path="/insights",
     *      operationId="addInsight",
     *      tags={"Insights"},
     *      summary="Add a new insight",
     *      description="Adds a new insight and returns the created insight object",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AddInsightRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Insight added successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Insight")
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     * )
     */
    Route::post("/insights", [InsightController::class, "addInsight"]);

    /**
     * @OA\Get(
     *      path="/insights",
     *      operationId="getInsights",
     *      tags={"Insights"},
     *      summary="Get insights for the authenticated user",
     *      description="Returns a list of insights for the authenticated user",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Insight"))
     *       ),
     * )
     */
    Route::get("/insights", [InsightController::class, "getInsights"]);

    /**
     * @OA\Put(
     *      path="/insights/{id}",
     *      operationId="updateInsight",
     *      tags={"Insights"},
     *      summary="Update an existing insight",
     *      description="Updates an existing insight and returns the updated insight object",
     *      @OA\Parameter(
     *          name="id",
     *          description="Insight ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateInsightRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Insight updated successfully",
     *          @OA\JsonContent(ref="#/components/schemas/Insight")
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Insight not found"),
     * )
     */
    Route::put('/insights/{id}', [InsightController::class, 'updateInsight']);

    /**
     * @OA\Delete(
     *      path="/insights/{id}",
     *      operationId="deleteInsight",
     *      tags={"Insights"},
     *      summary="Delete an insight",
     *      description="Deletes an insight and returns a success message",
     *      @OA\Parameter(
     *          name="id",
     *          description="Insight ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Insight deleted successfully",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessMessage")
     *       ),
     *      @OA\Response(response=404, description="Insight not found"),
     * )
     */
    Route::delete('/insights/{id}', [InsightController::class, 'deleteInsight']);

    /**
     * @OA\Post(
     *      path="/logout",
     *      operationId="logout",
     *      tags={"Authentication"},
     *      summary="Logout the authenticated user",
     *      description="Logs out the authenticated user and invalidates their token",
     *      @OA\Response(
     *          response=200,
     *          description="Successful logout",
     *          @OA\JsonContent(ref="#/components/schemas/SuccessMessage")
     *       ),
     *      @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('login', function () {
    return response('Login failed', 401);
})->name('login');
