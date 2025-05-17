<section role="main">
    <header class="page-header">
        <h2>Maç Güncelle</h2>
    </header>
    <section class="card">
        <header class="card-header">
            <h2 class="card-title">Yeni Maç Ekle</h2>
        </header>
        <div class="card-body">
<!--            <form action="/addMatch" method="POST">-->

            <?php

            if (isset($_POST["addMatch"])) {

                $sport_type = $_POST['sport_type'];
                $country = $_POST['country'];
                $league = $_POST['league'];
                $home_team = $_POST['home_team'];
                $away_team = $_POST['away_team'];
                $match_result = $_POST['match_result'];
                $goal_detail = $_POST['goal_detail'];
                $match_datetime = $_POST['match_datetime'];

                do {
                    $rand_id = mt_rand(100000, 999999);
                    $checkQuery = $db->query("SELECT * FROM manual_matches WHERE match_id = '$rand_id'");
                } while($checkQuery->num_rows > 0); // ID benzersiz olana kadar tekrarla

                $match_id = $rand_id;

                $odd_1 = $_POST['odd_1'];
                $odd_x = $_POST['odd_x'];
                $odd_2 = $_POST['odd_2'];

                $sqlAlter1 = $db -> prepare('ALTER TABLE manual_matches DROP id');
                $sqlAlter1 -> execute();
                $sqlAlter2 = $db -> prepare('ALTER TABLE manual_matches ADD id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST');
                $sqlAlter2 -> execute();

                $sqlAlter3 = $db -> prepare('ALTER TABLE odds DROP id');
                $sqlAlter3 -> execute();
                $sqlAlter4 = $db -> prepare('ALTER TABLE odds ADD id INT NOT NULL  AUTO_INCREMENT PRIMARY KEY FIRST');
                $sqlAlter4 -> execute();

                $sqlMatchAdd = $db -> prepare('INSERT INTO manual_matches SET match_id = :match_id, sport_id = :sport_id, country_id = :country_id, league_id = :league_id, home_team = :home_team, away_team = :away_team, match_result = :match_result, goal_detail = :goal_detail, match_datetime = :match_datetime');
                $sqlMatchAddResult = $sqlMatchAdd -> execute([
                    'match_id' => $match_id,
                    'sport_id' => $sport_type,
                    'country_id' => $country,
                    'league_id' => $league,
                    'home_team' => $home_team,
                    'away_team' => $away_team,
                    'match_result' => $match_result,
                    'goal_detail' => $goal_detail,
                    'match_datetime' => $match_datetime,
                ]);

                if ($sqlMatchAddResult) {
                    $db->query("INSERT INTO odds (match_id, odd_type, value) VALUES ('$match_id', '1', '$odd_1'), ('$match_id', 'X', '$odd_x'), ('$match_id', '2', '$odd_2')");
                } else {
                    die("Ekleme hatası: " . $db->error); // Eğer bir hata varsa ekrana yazdırın
                }

            }

            if (isset($_POST['manual_match_delete'])) {
                $manual_match_id = $_POST['manual_match_id'];

                if (!empty($manual_match_id)) {
                    $sqlManualMatchDelete = $db -> prepare('DELETE FROM manual_matches WHERE id = :id');
                    $sqlManualMatchDeleteResult = $sqlManualMatchDelete -> execute([
                            'id' => $manual_match_id
                    ]);
                    if (!$sqlManualMatchDeleteResult) {
                        die("Silme hatası: " . $db->error); // Eğer bir hata varsa ekrana yazdırın
                    }
                }

            }

            ?>

            <form action="<?php echo SITE_URL; ?>/addMatch" method="POST">
                <div class="row">
                    <!-- Spor Türü -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Spor Türü</label>
                            <select class="form-control" name="sport_type" required>
                                <?php foreach ($sports as $index => $sport) { ?>
                                <option value="<?php echo $sport['id']; ?>"><?php echo $sport['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>


                    <!-- Ülke Seçimi -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ülke</label>
                            <select class="form-control" name="country" required>
                                <?php foreach ($ulkeler as $index => $ulke) { ?>
                                <option value="<?php echo $ulke['id']; ?>"><?php echo $ulke['name']; ?></option>
                                <?php } ?>
                                <!-- Diğer ülkeler eklenebilir -->
                            </select>
                        </div>
                    </div>

                    <!-- Lig Seçimi -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Lig</label>
                            <select class="form-control" name="league" required>
                                <?php foreach ($ligler as $index => $lig) { ?>
                                <option value="<?php echo $lig['id']; ?>"><?php echo $lig['name']; ?></option>
                                <?php } ?>
                                <!-- Diğer ligler eklenebilir -->
                            </select>
                        </div>
                    </div>

                    <!-- Maç Sonucu -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Maç Sonucu</label>
                            <input type="text" class="form-control" name="match_result" placeholder="Ör: 2-1" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Ev Sahibi Takım -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ev Sahibi Takım</label>
                            <input type="text" class="form-control" name="home_team" required>
                        </div>
                    </div>

                    <!-- Misafir Takım -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Misafir Takım</label>
                            <input type="text" class="form-control" name="away_team" required>
                        </div>
                    </div>

                    <!-- Gol Atan Takım ve Dakika -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Gol Atan Takım ve Dakika</label>
                            <input type="text" class="form-control" name="goal_detail"
                                placeholder="Ör: Ev Sahibi,25;Misafir,45;Ev Sahibi,60" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Maç Tarihi ve Saati</label>
                            <input type="datetime-local" class="form-control" name="match_datetime" required>
                        </div>
                    </div>

                    <!-- Ev Sahibi Kazanır Oranı -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ev Sahibi Kazanır (1)</label>
                            <input type="text" class="form-control" name="odd_1" required>
                        </div>
                    </div>

                    <!-- Beraberlik Oranı -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Beraberlik (X)</label>
                            <input type="text" class="form-control" name="odd_x" required>
                        </div>
                    </div>

                    <!-- Misafir Kazanır Oranı -->
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Misafir Kazanır (2)</label>
                            <input type="text" class="form-control" name="odd_2" required>
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
<!--                            <button class="mb-1 mt-1 mr-1 btn btn-success btn-block" type="submit" name="addMatch" data-action="addMatch">Maçı Ekle</button>-->
                            <input type="submit" class="mb-1 mt-1 mr-1 btn btn-success btn-block" name="addMatch">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>


<!--    <section class="card">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-12">-->
<!--                    <table class="table table-bordered">-->
<!--                        <thead>-->
<!--                        <tr>-->
<!--                            <th scope="col">Maç Id</th>-->
<!--                            <th scope="col">Sport Id</th>-->
<!--                            <th scope="col">Ülke Id</th>-->
<!--                            <th scope="col">Lig Id</th>-->
<!--                            <th scope="col">Maç Sonuç</th>-->
<!--                            <th scope="col">Ev Sahibi</th>-->
<!--                            <th scope="col">Deplasman</th>-->
<!--                            <th scope="col">Gol Durumu</th>-->
<!--                            <th scope="col">Maç Zamanı</th>-->
<!--                            <th scope="col">Actions</th>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!---->
<!--                        --><?php
//
//                            $sqlFindManualMatch = $db -> prepare('SELECT * FROM manual_matches');
//                            $sqlFindManualMatch -> execute();
//                            $sqlFindManualMatchResult = $sqlFindManualMatch -> fetchAll(PDO::FETCH_ASSOC);
//
//                        ?>
<!--                        --><?php //foreach ($sqlFindManualMatchResult as $manualMatches) : ?>
<!--                            <tr>-->
<!--                                <th scope="row">--><?php //=$manualMatches['match_id']?><!--</th>-->
<!--                                <td>--><?php //=$manualMatches['sport_id']?><!--</td>-->
<!--                                <td>--><?php //=$manualMatches['country_id']?><!--</td>-->
<!--                                <td>--><?php //=$manualMatches['league_id']?><!--</td>-->
<!--                                <th scope="row">--><?php //=$manualMatches['match_result']?><!--</th>-->
<!--                                <td>--><?php //=$manualMatches['home_team']?><!--</td>-->
<!--                                <td>--><?php //=$manualMatches['away_team']?><!--</td>-->
<!--                                <td>--><?php //=$manualMatches['goal_detail']?><!--</td>-->
<!--                                <td>--><?php //=$manualMatches['match_datetime']?><!--</td>-->
<!--                                <td>-->
<!--                                    <form action="" method="post">-->
<!--                                        <input class="btn btn-sm btn-primary" type="hidden" name="manual_match_id" value="--><?php //=$manualMatches['id'];?><!--">-->
<!--                                        <button type="submit" name="manual_match_edit" class="btn btn-success"><i class="fas fa-edit"></i></button>-->
<!--                                    </form>-->
<!--                                    <br>-->
<!--                                    <form action="" method="post">-->
<!--                                        <input class="btn btn-sm btn-primary" type="hidden" name="manual_match_id" value="--><?php //=$manualMatches['id'];?><!--">-->
<!--                                        <button type="submit" name="manual_match_delete" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>-->
<!--                                    </form>-->
<!--                                </td>-->
<!--                            </tr>-->
<!--                        --><?php //endforeach;?>
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->

</section>