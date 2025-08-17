<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\ConversationRecord;
use App\Models\TicketRecord;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {

            for ($i=0; $i < 15; $i++) {
                $randomUserObj = User::where("id", "<>", $user->id)->inRandomOrder()->first();
                if(!(Conversation::where("user_id", "=", $user->id)->where("assigned_by", "=", $randomUserObj->id)->first()||
                    Conversation::where("user_id", "=", $randomUserObj->id)->where("assigned_by", "=", $user->id)->first())) {
                    $communicationObj = new Conversation([
                        "title"     =>  "salam jafar",
                    ]);
                    $communicationObj->user()->associate($user);
                    $communicationObj->assignBy()->associate($randomUserObj);
                    $communicationObj->save();

                    for ($i=0; $i < random_int(5,9); $i++) {
                        $communicationRecordObj=ConversationRecord::factory()->makeOne();
                        $communicationRecordObj->conversation()->associate($communicationObj);
                        $users = array($user, $randomUserObj);
                        $communicationRecordObj->user()->associate($users[array_rand($users)]);
                        $communicationRecordObj->withoutEvents(function () use ($communicationRecordObj) {
                            $communicationRecordObj->id = $communicationRecordObj->newUniqueId();
                            $communicationRecordObj->save();
                        });
                    }
                }
            }
        }

    }
}
