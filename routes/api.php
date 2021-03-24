<?php

use App\Adapters\MeliAdapter;
use App\Adapters\MeliAuthorizationServiceAdapter;
use App\Adapters\MeliEnvironmentAdapter;
use App\Http\Controllers\Syncs\WooToMeliOrderController;
use App\Http\Controllers\Syncs\WooToMeliProductController;
use App\Http\Controllers\WoocommerceCredential;
use Dsc\MercadoLivre\Announcement;
use Dsc\MercadoLivre\Announcement\Item;
use Dsc\MercadoLivre\Announcement\Picture;
use Dsc\MercadoLivre\Meli;
use Dsc\MercadoLivre\Requests\Product\ProductService;
use Dsc\MercadoLivre\Resources\Authorization\AuthorizationService;
use Dsc\MercadoLivre\Resources\User\UserService;
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

Route::prefix('wc')
    ->middleware('auth:sanctum')
    ->group(function() {}); // TODO: Add REST to interact with integrated products

//Route::prefix('wc/webhook')
//    ->middleware(['woocommerce-webhook', 'auth:sanctum'])
//    ->group(function() {
//
//        Route::apiResource('/', WoocommerceWebhookController::class);
//    });

Route::get('/meli/get_access_token', function() {
    $meli = new Meli(
        env('MELI_ID'),
        env('MELI_SECRET')
    );
    $service = new AuthorizationService($meli);

    echo $service->getAccessToken();

//    if(isset($_GET['code'])) {
//        $service->authorize($_GET['code'], env('MELI_CALLBACK'));
//        return redirect('/api/meli');
//    }
//
//    echo '<br><br><a href="' . $service->getOAuthUrl(env('MELI_CALLBACK')) . '">Login using MercadoLibre oAuth 2.0</a>';
});

Route::get('/meli/authorize_access', function () {
    $meli = new Meli(
        env('MELI_ID'),
        env('MELI_SECRET'),
        new MeliEnvironmentAdapter()
    );
    $service = new MeliAuthorizationServiceAdapter($meli);

    if(isset($_GET["code"]) && isset($_GET["state"])) {
        return $service->authorize($_GET['code'], env('MELI_CALLBACK'));
    }

    echo '<a href="' . $service->getOAuthUrl(env('MELI_CALLBACK')) . '">Login using MercadoLibre oAuth 2.0</a>';
});

Route::get('/meli/user', function() {
    $meli = new Meli(
        env('MELI_ID'),
        env('MELI_SECRET')
    );
    $user = new UserService($meli);


    return $user->getInformationUserById();
});

Route::get('/meli/get/{id}', function ($id) {
    $meli = new Meli(
        env('MELI_ID'),
        env('MELI_SECRET')
    );
    $service = new ProductService($meli);

    dd($service->findProduct($id));
});

Route::get('/meli', function () {
    $meli = new Meli(
        env('MELI_ID'),
        env('MELI_SECRET')
    );

    $item = new Item();
    $item->setTitle('Test item - no offer')
        ->setCategoryId('MLB413190')
        ->setPrice(100)
        ->setCurrencyId('BRL')
        ->setAvailableQuantity(1)
        ->setBuyingMode('buy_it_now')
        ->setListingTypeId('free')
        ->setCondition('new')
        ->setDescription('Test item - no offer');

    // Imagem do Produto
    $picture = new Picture();
    $picture->setSource('http://mla-s2-p.mlstatic.com/968521-MLA20805195516_072016-O.jpg');
    $item->addPicture($picture); // collection de imagens

    $announcement = new Announcement($meli);
    $response = $announcement->create($item);

    dd($response);
});


Route::group(['prefix' => 'woocommerce'], function() {

    /**
     * Route to save clients tokens and create webhooks.
     */
    Route::post('/credential', [WoocommerceCredential::class, 'store'])->name('woocommerce.credential');

    /**
     * Routes to receive updates from woocommerce webhooks
     */
    Route::post('/products', [WooToMeliProductController::class, 'update'])
        ->name('woocommerce.webhook.product')
        ->middleware(['woocommerce-webhook']);

    Route::post('/orders', [WooToMeliOrderController::class, 'update'])
        ->name('woocommerce.webhook.order')
        ->middleware(['woocommerce-webhook']);
});
