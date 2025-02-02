@extends('layouts.app')

@section('title', 'Pesan Tiket')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Pesan Tiket</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="movie_schedule_id" class="form-label">Pilih Film</label>
                            <select name="movie_schedule_id" id="movie_schedule_id" 
                                    class="form-select @error('movie_schedule_id') is-invalid @enderror" required>
                                <option value="">Pilih Film</option>
                                @foreach($movies as $movie)
                                    <option value="{{ $movie->id }}">
                                        {{ $movie->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('movie_schedule_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="schedule_id" class="form-label">Pilih Jadwal Penayangan</label>
                            <select name="schedule_id" id="schedule_id" 
                                    class="form-select @error('schedule_id') is-invalid @enderror" required>
                                <option value="">Pilih Jadwal Penayangan</option>
                               
                            </select>
                            @error('schedule_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Pemesan</label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                   id="customer_name" name="customer_name" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="number_of_tickets" class="form-label">Jumlah Tiket</label>
                            <input type="number" class="form-control @error('number_of_tickets') is-invalid @enderror" 
                                   id="number_of_tickets" name="number_of_tickets" min="1" required>
                            @error('number_of_tickets')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Pilih Kursi</label>
                            <div class="seat-selection">
                                @foreach($seats as $seat)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" 
                                               name="seat_ids[]" value="{{ $seat->id }}" 
                                               id="seat_{{ $seat->id }}">
                                        <label class="form-check-label" for="seat_{{ $seat->id }}">
                                            {{ $seat->seat_number }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('seat_ids')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Pesan Tiket</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#number_of_tickets').on('change', function() {
            let ticketCount = $(this).val();
            $('input[name="seat_ids[]"]').prop('checked', false);
            $('input[name="seat_ids[]"]').prop('disabled', false);
            
            $('input[name="seat_ids[]"]').on('change', function() {
                let checkedSeats = $('input[name="seat_ids[]"]:checked').length;
                if (checkedSeats >= ticketCount) {
                    $('input[name="seat_ids[]"]:not(:checked)').prop('disabled', true);
                } else {
                    $('input[name="seat_ids[]"]').prop('disabled', false);
                }
            });
        });

        // $('#movie_schedule_id').change(function ()  {
        //     let filmId = $(this).val();

        //     if(filmId){
        //         $.ajax({
        //             url: `/admin/get-schedules/${filmId}`,
        //             type: 'GET',
        //             success : function (data) {
        //                 $('#schedule_id').empty().append(' <option value="">Pilih Jadwal Penayangan</option>')
        //                 $.each(data, function (key, value) {
        //                     $('#schedule_id').append(` <option value="${key}">${value.show_date} - ${value.show_time}</option>`)
        //                 })
        //             }
        //         })
        //     } else {
        //         $('#schedule_id').empty().append(' <option value="">Pilih Jadwal Penayangan</option>')
        //     }
        // })

        $('#movie_schedule_id').change(function () {
    let filmId = $(this).val();

    if (filmId) {
        $.ajax({
            url: `/admin/get-schedules/${filmId}`,
            type: 'GET',
            success: function (data) {
                $('#schedule_id').empty().append('<option value="">Pilih Jadwal Penayangan</option>');

                $.each(data, function (key, value) {
                    let showDate = new Date(value.show_date).toLocaleDateString('id-ID', { 
                        weekday: 'long', 
                        day: '2-digit', 
                        month: 'long', 
                        year: 'numeric' 
                    });
                  
                    // Konversi show_time (datetime) ke jam dan menit
                    let showTime = new Date(value.show_time).toLocaleTimeString('id-ID', { 
                        hour: '2-digit', 
                        minute: '2-digit', 
                        hour12: false 
                    });

                    $('#schedule_id').append(`<option value="${key}">${showDate} - ${showTime}</option>`);
                });
            }
        });
    } else {
        $('#schedule_id').empty().append('<option value="">Pilih Jadwal Penayangan</option>');
    }
});

    });
</script>
@endpush
@endsection 