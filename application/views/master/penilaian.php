<div class="row">
	<div class="col-xl-8 mb-4">
		<div class="card">
			<div class="card-header pb-0">
				<h4 class="card-title-header">Data Penilaian
					<?php if(!empty($detail_bansos)):?>
						- <?= $detail_bansos->bansos;?>
					<?php else:?>
					<?php endif;?>
					<button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
						data-bs-target="#tambah"><i class="fas fa-user-plus"></i> Tambah</button>
				</h4>
			</div>
			<div class="card-body pt-0">
				<form action="<?= site_url('master/penilaian');?>" method="POST">
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
						penilaian</span>
				</div>
				<?php else:?>
				<table class="table table-bordered table-hover align-items-center w-100 mb-0" id="myTable">
					<thead>
						<tr>
							<th width="10%"
								class="text-uppercase text-left px-2 text-secondary text-xs font-weight-bolder opacity-7">
								No</th>
							<th width="80%"
								class="text-uppercase text-left px-2 text-secondary text-xs font-weight-bolder opacity-7">
								Nama Penduduk</th>
							<th width="10%" class="text-secondary opacity-7"></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($penilaian)):?>
						<?php $no = 1;foreach($penilaian as $key => $val):?>
						<tr>
							<td class="align-middle">
								<span class="text-secondary"><?= $no;?></span>
							</td>
							<td>
								<div class="d-flex px-2 py-1">
									<div class="d-flex flex-column justify-content-center">
										<h6 class="mb-0 text-xs"><?= $val->nama;?></h6>
										<p class="text-xs text-secondary mb-0">nik: <?= $val->nik;?></p>
									</div>
								</div>
							</td>
							<td class="align-middle">
								<button class="btn btn-secondary btn-xs mb-0" data-bs-toggle="modal"
									data-bs-target="#edit-<?= $val->id;?>">
									Detail
								</button>
								<button class="btn btn-danger btn-xs mb-0" data-bs-toggle="modal"
									data-bs-target="#delete-<?= $val->id;?>">
									Hapus
								</button>
							</td>
						</tr>

						<!-- Modal -->
						<div class="modal fade" id="edit-<?= $val->id;?>" tabindex="-1" role="dialog"
							aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Edit penduduk</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('master/editPenilaian');?>" method="POST">
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<div class="mb-3">
												<label for="formBansos">Tipe Bansos</label>
												<select type="text"
													class="form-control form-control-sm choices w-100 select2"
													name="bansos_id">
													<optgroup label="current">
														<option value="<?= $val->bansos_id;?>"><?= $val->bansos;?>
														</option>
													</optgroup>
													<?php if(!empty($bansos)):?>
													<optgroup label="changes">
														<?php foreach($bansos as $k => $v):?>
														<option value="<?= $v->id;?>"><?= $v->bansos;?></option>
														<?php endforeach;?>
													</optgroup>
													<?php endif;?>
												</select>
											</div>
											<div class="mb-3">
												<label for="formNamaPenduduk">Penduduk</label>
												<input type="text" class="form-control form-control-sm" name="nama"
													value="<?= $val->nama;?>" placeholder="Nama Lengkap penduduk"
													readonly>
											</div>
											<?php if(!empty($val->kategori_penduduk)):?>
											<?php foreach($val->kategori_penduduk as $k => $v):?>
											<div class="mb-3">
												<label for="formKategori">Kriteria <?= $v->kategori;?></label>
												<input type="hidden" name="kategori_id[]"
													value="<?= $v->kategori_id;?>">
												<select type="text"
													class="form-control form-control-sm choices w-100 select2"
													name="kriteria_id[]">
													<optgroup label="current">
														<option value="<?= $v->kriteria_id;?>"><?= $v->kriteria;?>
														</option>
													</optgroup>
													<?php if(!empty($kategori)):?>
													<?php foreach($kategori as $kk => $vv):?>
													<?php if($vv->id == $v->kategori_id):?>
													<?php if(!empty($vv->kriteria)):?>
													<optgroup label="changes">
														<?php foreach($vv->kriteria as $kkk => $vvv):?>
														<option value="<?= $vvv->id;?>"><?= $vvv->kriteria;?></option>
														<?php endforeach;?>
													</optgroup>
													<?php endif;?>
													<?php endif;?>
													<?php endforeach;?>
													<?php endif;?>
												</select>
											</div>
											<?php endforeach;?>
											<?php endif;?>
											<div class="modal-footer px-0 pb-0 mb-0">
												<button type="button" class="btn bg-gradient-secondary"
													data-bs-dismiss="modal">Batal</button>
												<button type="submit" class="btn bg-gradient-primary">Simpan</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="delete-<?= $val->id;?>" tabindex="-1" role="dialog"
							aria-labelledby="modal-notification" aria-hidden="true">
							<div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
								<div class="modal-content">
									<div class="modal-body">
										<form action="<?= site_url('master/hapusPenilaian');?>" method="post">
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<div class="py-3 text-center">
												<i class="ni ni-bell-55 ni-3x"></i>
												<h4 class="text-gradient text-danger mt-4">Hapus data penilaian?</h4>
												<p>Apakah anda yakin ingin menghapus data ini?</p>
											</div>
											<div class="modal-footer px-0 pb-0 mb-0">
												<button type="submit" class="btn bg-gradient-danger">Ya</button>
												<button type="button" class="btn bg-gradient-secondary ml-auto"
													data-bs-dismiss="modal">Tidak</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah penduduk</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('master/tambahPenilaian');?>" method="POST">
					<div class="mb-3">
						<label for="formBansos">Tipe Bansos</label>
						<select type="text" class="form-control form-control-sm choices w-100 select2" name="bansos_id">
							<?php if(!empty($bansos)):?>
							<?php foreach($bansos as $key => $val):?>
							<option value="<?= $val->id;?>"><?= $val->bansos;?></option>
							<?php endforeach;?>
							<?php endif;?>
						</select>
					</div>
					<div class="mb-3">
						<label for="formNamaPenduduk">Penduduk</label>
						<select type="text" class="form-control form-control-sm choices w-100 select2"
							name="penduduk_id">
							<?php if(!empty($penduduk)):?>
							<?php foreach($penduduk as $kk => $vv):?>
							<option value="<?= $vv->id;?>"><?= $vv->nama;?></option>
							<?php endforeach;?>
							<?php endif;?>
						</select>
					</div>
					<?php if(!empty($kategori)):?>
					<?php foreach($kategori as $key => $val):?>
					<div class="mb-3">
						<label for="formKategori">Kategori <?= $val->kategori;?></label>
						<input type="hidden" name="kategori_id[]" value="<?= $val->id;?>">
						<select type="text" class="form-control form-control-sm choices w-100 select2"
							name="kriteria_id[]">
							<?php if(!empty($val->kriteria)):?>
							<?php foreach($val->kriteria as $kk => $vv):?>
							<option value="<?= $vv->id;?>"><?= $vv->kriteria;?></option>
							<?php endforeach;?>
							<?php endif;?>
						</select>
					</div>
					<?php endforeach;?>
					<?php endif;?>
					<div class="modal-footer px-0 pb-0 mb-0">
						<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn bg-gradient-primary">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
