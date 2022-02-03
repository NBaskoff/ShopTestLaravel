<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory, UsesUuid;

    protected $table = "items";

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function updatePrices($prices)
    {
        $ids = $this->prices()->pluck("id", "id")->toArray();
        foreach ($prices as $k => $i) {
            $this->prices()->updateOrCreate(["id" => $i["guid"]], ["price" => (float)$i["price"]])->save();
            unset($ids[$i["guid"]]);
        }
        $this->prices()->whereIn("id", $ids)->delete();
        $this->load("prices");
        return $this;
    }

}
