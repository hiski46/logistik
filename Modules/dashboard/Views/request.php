<h1>Request</h1>

<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5>List Material</h5>
        </div>
        <div class="float-end">
            <?php if ($group_name == 'members') { ?>
                <a href="<?= base_url('request/tambah') ?>" class="btn btn-sm btn-primary">Tambah</a>
            <?php } ?>
        </div>
    </div>
    <div class="card-body">
        <table id="table-request" class="stripe hover">
            <thead>
                <tr>
                    <th>Requester</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal" tabindex="-1">

</div>

<script>
    $(document).ready(function() {
        $('#table-request').DataTable({
            searching: true,
            responsive: true,
            ajax: "<?= base_url('request/list_request'); ?>"
        })
    })

    function keranjang(id_request) {
        $.ajax({
            url: "<?= base_url('request/keranjang') ?>/" + id_request,
            method: 'GET',
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            },
        })
    }

    function hapusRequest(id) {
        $.ajax({
            url: "<?= base_url('request/hapusRequest') ?>/" + id,
            method: 'GET',
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            },
        })
    }

    function hapus(id) {
        $.ajax({
            url: "<?= base_url('request/delete') ?>/" + id,
            method: 'GET',
            success: function(data) {
                if (data == true) {
                    location.reload()
                }
            }
        })
    }

    function approveRequest(id) {
        $.ajax({
            url: "<?= base_url('request/modalApproval') ?>/" + id + "/yes",
            method: 'GET',
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            }
        })
    }

    function rejectRequest(id) {
        $.ajax({
            url: "<?= base_url('request/modalApproval') ?>/" + id + "/no",
            method: 'GET',
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            }
        })
    }

    function approval(id, type) {
        $.ajax({
            url: "<?= base_url('request/approval') ?>/" + id + "/" + type,
            method: 'GET',
            success: function(data) {
                location.reload()
            }
        })
    }
</script>