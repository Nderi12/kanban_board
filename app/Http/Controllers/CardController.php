<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get cards
        $cards = Card::all();

        // return a json response to api
        return response()->json([
            'cards' => $cards
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function() use($request) {
            Card::create([
                'title' => $request->title,
                'column_id' => $request->column_id
            ]);
        });

        return response()->json([
            'message' => "Card Created Successfully"
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::where('id', $id)->first();

        return response()->json([
            'card' => $card
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $card = Card::where('id', $id)->first();

        DB::transaction(function() use($card, $request) {
            $card->update([
                'title' => $request->title,
            ]);
            $card->save();
        });


        return response()->json([
            'message' => 'Card Successfully Updated!'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $card = Card::where('id', $id)->first();

        //  Delete the card
        $card->delete();

        // Return response message
        return response()->json([
            'message' => 'Card deleted successfully!'
        ], Response::HTTP_OK);
    }
}

