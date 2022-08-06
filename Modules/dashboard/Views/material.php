<h1>Material</h1>

<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5>List Material</h5>
        </div>
        <div class="float-end">
            <?= ($group_name == 'admin') ? '<button onclick="tambahMaterial()" class="btn btn-sm btn-primary">Tambah</button>' : null ?>
        </div>
    </div>
    <div class="card-body">
        <table id="table-material" class="stripe hover">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Stok</th>
                    <?= ($group_name == 'admin') ? '<th>Aksi</th>' : null ?>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1">

</div>

<script>
    $(document).ready(function() {
        $('#table-material').DataTable({
            searching: true,
            responsive: true,
            ajax: "<?= base_url('material/list_material'); ?>"
        })
    })

    function tambahMaterial() {
        $.ajax({
            url: "<?= base_url('material/formTambahMaterial') ?>",
            method: 'POST',
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            }
        })
    }

    function edit(id) {
        $.ajax({
            url: "<?= base_url('material/formTambahMaterial/edit') ?>",
            method: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            }
        })
    }

    function modalHapus(id) {
        $.ajax({
            url: "<?= base_url('material/modalHapus') ?>/" + id,
            method: 'GET',
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            }
        })
    }

    function hapus(id) {
        $.ajax({
            url: "<?= base_url('material/delete') ?>/" + id,
            method: 'GET',
            success: function(data) {
                location.reload()
            }
        })
    }
</script>