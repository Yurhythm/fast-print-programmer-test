<h1 class="mt-4">Home</h1>

<button onclick="get_data_from_api();" id="btn_get_data" class="btn btn-info">Ambil data produk dari API <i id="show_loading" class="fa fa-circle-notch fa-spin" style="display: none;"></i> </button>

<script>
	function get_data_from_api() {
		document.getElementById("show_loading").style.display = "inline-block";
		document.getElementById("btn_get_data").disabled = true;

		$.ajax({
			url: "<?= base_url('get_data_from_api'); ?>",
			type: "POST",
			dataType: "json",
			success: function(response) {
				document.getElementById("show_loading").style.display = "none";
				document.getElementById("btn_get_data").disabled = false;
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

			},
			error: function(xhr, status, error) {
				document.getElementById("show_loading").style.display = "none";
				document.getElementById("btn_get_data").disabled = false;
				Swal.fire({
					title: "Failed!",
					text: error,
					icon: "error"
				});
			}
		});


	}
</script>
