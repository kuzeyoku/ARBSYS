<?php

namespace App\Services\Document;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Lawsuit\Lawsuit;

class ArbiterDefineProtocolService
{
    public static function replaceKeywords(Request $request, Lawsuit $lawsuit)
    {
        $list = array(
            "@UyusmazlikTuru" => $lawsuit->subjectType,
            "@UyusmazlıkKonu" => $lawsuit->subject,
            "@TeslimEdenAdSoyad" => $request->arbiter_define_protocol_answer == 0 ? $request->arbiter_name : auth()->user()->name,
            "@TeslimEdenTCKNo" => $request->arbiter_define_protocol_answer == 0 ? $request->arbiter_tc : auth()->user()->mediator->registration_no,
            "@BugunTarih" => Carbon::now()->format('d.m.Y'),
            "@ArabulucuSicilNo" => auth()->user()->mediator->registration_no,
            "@ArabulucuAdSoyad" => auth()->user()->name,
        );

        $find = array_keys($list);
        $replace = array_values($list);
        $side_ids = $lawsuit->sides()->pluck('id')->toArray();
        $data = view('mediator.document.arbiter_define_protocol.template', compact("lawsuit", "side_ids"))->render();

        return str_ireplace($find, $replace, $data);
    }
}
