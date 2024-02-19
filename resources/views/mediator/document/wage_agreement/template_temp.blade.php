<div class="page-title">
    ARABULUCULUK ÜCRET SÖZLEŞMESİ
</div>
<div class="template" identifier="template">
    <table>
        @if($claimants->first()->lawsuit->delivery_by == "Sistem Üzerinden")
            <tr>
                <td>
                    @if($claimants->first()->lawsuit->lawsuit_type_id == 1 || $claimants->first()->lawsuit->lawsuit_type_id == 3)
                        ARB. BÜROSU
                    @else
                        ARB. MERKEZİ
                    @endif
                </td>
                <td>:</td>
                <td>
                    @if($claimants->first()->lawsuit->lawsuit_type_id == 1 || $claimants->first()->lawsuit->lawsuit_type_id == 3)
                        @ArabuluculukBurosu Arabuluculuk Bürosu
                    @else
                        @ArabuluculukBurosu Arabuluculuk Merkezi
                    @endif
                </td>
            </tr>
            <tr>
                <td>BAŞVURU DOSYA NO</td>
                <td>:</td>
                <td>@BasvuruDosyaNo</td>
            </tr>
        @endif
        <tr>
            <td>ARB. DOSYA NO</td>
            <td>:</td>
            <td>@ARBDosyaNo</td>
        </tr>
        @include('backend.document.partials.sides', compact('claimants','defendants'))
        <tr>
            <td>UYUŞMAZLIK KONUSU</td>
            <td>:</td>
            <td>@UyusmazlikKonu</td>
        </tr>
        <tr>
            <td>SÖZLEŞME KONUSU</td>
            <td>:</td>
            <td class="requiredField">Anlaşma nedeniyle arabuluculuk ücretinin belirlenmesi hk. (Arabuluculuk sürecine ilişkin bilgilendirme tutanağının eki niteliğindedir.)</td>
        </tr>
    </table>
    <br><br>
    @if($request->wage_type == "side")
        <p class="paragraph">
            Taraflar arasındaki arabuluculuk görüşmeleri neticesinde taraflar konusu para olmayan veya para ile ölçülemeyen bir uyuşmazlık hakkında anlaşmaya varmışlardır.
        </p>
    @elseif($request->wage_type == "aaut" && $request->money == "yes")
        <p class="paragraph">
            Taraflar arasındaki arabuluculuk görüşmeleri neticesinde taraflar konusu para olan veya para ile ölçülebilen bir uyuşmazlık hakkında anlaşmaya varamamışlardır.
        </p>
    @elseif($request->wage_type == "aaut" && $request->money == "no")
        <p class="paragraph">
            Taraflar arasındaki arabuluculuk görüşmeleri neticesinde taraflar konusu para olmakla birlikte uyuşmazlık hakkında anlaşmaya varamamışlar ancak görüşmeler {{ \App\Services\LawsuitService::numberToText($request->hour) }} saati aşmıştır.
        </p>
    @endif
    <p class="paragraph">
        Bu sebeple arabulucuya ödenmesi gereken ücret tarifenin birinci kısmına göre hesaplanmış olup bu suretle arabulucuya ödenmesi gereken toplam ücret #{{ $request->price }}-TL dir.
    </p>
    <p class="paragraph">
        #{{ $request->price }}-TL tutarındaki toplam arabuluculuk ücreti
        @php $count = 0 @endphp
        @foreach($sides as $side)
            @if(isset($request->{'side_payment_price_'.$side->id}) && !is_null($request->{'side_payment_price_'.$side->id}))
                {{ $count > 0 ? " ve " : ""}} {{ $side->detail->name }} tarafından en geç {{ $request->{'side_payment_date_'.$side->id} }} tarihinde #{{ $request->{'side_payment_price_'.$side->id} }}-TL
                @php $count = $count + 1 @endphp
            @endif
        @endforeach
        olarak arabulucu {{ auth()->user()->name }} adına açılmış {{ auth()->user()->soother->iban }} IBAN hesabına nakden ve defaten ödenecektir.
    </p>
    <p class="paragraph">
        Arabuluculuk ücretinin kararlaştırılan tarihte ödenmemesi halinde edimini ifa etmeyen taraf herhangi bir ihtara ve ihbara gerek kalmaksızın temerrüde düşmüş olur. Taraflar toplam tutardan müştereken ve müteselsilen sorumlu olduklarını kabul ve taahhüt ederler. İşbu belge alenidir. @BugunTarih
    </p>
</div>
