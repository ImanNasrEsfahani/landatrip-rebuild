<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketRecord;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = User::whereHasRole('user')->orWhereHasRole('teacher')->get();
        $admin = User::whereHasRole('admin')->first();

        foreach ($users as $user) {
            for ($i=0; $i < random_int(1,4); $i++) {
                if($user->hasRole('user')) {
                    $ticketObj = Ticket::factory()->makeOne();
                    $ticketObj->user()->associate($user);
                    $ticketObj->assignedUser()->associate($admin);
                    $ticketObj->withoutEvents(function () use ($ticketObj) {
                        $ticketObj->id = $ticketObj->newUniqueId();
                        $ticketObj->save();
                    });

                    if($ticketObj->status !== "new") {
                        for($j=0; $j< rand(5,9); $j++) {
                            $ticketRecord = TicketRecord::factory()->makeOne();
                            $ticketRecord->ticket()->associate($ticketObj);
                            if ($j%2 ===0) {
                                $ticketRecord->user()->associate($ticketObj->user()->first());
                            } else {
                                $ticketRecord->user()->associate($admin);
                            }
                            $ticketRecord->withoutEvents(function () use ($ticketRecord) {
                                $ticketRecord->id = $ticketRecord->newUniqueId();
                                $ticketRecord->save();
                            });
                        }
                    }
                }
            }
        }

    }
}
