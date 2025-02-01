<h1 class="mt-4">Data Produk</h1>

<div class="row">
	<div class="col-md-3">
		<label class="form-label">Status</label>
		<select onchange="get_data()" name="" id="status_id" class="form-control">
			<?php foreach ($statuses as $status) { ?>
				<option value="<?= $status['id_status'] ?>"><?= $status['nama_status'] ?></option>
			<?php } ?>

		</select>
	</div>
	<div class="col-md-3">
		<label class="form-label">Kategori</label>
		<select onchange="get_data()" name="" id="kategori_id" class="form-control">
			<option value="">Pilih Kategori</option>
			<?php foreach ($kategoris as $kategori) { ?>
				<option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
			<?php } ?>
		</select>
	</div>
	<div class="col-md-6">
		<a href="<?= base_url('product/create'); ?>" style="float:right;" class="btn btn-primary">Tambah Produk <i class="fa fa-plus"></i></a>
	</div>
</div>
<br>

<div class="card mb-4">
	<div class="card-body">
		<table id="dataTable" class="table">
			<thead>
				<tr>
					<th>Nama Produk</th>
					<th>Harga</th>
					<th>Kategori</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>


<script>
	let datatable = null;
	$(document).ready(function() {
		get_data();
	});



	function get_data() {
		var kategori_id = $('#kategori_id').val();
		var status_id = $('#status_id').val();
		$.ajax({
			url: "<?= base_url('product/get_data'); ?>",
			type: "POST",
			data: {
				kategori_id: kategori_id,
				status_id: status_id
			},
			dataType: "json",
			success: function(response) {
				if (response.status === true) {
					var data = response.data;
					var tableBody = $('#dataTable tbody');
					tableBody.empty();

					$.each(data, function(index, item) {
						var row = '<tr>' +
							'<td>' + item.nama_produk + '</td>' +
							'<td style="text-align:right;">' + number_format(item.harga, 0, ',', '.') + '</td>' +
							'<td>' + item.nama_kategori + '</td>' +
							'<td>' + item.nama_status + '</td>' +
							'<td>' +
							'<a href="<?= base_url('product/'); ?>' + item.id_produk + '" class="btn btn-info">Detail</a>' +
							'<a href="<?= base_url('product/'); ?>' + item.id_produk + '/edit" class="btn btn-warning">Edit</a>' +
							'<button onclick="deleteProduct(' + item.id_produk + ')" class="btn btn-danger">Delete</button>' +
							'</td>' +
							'</tr>';
						tableBody.append(row);
					});

				} else {
					console.log(response.message);
				}
			},
			error: function(xhr, status, error) {
				console.log(error);

			}
		});
	}

	function deleteProduct(id) {
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Hapus data produk?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: "<?= base_url('product/delete/'); ?>" + id,
					type: "POST",
					dataType: "json",
					success: function(response) {
						if (response.status === true) {
							Swal.fire({
								title: "Success!",
								text: response.message,
								icon: "success"
							});
						} else {
							Swal.fire({
								title: "Failed!",
								text: response.message,
								icon: "error"
							});
						}
						get_data();
					},
					error: function(xhr, status, error) {
						Swal.fire({
							title: "Failed!",
							text: error,
							icon: "error"
						});
						get_data();
					}
				});
			}
		});

	}

	function number_format(number, decimals, dec_point, thousands_sep) {
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function(n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}
</script>
