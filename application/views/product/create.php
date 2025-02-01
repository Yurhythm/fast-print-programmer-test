<h1 class="mt-4">Tambah Produk</h1>
<form method="POST" action="<?= base_url('product/create') ?>">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="nama_produk">Nama Produk</label>
				<input type="text" required class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukkan nama produk">
				<div style="height: 20px;">
					<?php if ($this->session->flashdata('errors')): foreach ($this->session->flashdata('errors') as $key => $error): if ($key == 'nama_produk'): ?>
								<span style="color:red; font-size:12px;"><?= $error ?></span>
					<?php endif;
						endforeach;
					endif; ?>
				</div>
			</div>

			<div class="form-group">
				<label for="harga_produk">Harga Produk</label>
				<input type="number" required class="form-control" id="harga_produk" name="harga" placeholder="Masukkan harga produk">
				<div style="height: 20px;">
					<?php if ($this->session->flashdata('errors')): foreach ($this->session->flashdata('errors') as $key => $error): if ($key == 'harga'): ?>
								<span style="color:red; font-size:12px;"><?= $error ?></span>
					<?php endif;
						endforeach;
					endif; ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="kategori">Kategori</label>
				<select class="form-control" id="kategori" name="kategori_id">
					<option value="">Pilih Kategori</option>
					<?php foreach ($kategoris as $kategori) { ?>
						<option value="<?= $kategori['id_kategori'] ?>"><?= $kategori['nama_kategori'] ?></option>
					<?php } ?>
				</select>
				<div style="height: 20px;"></div>
			</div>

			<div class="form-group">
				<label for="status">Status</label>
				<select class="form-control" id="status" name="status_id">
					<?php foreach ($statuses as $status) { ?>
						<option value="<?= $status['id_status'] ?>"><?= $status['nama_status'] ?></option>
					<?php } ?>
				</select>
				<div style="height: 20px;"></div>
			</div>
		</div>
	</div>




	<br>
	<button type="submit" class="btn btn-primary">Simpan</button>
	<a href="<?= base_url('product'); ?>" class="btn btn-info">Kembali</a>
</form>
