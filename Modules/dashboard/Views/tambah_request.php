<h1>Tambah Request</h1>

<div class="card">
    <div class="card-header">
        Buat Material Request
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td id="nama">:<?= $request_by ?></td>
                        </tr>
                        <tr>
                            <td>Region</td>
                            <td>:<?= $region ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>:<?= date('l, d F Y', $tanggal) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row p-2 m-5">
            <div>
                <button class="btn btn-sm btn-success float-end" onclick="formTambahMaterial()">Tambah Material</button>
            </div>
            <table class="table table-striped" id="keranjang">
                <thead>
                    <tr>
                        <th>Nama Material</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button onclick="kirim()" class=" btn btn-sm btn-primary float-end">Kirim <i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>
<div class="modal" tabindex="-1">

</div>
<script>
    function formTambahMaterial() {
        $.ajax({
            url: "<?= base_url('request/formTambahMaterial') ?>",
            method: "GET",
            success: function(data) {
                $('.modal').html(data);
                $('.modal').modal('show');
            }
        })
    }
    material = <?= $material ?>

    function tambahBaris() {
        let id_material = $('#material').val();
        let jumlah = $('#jumlah').val();
        // $('.modal').html('');
        // $('.modal').modal('hide');
        $('#keranjang').find('tbody').append('<tr id="list-keranjang"><td id-data=' + id_material + '>' + material[id_material] + '</td> <td><input type="number" class="w-25" min=1 value="' + jumlah + '"><button onclick="hapusRowKeranjang(this)" class="btn btn-sm btn-danger ms-3"><i class="fa-solid fa-trash"></i></button></td> </tr>')
        // alert('asdkjas')

    }

    function hapusRowKeranjang(params) {
        $(params).parents('tr').remove();
    }

    function kirim() {
        var data = Array();
        $("#keranjang tbody tr").each(function(i, v) {
            data[i] = Array();
            $(this).children('td').each(function(ii, vv) {
                if (ii == 0) {
                    data[i][ii] = $(this).attr('id-data');
                } else {
                    data[i][ii] = $(this).children('input').val();
                }
            });
        })
        $.ajax({
            url: "<?= base_url('request/save') ?>",
            data: {
                nama: $('#nama').text(),
                tanggal: <?= $tanggal ?>,
                keranjang: JSON.stringify(data)
            },
            method: 'POST',
            success: function(html) {
                back();
            }
        })
    }

    function back() {
        location.href = "<?= base_url('request') ?>"
    }
</script>