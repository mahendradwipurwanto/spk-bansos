<div class="row">
	<div class="col-xl-12 mb-4">
		<div class="card">
			<div class="card-header pb-0">
				<h4 class="card-title-header">Data Tipe Bansos
					<button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
						data-bs-target="#tambah"><i class="fas fa-plus"></i> Tambah</button>
				</h4>
			</div>
			<div class="card-body pt-0">
				<table class="table table-bordered table-hover align-items-center w-100 mb-0" id="myTable">
					<thead>
						<tr>
							<th width="20%"
								class="text-uppercase text-secondary text-left px-2 text-xs font-weight-bolder opacity-7">
								Tipe Bansos</th>
							<th width="50%"
								class="text-uppercase text-secondary text-left px-2 text-xs font-weight-bolder opacity-7">
								Keterangan</th>
							<th width="10%" class="text-secondary text-left px-2 opacity-7"></th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($bansos)):?>
						<?php $no = 1;foreach($bansos as $key => $val):?>
						<tr>
							<td>
								<div class="d-flex px-2 py-1">
									<div class="d-flex flex-column justify-content-center">
										<h6 class="mb-0 text-xs"><?= $val->bansos;?></h6>
									</div>
								</div>
							</td>
							<td class="align-middle">
								<span class="text-secondary"><?= $val->keterangan;?></span>
							</td>
							<td class="align-middle">
								<button class="btn btn-secondary font-weight-bold btn-xs mb-0" data-bs-toggle="modal"
									data-bs-target="#edit-<?= $val->id;?>">
									Edit
								</button>
								<button class="btn btn-danger font-weight-bold btn-xs mb-0" data-bs-toggle="modal"
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
										<h5 class="modal-title" id="exampleModalLabel">Edit bansos</h5>
										<button type="button" class="btn-close" data-bs-dismiss="modal"
											aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form action="<?= site_url('master/editBansos');?>" method="POST">
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<div class="mb-3">
												<label for="formNamaBansos">Nama bansos</label>
												<input type="text" class="form-control form-control-sm" name="bansos"
													value="<?= $val->bansos;?>" placeholder="Nama bansos" required>
											</div>
											<div class="mb-3">
												<label for="formKeteranganBansos">Keterangan <small
														class="text-secondary">(optional)</small></label>
												<textarea type="text" class="form-control form-control-sm"
													id="formKeteranganBansos" name="keterangan"
													placeholder="Keterangan bansos"><?= $val->keterangan;?></textarea>
											</div>
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
										<form action="<?= site_url('master/hapusBansos');?>" method="post">
											<input type="hidden" name="id" value="<?= $val->id;?>">
											<div class="py-3 text-center">
												<i class="ni ni-bell-55 ni-3x"></i>
												<h4 class="text-gradient text-danger mt-4">Hapus data bansos?</h4>
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
						<?php else:?>
						<tr>
							<td colspan="5" class="text-center">Belum ada data</td>
						</tr>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah bansos</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('master/tambahBansos');?>" method="POST">
					<div class="mb-3">
						<label for="formNamaBansos">Nama bansos</label>
						<input type="text" class="form-control form-control-sm" name="bansos"
							placeholder="Nama bansos" required>
					</div>  
					<div class="mb-3">
						<label for="formKeteranganBansos">Keterangan <small
								class="text-secondary">(optional)</small></label>
						<textarea type="text" class="form-control form-control-sm" id="formKeteranganBansos"
							name="keterangan" placeholder="Keterangan bansos"></textarea>
					</div>
					<div class="modal-footer px-0 pb-0 mb-0">
						<button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn bg-gradient-primary">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
