<?php
    class FileReader {
        protected $root;
        protected $temp_path = "temp/temp";

        public function __construct($root) {
            $this->root = $root;
        }

        // テキストファイルを読み込み
        public function loadText($path) {
            $url = $this->root . $path . "?" . date("YmdHis");
            return file_get_contents($url);
        }

        // CSVファイルを読み込み
        public function loadCSV($path) {
            $url = $this->root . $path . "?" . date("YmdHis");
            $contents = file_get_contents($url);

            if ($contents) {
                // シフトJIS→UTF-8に変換
                file_put_contents($this->temp_path, mb_convert_encoding($contents, "UTF-8", "SJIS"));

                $csv = new SplFileObject($this->temp_path);
                $csv->setFlags(SplFileObject::READ_CSV);

                // 配列に格納
                foreach ($csv as $row) {
                    if (!is_null($row[0]))
                        $data[] = $row;
                }
            }

            return $data;
        }
    }
