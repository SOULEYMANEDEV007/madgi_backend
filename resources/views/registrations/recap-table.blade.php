<div class="card-body">
    <h6 class="text-bold mb-2">Récapitulatif</h6>
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center" id="registrations-table">
            <thead>
                <tr>
                    <th class="text-sm">Nb(personne[s]) présentes</th>
                    <th class="text-sm">{{\Carbon\Carbon::now()->format('Y-m-d') == $date->format('Y-m-d') ? 'Nb(personne[s]) total' : 'Nb(personne[s]) absentes'}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <span class="text-sm">{{$presents}}</span>
                        @if ($presents > 0)
                            <div class="text-center">
                                <form action="{{ getGuardedRoute('registrations.index') }}" method="GET">
                                    <input type="hidden" name="type" value="present">
                                    <input type="hidden" name="last_type" value="{{$type}}">
                                    <input type="hidden" name="date" value="{{$date->format('Y-m-d')}}">
                                    <input type="submit" class="btn-link text-sm" value="Parcourir" style="border: none; text-decoration: underline;">
                                </form>
                            </div>
                        @endif
                    </td>
                    <td>
                        <span class="text-sm">{{$absents}}</span>
                        @if ($absents > 0)
                            <form action="{{ getGuardedRoute('registrations.index') }}" method="GET">
                                <input type="hidden" name="type" value="absent">
                                <input type="hidden" name="last_type" value="{{$type}}">
                                <input type="hidden" name="date" value="{{$date->format('Y-m-d')}}">
                                <input type="submit" class="btn-link text-sm" value="Parcourir" style="border: none; text-decoration: underline;">
                            </form>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
