<?php
namespace Database\Seeders;
use App\Models\Offer;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $offer = new \App\Models\Offer;
        $offer->subject = 'Objektorientierte Programmierung';
        $offer->description = 'Alles über die Objektorientierte Programmierung';


        /*DB::table('offers')->insert([
            'subject' => "Corporate Design",
            'description' => "Grundlagen zu Corporate Design"
        ]);*/

        $user = \App\Models\User::all()->first();
        $offer->user()->associate($user);
        $offer->save();

        $appointment1 = new \App\Models\Appointment;
        $appointment1->date = new DateTime('now');

        $appointment2 = new \App\Models\Appointment;
        $appointment2->date = new DateTime('now');

        $offer->appointments()->saveMany([$appointment1, $appointment2]);
        $offer->save();
    }
}
