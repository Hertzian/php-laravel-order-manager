<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrdenesController extends Controller
{
    public function indexView(){
        $orders = Order::paginate(15);

        return view('index', [
            'ordenes' => $orders
        ]);
    }

    public function newOrder(Request $request){


        $this->validate($request,[
            'order' => 'required|max:150',
            'inventary' => 'required',
            'machinetype' => 'required',
            'keyword' => 'required',
            // 'file' => 'required'
        ]);

        $order = new Order();

        $order->order = $request->input('order');
        $order->inventary = $request->input('inventary');
        $order->machinetype = $request->input('machinetype');
        $order->keyword = $request->input('keyword');

        if ($request->file('file')) {
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $pdfFileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('file')->storeAs('public/file', $pdfFileNameToStore);
            $order->file = $pdfFileNameToStore;
        }

        $order->save();

        return redirect('/main')->with('message', 'Todo salió bien');
    }

    public function editOrder(Request $request, $machineId){
        $order = Order::find($machineId);

        $this->validate($request,[
            'order' => 'required|max:150',
            'inventary' => 'required',
            'machinetype' => 'required',
            'keyword' => 'required',
            'file' => 'mimetypes:application/pdf|max:10000'
        ]);

        $order->order = $request->input('order');
        $order->inventary = $request->input('inventary');
        $order->machinetype = $request->input('machinetype');
        $order->keyword = $request->input('keyword');

        if ($request->file('file')) {
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $pdfFileNameToStore = $fileName . '_' . time() . '.' . $extension;
            $path = $request->file('file')->storeAs('public/file', $pdfFileNameToStore);
            $order->file = $pdfFileNameToStore;
        }

        $order->update();

        return redirect('/main')->with('message', 'La orden se actualizó correctamente');
    }

    public function getPdf($machineId){
        $pdf = Order::find($machineId);

        if($pdf->file == '0' || $pdf->file == null || !$pdf->file){
            return redirect('/main')->with('error', "La maquina con el id $machineId no cuenta con ningun archivo.");
        }

        return response()->file('storage/file/' . $pdf->file);
    }

    public function machineDetail($machineId){
        $machine = Order::find($machineId);

        return view('machineView', [
            'maquina' => $machine
        ]);
    }

    public function deleteMachine($machineId){
        $order = Order::find($machineId);
        Storage::delete('storage/file/' . $order->file);
        $order->delete();

        return redirect('/main')->with('error', "La maquina con el id $machineId se ha eliminado.");
    }

    public function searchOrder(Request $request){
        $search = $request->get('searchOrder');

        $orders = DB::table('orders')->where('order', 'like', '%' . $search . '%')->paginate(5);

        return view('index', [
            'ordenes' => $orders
        ]);
    }

    public function searchInventary(Request $request){
        $search = $request->get('searchInventary');

        $inventary = DB::table('orders')->where('inventary', 'like', '%' . $search . '%')->paginate(5);

        return view('index', [
            'ordenes' => $inventary
        ]);
    }

    public function searchMachinetype(Request $request){
        $search = $request->get('searchMachinetype');

        $type = DB::table('orders')->where('machinetype', 'like', '%' . $search . '%')->paginate(5);

        return view('index', [
            'ordenes' => $type
        ]);
    }

}
