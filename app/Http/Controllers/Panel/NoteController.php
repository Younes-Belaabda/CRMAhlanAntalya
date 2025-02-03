<?php

namespace App\Http\Controllers\Panel;

use App\User;
use Validator;
use Carbon\Carbon;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use App\Models\{Income , Movement, MovementUser, Countries, Notification, NotificationUser, Debt};

class NoteController extends Controller
{

    public function all(Request $request){
        $items = collect();
        $data = User::orderby("type" , "ASC");

        if(isset($request->type) && $request->type != null){
            //$data = $data->where("type" , $request->type);
        }else{
            $request["type"] = 1;
        }

        $data = $data->get();
        foreach($data as $item){
            if($item->type == 3){

                $incs =  Income::where("for_id",$item->id)->where("price_type","$")->whereNull("movement_id")->get();
                $b1 = 0;
                $b2 = 0;
                foreach($incs as $inc){
                    if($inc->movement_id == null && $inc->type == "Income"){
                        $b1 += $inc->price;
                    }else{
                        $b1 -= $inc->price;
                    }
                }


                $moves =  Movement::wherehas("users" , function (Builder $query) use($item){
                    $query->where("id" , $item->id);
                })
                ->where("price_type" , "$");
                $t1 = $moves;
                $t2 = $moves;
                $t2 = $t2->sum("revenue_partner");
                $t1 = $t1->where("paybyus" , "1")->sum("price");


                // if($moves->count() == 0){
                //     $movesw =  Movement::wherehas("users" , function (Builder $query) use($item){
                //         $query->where("id" , $item->id);
                //     })
                //     ->where("status","1")
                //     ->where("price_type" , "$")->sum("revenue_partner");
                //     $t2 = $t2 - $movesw;
                // }

                $item->blance = ($b1+$t2)-($b2+$t1);
            }
        }

        $request = $request->all();
        $user_type = collect();
        $user_type->push("Driver","Agent","Vendor","Partner");

        return view('panel.notes.all' , compact('data','user_type','request'));
    }

    public function show(User $user){
        $notes = $user->notes;
        return view('panel.notes.show' , compact('user' , 'notes'));
    }

    public function show_movements(User $user , $movements = []){
        $n = explode(',' , $movements)[0];
        // dd($n);
        $movements = \App\Models\MovementNote::whereIn('id' , explode(',' , $movements))->pluck('movement_id')->toArray();


        $note = \App\Models\MovementNote::where('id' , $n)->first()->note;

        // dd($note);
        $movements = \App\Models\Movement::whereIn('movement_id' , $movements)->get();

        return view('panel.notes.show_movements' , compact('user' , 'movements' , 'note'));
    }

    public function create(Request $request){
        $entries = $request->entries;
        $movements = \App\Models\Movement::whereIn('movement_id' , explode(',' , $entries))->get();


        return view('panel.notes.view' , compact('movements' , 'entries'));
    }

    public function store(Request $request){


        $note = \App\Models\Note::create([
            'content' => $request->content,
            'user_id' => $request->user_id
        ]);
        // dd($note);
        $ids = [];
        foreach(explode(',' , $request->entries) as $item){
            $mvnote = \App\Models\MovementNote::create([
                'movement_id' => $item,
                'note_id' => $note->id
            ]);

            $ids[] = $mvnote->id;
        }

        // dd($ids);

        return redirect()->route('panel.notes.show_movements' , [
            'user' => $note->user_id,
            'movements' => implode(',' , $ids)
        ])

        ->with('success' , __('Success Note Createad'));
        // return back()->with('success' , __('Success Note Createad'));
    }

    public function update(Request $request , Note $note){


        $data['content'] = $request->content;
        $data['is_finished'] = false;

        if($request->has('is_finished')){
            $data['is_finished'] = true;
        }

        $note->update($data);

        return back()->with('success' , __('Success Note Updated'));
    }
}
