<?php
namespace Mongi\Mongicommerce\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Mongi\Mongicommerce\Http\Controllers\Controller;
use Mongi\Mongicommerce\Models\GiftCode;
use Mongi\Mongicommerce\Models\ProductItem;

class AdminGiftCardValidationController extends Controller
{
    public function page(){
        return view('mongicommerce::admin.pages.gift-card.gift_card');
    }

    public function giftValidation(Request $r){

        $r->validate([
           'gift_card_code' => 'required'
        ]);

        $input_code = $r->get('gift_card_code');
        $gift_code = GiftCode::where('code', $input_code)->whereNotNull('bought_the');
        if($gift_code->count() == 0){
            return ['error' => "Gift card non esistente"];
        }else{
            $gift_code = $gift_code->first();
            $product_item = ProductItem::find($gift_code->product_item_id);
            $is_valid = true;
            $message = 'Gift card validata correttamente';
            if($gift_code->is_validated){
                $is_valid = false;
                $message = 'La gift card è stata già utilizzata';
            }else if(!$gift_code->is_validated and Carbon::parse($gift_code->expires_on)->isBefore(Carbon::now())){
                $is_valid = false;
                $message = "La gift card è scaduta";
            }else{
                //set validation field on true into the db
                $gift_code->is_validated = true;
                $gift_code->save();
            }

            $gift_info[] = [
                'name' => $product_item->name,
                'price' => $product_item->price,
                'bought_the' => Carbon::parse($gift_code->bought_the)->format('d/m/Y'),
                'expiration_date' => Carbon::parse($gift_code->expires_on)->format('d/m/Y'),
                'duration' => $gift_code->duration,
                'is_valid' => $is_valid,
                'message' => $message
            ];

            return response()->json($gift_info);
        }

    }
}
