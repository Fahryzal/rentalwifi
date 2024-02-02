<x-layout>
	<h5 class="card-header">Daftar Perangkat Terhubung</h5>

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="table-responsive text-nowrap">
		<table class="table">
		<thead>
			<tr class="table-primary">
			<th>No.</th>
			<th>SSID</th>
			<th>Mac Address</th>
			<th>Waktu Tersisa (Menit)</th>
			<th>IP</th>
			<th>Name</th>
			<th>Status</th>
			<th>Actions</th>
			</tr>
		</thead>
		<tbody class="table-border-bottom-0">
			@foreach ($allowedUsers as $index => $user)
				<tr>
					<td>{{ $index +1 }}</td>
					<td>{{ $user->ssid}}</td>
					<td>{{ $user->macAddr}}</td>
					<td>
						<div class="card" style="background:#e1e2ff;color:black;">
							<div class="card-body">
								<table>
									<tr>
										<td>Mulai </td>
										<td>:</td>
										<td> <b>{{ $user->created_at }} </b> </td>
									</tr>

									<tr>
										<td>Selesai </td>
										<td>:</td>
										<td> <b>{{ $user->getWaktuSelesai() }}</b></td>
									</tr>

									<tr>
										<td>Sisa waktu </td>
										<td>:</td>
										<td>  <b> {{ $user->sisaWaktu() }} Menit </b></td>
									</tr>
								</table>
							</div>
						</div>
					</td>
					<td> {{  $user->ip }} </td>
					<td>
						<span class="fw-medium">{{ $user->name }}</span>
					</td>
					<td><span class="badge bg-label-primary me-1">Active</span></td>
					<td>
						<div class="dropdown">
						<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
							<i class="bx bx-dots-vertical-rounded"></i>
						</button>
						<div class="dropdown-menu">
							<a id="atur-waktu-aksi" data-macaddr ="{{ $user->macAddr}}" class="dropdown-item" href="javascript:void(0);"
							
							><i class="bx bx-edit-alt me-1"></i> Atur Waktu</a
							>
						</div>
						</div>
					</td>
				</tr>
			@endforeach
			
		</tbody>
		</table>
	</div>

	<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h5 class="modal-title" id="modalCenterTitle">Atur Waktu Perangkat</h5>
				<button
					type="button"
					class="btn-close"
					data-bs-dismiss="modal"
					aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('wifi-setting/create-or-update')}}">
						@csrf
						<label for="smallInput" class="form-label">Mac Address</label>
						<input
							id="mac-address"
							name="mac_address"
							class="form-control form-control-sm"
							type="text"
							value="2313:1231231:#1231"
							readonly />
						<br/>
						<label for="smallSelect" class="form-label">Waktu (Menit)</label>
						<input
							id="waktu"
							type="number"
							name="waktu"
							class="form-control form-control-sm"
							type="text"
							placeholder="Masukkan waktu dalam menit" required/>
						<br/>
						<button type="submit" class="btn btn-primary">Atur Waktu</button>
					</form>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
					Tutup
				</button>
				</div>
			</div>
		</div>
	</div>
</x-layout>

<script>
	$(function(){
		$(document).on("click", "#atur-waktu-aksi", function(){
			let modal = bootstrap.Modal.getOrCreateInstance($("#modalCenter")) // Returns a Bootstrap modal instance
			const macaddr = $(this).data("macaddr");
			$("#mac-address").val(macaddr);
			modal.show();
		});
	});

	window.setTimeout( function() {
		window.location.reload();
	}, 600000);
</script>