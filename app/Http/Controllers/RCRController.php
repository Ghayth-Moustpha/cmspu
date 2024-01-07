<?php
namespace App\Http\Controllers;
use App\Models\RCR;
use App\Models\Need;
use App\Models\User;
use App\Models\Project;

use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\RCRStoreRequest;
    use Illuminate\Auth\Access\AuthorizationException;
    use Illuminate\Http\JsonResponse; 

    class RCRController extends Controller
    {
        public function index(Request $request ,   $statusID , $projectID)
        {
            $rcrs = RCR::where('status_id', $statusID)->whereIn('need_id', function ($query) use ($projectID) {
                $query->select('id')
                    ->from('needs')
                    ->where('project_id', $projectID);
            })->paginate(5); 
            
            return $rcrs;
        }

        public function store (RCRStoreRequest $request)
        {

            try {
                $validatedData = $request->validated();
                $user = $request->user () ;  
                
                $needID = $validatedData["need_id"];
                $need = Need::find ($needID) ; 
                $rcr = RCR::create($validatedData); //Create the RCR 
                $need = $rcr->need;
                $need->need_status_id  = 3; // convert the need to Argument Status 
                $need->save();
                return response()->json(['rcr' => $rcr], 201); // Proccess has been done successfully

         } catch (AuthorizationException $exception) {
            $validatedData = $request->validated(); 
            $needID = $validatedData["need_id"];
            $need = Need::find ($needID) ; 
            return $need ;
         return new JsonResponse(['error' => 'You dont have permission to request an update for this need'], 401);
    }
     }

        public function show(Request  $req , $id )
        {
            $user = $req->user ; 
            $rcr = RCR::find($id);
            return response()->json(['rcr' => $rcr], 200);
        }

    

        public function update(Request $request, RCR $rcr)
        {
            $validatedData = $request->validate([
                'need_id' => 'required',
                'title' => 'required|max:255',
                'description' => 'required',
                'status_id' => 'required',
                'result' => 'required',
                'cost' => 'required|integer',
            ]);

            $rcr->update($validatedData);

            return response()->json(['rcr' => $rcr], 200);
        }
    public function result (Request $request , $id  ){
        $validatedData = $request->validate([
            'result' => 'required',
            'cost' => 'required|integer',
          ]);
          
          $rcr = RCR::find($id);
          
          if ($rcr) {
            $rcr->result = $validatedData['result'];
            $rcr->cost = $validatedData['cost']; 
            $rcr->status_id = 3 ;
            $rcr->save();
          }


    }   
    public function  Accepted (Request $req , $id ) {
        $rcr = RCR::find($id);
        if ($rcr) {
            $rcr->result ="Accepted Directrly with No cost";
            $rcr->cost = 0 ; 
            $rcr->status_id = 4  ;
            $rcr->save();
          }

    }
    public function  Declined (Request $req , $id ) {
        $rcr = RCR::find($id);
        if ($rcr) {
            $rcr->result = "Decliend  Directrly Imposible to Proccess ";
            $rcr->cost = 0 ; 
            $rcr->status_id = 5  ;
            $rcr->save();
          }

    }
        public function destroy(RCR $rcr)
        {
            $rcr->delete();

            return response()->json(['message' => 'RCR deleted successfully'], 200);
        }
    }