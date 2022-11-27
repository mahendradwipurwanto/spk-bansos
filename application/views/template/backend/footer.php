<br><br>
<footer class="footer py-2 bg-white">
	<div class="container-fluid">
		<div class="row align-items-center justify-content-lg-between">
			<div class="col-lg-6 mb-lg-0 mb-4">
				<div class="copyright text-center text-sm text-muted text-lg-start">
					© <script>
						document.write(new Date().getFullYear())

					</script>, SPK BANSOS
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
</main>

<script src="<?= base_url(); ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= base_url(); ?>assets/js/plugins/chartjs.min.js"></script>

<!-- JS Plugins Init. -->
<script>
	function tour() {
		introJs().setOptions({
			disableInteraction: true,
			steps: [{
				intro: "Selamat Datang di web aplikasi SPK BANSOS"
			}, {
				element: document.querySelector('#sidebar-dashboard'),
				intro: "Anda dapat melihat ringkasan mengenai web app pada laman ini"
			}, {
				element: document.querySelector('#sidebar-bansos'),
				intro: "Anda dapat mengelola data tipe bansos pada laman ini"
			}, {
				element: document.querySelector('#sidebar-penduduk'),
				intro: "Anda dapat mengelola data penduduk pada laman ini"
			}, {
				element: document.querySelector('#sidebar-kategori'),
				intro: "Anda dapat mengelola master data kategori penilaian pada laman ini"
			}, {
				element: document.querySelector('#sidebar-kriteria'),
				intro: "Anda dapat mengelola master data kriteria penilaian pada laman ini"
			}, {
				element: document.querySelector('#sidebar-penilaian'),
				intro: "Anda dapat mengelola data penilaian penduduk pada laman ini"
			}, {
				element: document.querySelector('#sidebar-perhitungan'),
				intro: "Anda dapat melihat data detail perhitungan pada laman ini"
			}, {
				element: document.querySelector('#sidebar-hasil'),
				intro: "Anda dapat melihat ringaksan hasil akhir perhitungan pada laman ini"
			}, {
				element: document.querySelector('#sidebar-pengaturan'),
				intro: "Anda dapat mengelola pengaturan web app pada laman ini"
			}, {
				element: document.querySelector('#navbar-profil'),
				intro: "Menu profil anda"
			}]
		}).onbeforeexit(function () {
			return confirm("Keluar dari intro?");
		}).start();
	}

	// choices
	if(document.getElementById("choices-button")){
		new Choices(document.getElementById("choices-button"), {});
	}

	$(document).ready(function () {
		// datatables
		$('table.table').each(function () {
			$('#'+$(this).attr('id')).DataTable({
				"language": {
					"emptyTable": '<div class="text-center p-4">' +
						'<img class="mb-3" src="<?= base_url() ?>assets/svg/illustrations/sorry.svg" alt="Image Description" style="width: 7rem;">' +
						'<p class="mb-0">Tidak ada data untuk ditampilkan</p>' +
						'</div>'
				},
				"scrollX": true,
				"responsive": true
			});
		});

		//  ckeditor
		$('textarea.editor').each(function () {
			CKEDITOR.replace($(this).attr('id'));
		});

		// select2
		$('.select2').select2();

		$('form', {
			onSubmit: data => {
				$('button[type=submit]').prop("disabled", true);
				// add spinner to button
				$('button[type=submit]').html(
					`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
				);
				return;
			}
		})
	})

	var win = navigator.platform.indexOf('Win') > -1;
	if (win && document.querySelector('#sidenav-scrollbar')) {
		var options = {
			damping: '0.5'
		}
		Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
	}

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
