<h1>Profile User</h1>

<div class="card">
    <div class="card-header">
        <div class="float-start">
            <h5><?= $user['username'] ?></h5>
        </div>
    </div>
    <div class="card-body">
        <table id="" class="">
            <tbody>
                <tr>
                    <td>Nama Awal</td>
                    <td>:<?= $user['first_name'] ?></td>
                </tr>
                <tr>
                    <td>Nama Akhir</td>
                    <td>:<?= $user['last_name'] ?></td>
                </tr>
                <tr>
                    <td>Region</td>
                    <td>:<?= $user['company'] ?></td>
                </tr>
                <tr>
                    <td>No HP</td>
                    <td>:<?= $user['phone'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>