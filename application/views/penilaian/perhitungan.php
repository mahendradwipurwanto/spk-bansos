<div class="row mb-4">
	<div class="col-12">
		<div class="card">
			<div class="card-header pb-0">
				<h4 class="card-title-header">Data Perhitungan
					<?php if(!empty($detail_bansos)):?>
					- <?= $detail_bansos->bansos;?>
					<?php else:?>
					<?php endif;?>
				</h4>
			</div>
			<div class="card-body pt-0">
				<form action="<?= site_url('penilaian/perhitungan');?>" method="POST">
					<div class="row">
						<div class="col-2">
							Filter Tipe Bansos:
						</div>
						<div class="col-4">
							<select type="text" class="form-control form-control-sm choices w-100 select2"
								name="bansos_id">
								<?php if(!empty($bansos)):?>
								<?php foreach($bansos as $key => $val):?>
								<option value="<?= $val->id;?>"><?= $val->bansos;?></option>
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
						<div class="col-2">
							<button type="submit" class="btn btn-primary btn-xs">Tampilkan</button>
						</div>
					</div>
				</form>

				<?php if(is_null($bansos_id)):?>
				<div class="alert alert-info">
					<span class="fw-bold text-white">Harap pilih tipe bansos terlebih dahulu untuk menampilkan data
						perhitungan</span>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>

<?php if(!is_null($bansos_id)):?>
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card">
			<div class="card-header pb-0">
				<h5 class="card-title-header">Matrix Keputusan (X)</h5>
			</div>
			<div class="card-body pt-0">
				<table class="table table-bordered table-hover align-items-center w-100 mb-0" id="tableMatrixX">
					<thead>
						<tr>
							<th rowspan="2" width="10%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								No</th>
							<th rowspan="2" width="10%"
								class="text-uppercase text-secondary text-left px-2 text-xs font-weight-bolder opacity-7">
								Penduduk</th>
							<th colspan="<?= count($kategori);?>" width="80%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Kriteria</th>
						</tr>
						<tr>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $key => $val):?>
							<th class="text-center"><?= $val->kode;?></th>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($matrix_keputusan)):?>
						<?php $no = 1;foreach($matrix_keputusan as $key => $val):?>
						<tr>
							<td class="align-middle text-center">
								<span class="text-secondary"><?= $no++;?></span>
							</td>
							<td class="align-middle">
								<span class="text-secondary font-weight-bold"><?= $val->nama;?></span>
							</td>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $k => $v):?>
							<td class="align-middle text-center">
								<span
									class="text-secondary font-weight-bold"><?= $val->kategori_penduduk[$v->id]->nilai;?></span>
							</td>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card">
			<div class="card-header pb-0">
				<h5 class="card-title-header">Bobot Kriteria (W)</h5>
			</div>
			<div class="card-body pt-0">
				<table class="table table-bordered table-hover align-items-center w-100 mb-0" id="tableBobotKriteria">
					<thead>
						<tr>
							<th colspan="<?= count($kategori);?>" width="80%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Kriteria</th>
						</tr>
						<tr>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $key => $val):?>
							<th class="text-center"><?= $val->kode;?> (<?= $val->jenis == 1 ? 'benefit' : 'cost';?>)
							</th>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $k => $v):?>
							<td class="align-middle text-center">
								<span
									class="text-secondary font-weight-bold"><?= $bobot_kriteria[$v->id]->bobot;?></span>
							</td>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card">
			<div class="card-header pb-0">
				<h5 class="card-title-header">Normalisasi Bobot Kriteria (W)</h5>
			</div>
			<div class="card-body pt-0">
				<table class="table table-bordered table-hover align-items-center w-100 mb-0"
					id="tableNormalisasiBobotKriteria">
					<thead>
						<tr>
							<th colspan="<?= count($kategori);?>" width="80%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Kriteria</th>
						</tr>
						<tr>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $key => $val):?>
							<th class="text-center"><?= $val->kode;?> (<?= $val->jenis == 1 ? 'benefit' : 'cost';?>)
							</th>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $k => $v):?>
							<td class="align-middle text-center">
								<span
									class="text-secondary font-weight-bold"><?= $normalisasi_bobot_kriteria[$v->id]['normalisasi'];?></span>
							</td>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card">
			<div class="card-header pb-0">
				<h5 class="card-title-header">Nilai vektor (S)</h5>
			</div>
			<div class="card-body pt-0">
				<table class="table table-bordered table-hover align-items-center w-100 mb-0" id="tableNilaiVektorS">
					<thead>
						<tr>
							<th rowspan="2" width="10%"
								class="text-uppercase text-secondary text-left px-2 text-xs font-weight-bolder opacity-7">
								No</th>
							<th rowspan="2" width="10%"
								class="text-uppercase text-secondary text-left px-2 text-xs font-weight-bolder opacity-7">
								Penduduk</th>
							<th colspan="<?= count($kategori);?>" width="80%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Kriteria</th>
							<th rowspan="2" width="10%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Vektor S</th>
						</tr>
						<tr>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $key => $val):?>
							<th class="text-center"><?= $val->kode;?></th>
							<?php endforeach;?>
							<?php endif;?>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($nilai_vektor_s)):?>
						<?php $no = 1;foreach($nilai_vektor_s as $key => $val):?>
						<tr>
							<td class="align-middle text-center">
								<span class="text-secondary"><?= $no++;?></span>
							</td>
							<td class="align-middle">
								<span class="text-secondary font-weight-bold"><?= $val->nama;?></span>
							</td>
							<?php if(!empty($kategori)):?>
							<?php foreach($kategori as $k => $v):?>
							<td class="align-middle text-center">
								<span class="text-secondary font-weight-bold" data-bs-toggle="tooltip"
									data-bs-placement="top" title="<?= $val->kategori_penduduk[$v->id]->vektor_rumus;?>"
									data-container="body"
									data-animation="true"><?= $val->kategori_penduduk[$v->id]->vektor_hitung;?></span>
							</td>
							<?php endforeach;?>
							<?php endif;?>
							<td class="align-middle">
								<span class="text-secondary font-weight-bold"><?= $val->vektor_total;?></span>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card">
			<div class="card-header pb-0">
				<h5 class="card-title-header">Nilai vektor (V)</h5>
			</div>
			<div class="card-body pt-0">
				<table class="table table-bordered table-hover align-items-center w-100 mb-0" id="tableNilaiVektorV">
					<thead>
						<tr>
							<th width="10%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Peringkat</th>
							<th width="10%"
								class="text-uppercase text-secondary text-left px-2 text-xs font-weight-bolder opacity-7">
								Penduduk</th>
							<th width="30%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Perhitungan</th>
							<th width="30%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Nilai (V)</th>
							<th width="20%"
								class="text-uppercase text-secondary text-center px-2 text-xs font-weight-bolder opacity-7">
								Peringkat (Kelayakan)</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($nilai_vektor_v)):?>
						<?php $no = 1;foreach($nilai_vektor_v as $key => $val):?>
						<tr>
							<td class="align-middle text-center">
								<span class="text-secondary"><?= $no++;?></span>
							</td>
							<td class="align-middle">
								<span class="text-secondary font-weight-bold"><?= $val->nama;?></span>
							</td>
							<td class="align-middle text-center">
								<span class="text-secondary font-weight-bold"><?= $val->vektor_hasil_rumus;?></span>
							</td>
							<td class="align-middle text-center">
								<span class="text-secondary font-weight-bold"><?= $val->vektor_hasil;?></span>
							</td>
							<td class="align-middle text-center">
								<span class="text-secondary font-weight-bold"><?= $val->peringkat;?></span>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
