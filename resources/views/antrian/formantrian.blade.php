@extends('layouts.index')
@section('content')
    <div class="section">
        {{-- isi table --}}
        <table class="highlight">
        	<thead>
        		<tr>
        			<th>No Pendaftaran</th>
        			<th>Keterangan</th>
        			<th>Nominal Pajak</th>
        			<th>Status</th>
        		</tr>
        	</thead>
        	<tbody>
        		@foreach($ambilpendaftarans as $ambilpendaftaran)
					<tr>
						<td>{{ str_pad($ambilpendaftaran->ID, 7, '0', STR_PAD_LEFT) }}</td>
						<td>{{ $ambilpendaftaran->KeteranganPajak }}</td>
						<td>{{ $ambilpendaftaran->NilaiPajak }}</td>
						<td>lorem</td>
					</tr>
			@endforeach
        	</tbody>
        </table>
		{{ $ambilpendaftarans->links('vendor.pagination.materializecss') }}
    </div>

<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/js/jquery.mask.min.js')}}"></script>
<script>
    // untuk jquery
</script>
@endsection

