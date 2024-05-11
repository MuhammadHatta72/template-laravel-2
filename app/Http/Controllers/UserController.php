<?php

namespace App\Http\Controllers;

use App\Models\AidRecipient;
use App\Models\AidRecipientsCriteria;
use App\Models\Criteria;
use App\Models\PairwiseMatrice;
use App\Models\PairwiseMatriceSubCriteria;
use App\Models\SubCriteria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function aid_recipients()
    {
        $aid_recipients = AidRecipientsCriteria::all();
        return view('user.aid_recipients.index', compact('aid_recipients'));
    }

    public function aid_recipient_show($aid_recipient)
    {
        $aidRecipientCriteria = AidRecipientsCriteria::find($aid_recipient);
        $criteriaAidRecipient = json_decode($aidRecipientCriteria->values);
        $criterias = Criteria::all();
        return view('user.aid_recipients.show', compact('aidRecipientCriteria', 'criterias', 'criteriaAidRecipient'));
    }

    public function criterias()
    {
        $criterias = Criteria::all();
        return view('user.criterias.index', compact('criterias'));
    }

    public function subcriterias()
    {
        $subcriterias = SubCriteria::all();
        return view('user.sub_criterias.index', compact('subcriterias'));
    }

    public function pairwise_matrices()
    {
        $pairwiseMatrices = PairwiseMatrice::all();
        $criterias = Criteria::all();
        return view('user.pairwise_matrices.index', compact('pairwiseMatrices', 'criterias'));
    }

    public function results()
    {
        $pairwiseMatriceSubCriterias = PairwiseMatriceSubCriteria::all();
        $criterias = Criteria::all();
        $aidRecipientsCriteria = AidRecipientsCriteria::all();
        return view('survey_officer.result.index', compact('pairwiseMatriceSubCriterias', 'criterias', 'aidRecipientsCriteria'));
    }

    public function printResult(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $rankings = json_decode($request->ranking, true);
        $aidRecipientsCriteria = AidRecipientsCriteria::all();
        $pdf = Pdf::loadView('pdf.hasil_topsis', compact('rankings', 'aidRecipientsCriteria'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('Data Penerima Bantuan ' . date('Y-m-d H:i:s') . '.pdf');
    }
}
