

    <div class="row">
        @foreach($slots as $slot)
            <div class="col-md-4" style="margin-top:10px;">
                <button id="sl-{{$slot->id}}" onclick="updateSlot({{$slot->id}})" type="button" {{in_array($slot->id,$appointmentSlots)?'disabled':''}} class="slot-button btn btn-{{in_array($slot->id,$appointmentSlots)?'danger':'success'}}">
                    {{$slot->start}} to {{$slot->end}}
                </button>
            </div>
        @endforeach
    </div>

