<?php
    // ディレクトリパス定義
    $root_dir = "https://github.com/daicho/mahjong-club/raw/master/";
    $system_dir = $root_dir . urlencode("成績管理システム") . "/";
    $seiseki_dir = $system_dir . urlencode("成績") . "/";
    
    // ファイル読み込み
    $path = "ランキング.csv"; //$seiseki_dir . urlencode("ランキング") . ".csv?" . date("YmdHis");
    $temp_path = "temp/ランキング.csv";
    $contents = file_get_contents($path);

    if ($contents) {
        // シフトJIS→UTF-8に変換
        file_put_contents($temp_path, mb_convert_encoding($contents, "UTF-8", "SJIS"));

        $csv = new SplFileObject($temp_path);
        $csv->setFlags(SplFileObject::READ_CSV);

        // 配列に格納
        foreach ($csv as $row) {
            if (!is_null($row[0]))
                $data[] = $row;
        }
    }
?>

<!-- テーブル表示 -->
<?php foreach ($data as $row) { ?>
    <tr>
        <?php foreach ($row as $cell) { ?>
            <td><?= $cell ?></td>
        <?php } ?>
    </tr>
<?php } ?>
