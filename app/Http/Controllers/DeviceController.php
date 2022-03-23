<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Calculate controller
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function calculate(Request $request){
        if($request->has(["devise1", "devise2", "amount1", "amount2"])){
            $devise1 = $request->post("devise1");
            $devise2 = $request->post("devise2");
            if(!$this->deviseIsValide($devise1) || !$this->deviseIsValide($devise2)){
                session()->flash("alert.error", "Une devise renseigné n'est pas valide.");
            }else{
                $amount1 = $request->post("amount1");
                $amount2 = $request->post("amount2");
                if(!is_numeric($amount1) || !is_numeric($amount2)){
                    session()->flash("alert.error", "Un montant n'est pas un nombre.");
                }else{
                    $statement = $amount1 . " " . $devise1 . " + " . $amount2 . " " . $devise2;
                    if($devise1 == $devise2){
                        $total = $amount1 + $amount2;
                        $this->sendMail($statement, $total);
                        return view("calculate", [
                            "statement" => $statement,
                            "outcome" => $total . " " . $devise1
                        ]);
                    }else{
                        if($devise1 != "euro")
                            $amount1 = $this->dollarsToEuro($amount1);
                        if($devise2 != "euro")
                            $amount2 = $this->dollarsToEuro($amount2);
                        $total = $amount1 + $amount2;
                        $this->sendMail($statement, $total);
                        return view("calculate", [
                            "statement" => $statement,
                            "outcome" => $total . " euros"
                        ]);
                    }
                }
            }
        }else{
            session()->flash("alert.error", "Tous les champs sont requis.");
        }
    }

    /**
     * Check if devise is valid
     * @param String $devise Devise name
     * @return bool If is valid
     */
    private function deviseIsValide(String $devise){
        return $devise == "euro" || $devise == "dollars";
    }

    /**
     * Convert Dollars to Euro
     * @param $amount double Amount in dollars devise
     * @return float Amount in euro devise
     */
    private function dollarsToEuro($amount){
        return $amount * 0.9;
    }

    /**
     * Send an email following a calculation
     * @param $statement String calculation statement
     * @param $total String result of the calculation
     * @return void
     */
    private function sendMail($statement, $total){
        mail("william.aventin@elesia.org", "Votre calcul",
        "Vous avez réalisé un calcul sur votre outil: " . $statement . " = " . $total);
    }
}
