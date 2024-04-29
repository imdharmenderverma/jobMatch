<table class="table mt-3 text-center text-white tableMobile">
    <div style="display:flex; align-items: center;">
        @if($videoShowData->video != null)
            @php
             $i=1;
            @endphp
                <video width="800" height="340" controls autoplay>
                    <source src="{{$videoShowData->video}}" type="video/mp4">
                    <source src="{{$videoShowData->video}}}}" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
        @else
            <h4>No Video Available</h4>
        @endif
    </div>
</table>