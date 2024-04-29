<table class="table mt-3 text-center text-white tableMobile">
    <div style="display:flex; align-items: center;">
        @if(count($coverLetterShowData) > 0)
        @php
        $i=1;
        @endphp
        @foreach($coverLetterShowData as $data)
        <div style="margin: 15px; padding: 15px;"><a href="{{$data->file}}" target="_blank"><img src="{{asset('assets/img/pdf-icon.png')}}" width="50" height="50"></a></div>
        @endforeach
        @else
        <h4>No CoverLetter Available</h4>
        @endif
    </div>
</table>