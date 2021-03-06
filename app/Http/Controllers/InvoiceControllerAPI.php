<?php
namespace App\Http\Controllers;
use App\Invoice;
use App\Meals;
use Illuminate\Http\Request;
use App\Http\Resources\Invoice as InvoiceResource;
use DB;
class InvoiceControllerAPI extends Controller
{
 
    public function getInvoices(Request $request)
    {
        return InvoiceResource::collection(Invoice::all());
    }
 
    public function showInvoice(Request $request, $id){
        $items = Invoice::findOrFail($id);
 
        $items = DB::table('invoice_items')
            ->join('items', 'invoice_items.item_id', '=', 'items.id')
            ->select('invoice_items.quantity', 'invoice_items.unit_price', 'invoice_items.sub_total_price', 'items.name')
            ->where('invoice_items.invoice_id', $id)->get();
         return $items;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
                'name' => 'required|min:3|regex:/^[A-Za-záàâãéèêíóôõúçÁÀÂÃÉÈÍÓÔÕÚÇ ]+$/',
                'nif' => 'required|min:8|max:9',
                'state' => 'required'
            ]);
        $invoice = Invoice::findOrFail($id);
        $invoice->update($request->all());
        return new InvoiceResource($invoice);
    }
 
}