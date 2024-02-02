<x-layout>
		<div class="col-md-6">
			<div class="card mb-4">
				<h5 class="card-header">Pengaturan Mac Address</h5>
				@if ($errors->any())
						<div class="alert alert-danger">
								<ul>
										@foreach ($errors->all() as $error)
												<li>{{ $error }}</li>
										@endforeach
								</ul>
						</div>
				@endif
				<div class="card-body">
					<form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('block')}}">
						@csrf
						<div class="row">
							<div class="col-md-6">
								<label for="smallInput" class="form-label">Mac Address</label>
								<input
									id="smallInput"
									name="mac_address"
									class="form-control form-control-sm"
									type="text"
									placeholder="Masukkan mac address" />
							</div>
							<div class="col-md-6">
								<label for="smallSelect" class="form-label">Aksi</label>
								<select id="smallSelect" name="aksi" class="form-select form-select-sm">
									<option>Pilih Aksi</option>
									<option value="Ban">Ban</option>
									<option value="Disable">Disable</option>
									<option value="Permit">Permit</option>
								</select>
							</div>
						</div>
						<br/>
						<button type="submit" class="btn btn-primary">Atur</button>
					</form>
				</div>
			</div>
		</div>
		<hr/>
		<h5 class="card-header">Daftar Perangkat DiBlokir</h5>
		<div class="table-responsive text-nowrap">
				<table class="table">
					<thead>
							<tr class="table-primary">
							<th>No</th>
							<th>SSID</th>
							<th>Mac Address</th>
							<th>Status</th>
							<th>Actions</th>
							</tr>
					</thead>
					<tbody class="table-border-bottom-0">
						@foreach ($blockedUsersUsers as $index => $user)
							<tr>
								<td>{{ $index+1 }}</td>
								<td>
									<span class="fw-medium">{{ $user["wlan_ssid"] }}</span>
								</td>
								<td>{{ $user["mac_address"]}}</td>
								<td><span class="badge bg-label-danger me-1">Di Blokir</span></td>
						
								<td>
									<a type="button" id="wifi-setting-unblock" data-macaddr='{{ $user["mac_address"]}}' href="#"  data-zte_index="{{$index}}" class="btn btn-info">Buka Blokir</a>
								</td>
							</tr>
						@endforeach
							
					</tbody>
				</table>
		</div>

		<div class="modal fade" id="modal-wifi-setting-unblock" tabindex="-1" aria-hidden="true">
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
					<form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('wifi-setting/unblock')}}">
						@csrf
						<label for="smallInput" class="form-label">Mac Address</label>
						<input
							id="mac-address"
							name="mac_address"
							class="form-control form-control-sm"
							type="text"
							readonly />
						<br/>

						<label for="smallInput" class="form-label">Zte Index</label>
						<input
							id="zte-index"
							name="zte_index"
							class="form-control form-control-sm"
							type="text"
							readonly />
						<br/>
						<label for="smallSelect" class="form-label">Waktu</label>
						<input
							id="waktu"
							type="number"
							name="waktu"
							class="form-control form-control-sm"
							type="text"
							placeholder="Masukkan waktu dalam menit" />
						<br/>
						<button type="submit" class="btn btn-primary">Buka Blokir</button>
					</form>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
					Tutup
				</button>
				</div>
			</div>
		</div>
</x-layout>

<script>
	$(function(){
		$(document).on("click", "#wifi-setting-unblock", function(){
			let modal = bootstrap.Modal.getOrCreateInstance($("#modal-wifi-setting-unblock")) // Returns a Bootstrap modal instance
			const macaddr = $(this).data("macaddr");
			const zteIndex = $(this).data("zte_index");
			
			$("#mac-address").val(macaddr);
			$("#zte-index").val(zteIndex);

			modal.show();
		});
	});
</script>