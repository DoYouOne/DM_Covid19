<html>
<head>
    <title>Clusterring Data Covid 19</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="col-md-12">
        <h3 align="center" style="padding-top:2%;">Data Covid-19 di Berbagai Negara</h3>
        <h5 align="center">
            <?php foreach($dc as $d) ?>
            Diperbarui pada : <?= $d->tgl ?>
        </h5><br>
    </div>
    <div class="container">
        <div class="col-md-12">
        <form action="<?= site_url('covid/perbarui') ?>" method="post">
            <div class="row">
                <div class="col-sm-6">
                    <button class="btn btn-primary" name="tombol">Perbarui Data!</button>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-2">
                    <h5>Jumlah Data : <?= $co ?></h5><br>
                </div>
            </div>
            <?php
                function curl($url){
                    $ch = curl_init(); 
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
                    $output = curl_exec($ch);
                    curl_close($ch);
                    return $output;
                }

                $curl = curl("https://api.apify.com/v2/key-value-stores/tVaYRsPHLjNdNBu7S/records/LATEST?disableRedirect=true%22");

                // mengubah JSON menjadi array
                $data = json_decode($curl, TRUE);

                $no = 1;
            ?>

            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Negara</th>
                    <th>Kasus</th>
                    <th>Terkonfirmasi</th>
                    <th>Sembuh</th>
                    <th>Meninggal Dunia</th>

                </tr>
                <?php foreach($data as $row){ ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td>
                        <?php echo $row["country"]; ?>
                        <input type="hidden" value="<?= $row["country"]?>" name="country[]">
                    </td>
                    <td>
                        <?php 
                            if($row["infected"] != 0){
                                echo number_format($row["infected"]);
                            }
                            else{
                                echo "-";
                            }
                        ?>
                        <input type="hidden" value="<?= $row["infected"]?>" name="infected[]">
                    </td>
                    <td>
                        <?php 
                            if($row["tested"] != 0){
                                echo number_format($row["tested"]);
                            }
                            else{
                                echo "-";
                            }
                        ?>
                        <input type="hidden" value="<?= $row["tested"]?>" name="tested[]">
                    </td>
                    <td>
                        <?php 
                            if($row["recovered"] != 0){
                                echo number_format($row["recovered"]);
                            }
                            else{
                                echo "-";
                            }
                        ?>
                        <input type="hidden" value="<?= $row["recovered"]?>" name="recovered[]">
                    </td>
                    <td>
                    <?php 
                            if($row["deceased"] != 0){
                                echo number_format($row["deceased"]);
                            }
                            else{
                                echo "-";
                            }
                        ?>
                        <input type="hidden" value="<?= $row["deceased"]?>" name="deceased[]">
                    </td>
                </tr>
                <?php } ?>
            </table>
        </form>
        </div>
    </div>
    <script>
	function toggleMenu() {
		var menuItems = document.getElementsByClassName('menu-item');
		for (var i = 0; i < menuItems.length; i++) {
			var menuItem = menuItems[i];
			menuItem.classList.toggle("number");
		}
	}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

</body>
</html>