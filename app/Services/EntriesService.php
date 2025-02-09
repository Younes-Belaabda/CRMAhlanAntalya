<?php

    namespace App\Services;

    class EntriesService {
        public static function getIdLastNotes($user){
            $notes = $user->notes;
            $movements = [];

            foreach($notes as $key => $note){
                foreach($note->movements as $m){
                    $movements[$key][] = \App\Models\Movement::find($m->movement_id) ?? null;
                }
            }

            $final_mv = [];


            foreach($movements as $mv){
                $big_movement   = current($mv);
                foreach($mv as $movement){
                    if(\Carbon\Carbon::parse($big_movement->date)->lessThanOrEqualTo(\Carbon\Carbon::parse($movement->date)) && $movement->to_date == null){
                        $big_movement = $movement;
                    }elseif(\Carbon\Carbon::parse($big_movement->date)->lessThanOrEqualTo($movement->date) && \Carbon\Carbon::parse($big_movement->date)->lessThanOrEqualTo($movement->to_date)){
                        $big_movement = $movement;
                    }
                }
                $final_mv[] = $big_movement;
            }

            return collect($final_mv)->pluck('movement_id')->toArray() ?? [];
        }

        public static function getLastIdNote($id){
            $note_id = \App\Models\MovementNote::where('movement_id' , $id)->first()->note_id;
            $movements = \App\Models\MovementNote::where('note_id' , $note_id)->pluck('id')->toArray();
            $movements = implode(',' , $movements);
            return $movements;
        }
    }
