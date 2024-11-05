<?php
class lists
{
    const jsonSrc = __DIR__.'/json/list.json';

    // JSON データを取得するメソッド
    function getJsonData(){
        $json = file_get_contents(self::jsonSrc);
        $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $records = json_decode($json, true);
        return $records;
    }

    // URI を分類するメソッド
    function classifyUri($removeUri){
        $salleeUri = $_SERVER['REQUEST_URI'];
        $resultUri = str_replace($removeUri, '', $salleeUri);
        $resultUriArray = explode('/', trim($resultUri, '/'));
        return $resultUriArray;
    }

    // JSON データを整えるメソッド
    protected function sortOutJson(){
        $arrayVanilla = $this->getJsonData();
        $classifiedUri = $this->classifyUri('/api');

        if (!empty($classifiedUri)) {
            // URI に応じたデータを抽出
            if (isset($classifiedUri[0]) && $classifiedUri[0] === 'list') {
                return $arrayVanilla;
            }
            // 他の条件（available や number など）もここに追加可能
        }

        return false;
    }

    // コンストラクタで JSON データを出力
    public function __construct(){
        $result = $this->sortOutJson();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}

// インスタンスを生成して API を実行
new lists();
?>
