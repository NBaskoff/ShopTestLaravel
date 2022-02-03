<?php


namespace App\Http\Controllers\Api;


use App\Http\Requests\ApiPricesPost;
use App\Models\Items;
use App\Models\Price;

class Prices
{
    public function actionGet()
    {
        return Price::query()->paginate((int)request("count", 50000));
    }

    /**
     * @param ApiPricesPost $request
     * @param $id
     * @return mixed
     */
    public function actionPost(ApiPricesPost $request, $id)
    {
        $item = Items::query()->where("id", $id)->with("prices")->firstOrFail();
        return $item->updatePrices(request("prices"));

    }
}
