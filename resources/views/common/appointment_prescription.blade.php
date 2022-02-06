<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th colspan="2">Prescription</th>
                </tr>
            </thead>
            <tbody>
                @if($appointment->prescription)
                <tr>
                    <th>
                        Document
                    </th>
                    <td>
                        @if(Str::contains($appointment->prescription->image,['pdf','doc','docx']))
                        <a target="_blank" href="{{asset('uploads/'.$appointment->prescription->image)}}">
                            View File
                        </a>
                            @else
                        <img src="{{asset('uploads/'.$appointment->prescription->image)}}" alt="" width="100">
                        @endif

                    </td>
                </tr>
                <tr>
                    <th>
                        Description
                    </th>
                    <td>
                        {{$appointment->prescription->details}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Medicine
                    </th>
                    <td>
                        <?php
                        $format_arr = [
                            '1 + 1 + 1',
                            '1 + 0 + 1',
                            '0 + 1 + 1',
                            '1 + 0 + 0',
                            '0 + 0 + 1',
                            '0 + 1 + 0'
                        ];

                        $medicine_name = json_decode($appointment->prescription->medicine_name)? json_decode($appointment->prescription->medicine_name):[];

                        $taken = ($appointment->prescription->meal == 1) ? 'Before Meal':'After Meal';
                        $how_many = json_decode($appointment->prescription->medicine_liquid);
                        $format = json_decode($appointment->prescription->medicine_solid);
                        $length = 0;
                        $counter = -1;

                        foreach($medicine_name as $medicine){
                            $counter++;
                            $length++;
                            echo '<strong>'.$length.'. '.$medicine.' </strong> <br>';
                            echo '  -  '.$taken.'<br> - '.$how_many[$counter].'(spoon/pic)<br> ';
                            echo '  -  '.$format_arr[$format[$counter]%3].'<br>';
                        }

                    ?>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
