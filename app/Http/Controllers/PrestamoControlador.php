<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Prestamo;
use App\Models\PagosRealizados;
use Carbon\Carbon;

class PrestamoControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $prestamos = Prestamo::with('client')->get();
        return response()->json($prestamos);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $name = Client::pluck('id','name');
        $names = $name->all();
        return view ('prestamos.create', [
            'names' => $names
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prestamo = new Prestamo();
        $prestamo->client_id = $request->client_id;
        $prestamo->amount = $request->fee * $request->payments_number;
        $prestamo->payments_number = $request->payments_number;
        $prestamo->fee = $request->fee;
        $prestamo->ministry_date = $request->ministry_date;
        $count = 0;

        $date = Carbon::createFromDate($prestamo->ministry_date); 
        while($count < $prestamo->payments_number)
        {
            $date->addDay();
            if($date->isWeekday()) 
            {
                $prestamo->due_date = $date;
                $count++;
            }
        }
        $prestamo->save();
        $count = 0;
        while($count < $prestamo->payments_number)
        {
            $date->addDay();
            if($date->isWeekday())
            {
                $pago = new PagosRealizados();
                $pago->client_id = $prestamo->client_id;
                $pago->prestamo_id = $prestamo->id;
                $pago->number = $count+1;
                $pago->amount = $prestamo->fee;
                $pago->received_amount = 0;
                $pago->payment_date = $date;
                $pago->save();
                $count++;
            }
        }
        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $nombres = Client::select('id','name')->get();
        return response()->json($nombres);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id);
        foreach($prestamo->pagos as $pago)
        {
            $pago->delete();
        }
        $prestamo->delete();
    }
}