<h1 class="mt-4">Detail Produk</h1>
<div class="card">
	<div class="card-body">
		<table>
			<tr>
				<td>Nama Produk </td>
				<td>: </td>
				<td><?= $datas->nama_produk ?></td>
			</tr>
			<tr>
				<td>Harga Produk </td>
				<td>: </td>
				<td>Rp.<?= number_format($datas->harga, 0, ',', '.') ?></td>
			</tr>
			<tr>
				<td>Kategori </td>
				<td>: </td>
				<td><?= $datas->nama_kategori ?></td>
			</tr>
			<tr>
				<td>Status </td>
				<td>: </td>
				<td><?= $datas->nama_status ?></td>
			</tr>
		</table>
	</div>
</div>
<br>
<a href="<?= base_url('product'); ?>" class="btn btn-info">Kembali</a>
