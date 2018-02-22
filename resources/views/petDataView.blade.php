<h1>Following details are available for the pets in general</h1>

@foreach($finalResults as $finalResultkey => $finalResultValue)
</br/>
Field name : {{$finalResultkey}}
<br/ >
Field description : {{$finalResultValue['friendlyname']}}
</br>

<hr />
@endforeach