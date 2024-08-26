@extends('layouts.app')
@section('title')
Availabilities
@endsection

@section('content')
    <h1>Availabilities</h1>
    <div class="form-group">
        <form method="GET">
            <div class="row my-4">
                <div class="col-4">
                    <select name="category_id" class="form-control" data-date="{{ $currentDate }}" onchange="updateUrl(this)">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option {{$category->id==$category_id?'selected':''}} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-8 nav-buttons">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item"><a class="page-link px-4" href="{{ route('availabilities.index', ['date' => $previousDate,'category_id'=>$category_id]) }}">Previous</a></li>
                          @foreach($period as $dt)
                            <li class="page-item ">
                                <a class="page-link nav-date" href="#">
                                <span>{{$dt->format("D")}}</span><br/>
                                <span>{{$dt->format("Y-M-d");}}</span>
                                </a>
                            </li>
                            @endforeach
                          <li class="page-item"><a class="page-link px-4" href="{{ route('availabilities.index', ['date' => $nextDate,'category_id'=>$category_id]) }}">Next</a></li>
                        </ul>
                      </nav>
                </div>
                {{-- <div class="col-2">
                    <button class="btn btn-success w-100" type="submit">Filter</button>
                </div> --}}
            </div>
        </form>
    </div>
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                @foreach($period as $dt)
                    <th>{{ $dt->format('d M Y') }}</th>
                @endforeach

            </tr>
        </thead>
        <tbody>
            @foreach($period as $date)
                <tr>
                    <td></td>
                    @foreach($period as $columnDate)
                        @php
                            $formattedDate = $columnDate->format('Y-m-d');
                            $slots = isset($availabilities[$formattedDate]) ? $availabilities[$formattedDate] : [];
                        @endphp
                        <td>
                            @foreach($slots as $slot)
                                {{ date("h:i a",strtotime($slot->start_time)) }} - {{ date("h:i a",strtotime($slot->end_time)) }} ({{$slot->category->name}})<br>
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
<script>
    function updateUrl(selectElement) {
    var date = selectElement.getAttribute('data-date');
    var categoryId = selectElement.value;
    var baseUrl = '{{ url()->current() }}';
    var newUrl = `${baseUrl}?category_id=${categoryId}&date=${date}`;
    window.location.assign(newUrl);
}
    </script>

