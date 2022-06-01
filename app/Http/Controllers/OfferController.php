<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index(){
        /*$offers = Offer::all();
        return view('offers.index',compact('offers'));*/
        $offers = Offer::with(['appointments', 'user'])
            ->get();
        return $offers;
    }

    public function show(Offer $offer){
        $offer = Offer::find($offer);
        return view('offers.show', compact('offer'));
    }

    public function findById(string $id) : Offer {
        $offer = Offer::where('id', $id)
            ->with(['appointments', 'user'])
            ->first();
        return $offer;
    }

    public function findBySearchTerm(string $searchTerm) {
        $offer = Offer::with(['appointments', 'user'])
            ->where('subject', 'LIKE', '%' . $searchTerm. '%')
            ->orWhere('description' , 'LIKE', '%' . $searchTerm. '%')
            /* search term in authors name */
            ->get();
        return $offer;
    }

    public function save(Request $request) : JsonResponse{

        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $offer = Offer::create($request->all());

            // save appointments
            if (isset($request['appointments']) && is_array($request['appointments'])){
                foreach ($request['appointments'] as $appoint) {
                    $appointment = Appointment::firstOrNew([
                        'date' => $appoint['date'],
                        //'isAccepted' => $appoint['isAccepted']
                    ]);
                    $offer->appointments()->save($appointment);
                }
            }
            DB::commit();
            $newOffer = Offer::where('id', $offer->id)->with(['appointments', 'user'])->first();
            return response()->json($newOffer, 201);
        }
        catch (\Exception $e){
            DB::rollBack();
            return response()->json("saving offer failed:" .
                $e->getMessage(),420);
        }
    }

    public function update(Request $request, string $id) : JsonResponse
    {

        DB::beginTransaction();
        try {
            $offer = Offer::with(['appointments', 'user'])
                ->where('id', $id)->first();
            if ($offer != null) {
                $request = $this->parseRequest($request);
                $offer->update($request->all());

                //delete all old images
                $offer->appointments()->delete();
                // save images
                if (isset($request['appointments']) && is_array($request['appointments'])){
                    foreach ($request['appointments'] as $appoint) {
                        $appointment = Appointment::firstOrNew([
                            'date' => $appoint['date'],
                            //'isAccepted' => $appoint['isAccepted']
                        ]);
                        $offer->appointments()->save($appointment);
                    }
                }
                $offer->save();

            }
            DB::commit();
            $offer1 = Offer::with(['appointments', 'user'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($offer1, 201);
        }
        catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating offer failed: " .
                $e->getMessage(), 420);
        }
    }

    public function delete(string $id) : JsonResponse
    {
        $offer = Offer::where('id', $id)->first();
        if ($offer != null) {
            $offer->delete();
        }
        else
            throw new \Exception("offer couldn't be deleted - it does not exist");
        return response()->json('offer (' . $id . ') successfully deleted', 200);

    }

    private function parseRequest(Request $request) : Request {
// get date and convert it - its in ISO 8601, e.g. "2018-01-01T23:00:00.000Z"
        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }
}
