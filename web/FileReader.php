<?php
    class FileReader {
        protected $root;

        public function __construct($root) {
            $this->root = $root;
        }

        // テキストファイルを読み込み
        public function loadText($path) {
            $url = $this->root . $path . "?" . date("YmdHis");
            return mb_convert_encoding(file_get_contents($url), "UTF-8", "SJIS-win");
        }

        // テキストファイルを配列で読み込み
        public function loadLines($path) {
            // シフトJIS→UTF-8に変換
            $temp_path = "temp/" . rand() . ".csv";
            file_put_contents($temp_path, $this->loadText($path));

            $data = file($temp_path, FILE_IGNORE_NEW_LINES);
            unlink($temp_path);
            return $data;
        }

        // CSVファイルを読み込み
        public function loadCSV($path) {
            // シフトJIS→UTF-8に変換
            $temp_path = "temp/" . rand() . ".csv";
            file_put_contents($temp_path, $this->loadText($path));

            $csv = new SplFileObject($temp_path);
            $csv->setFlags(SplFileObject::DROP_NEW_LINE | SplFileObject::READ_CSV);

            // 配列に格納
            foreach ($csv as $row)
                if (!is_null($row[0]))
                    $data[] = $row;

            unlink($temp_path);
            return $data;
        }
    }
