<?php
    class Config
    {   
        /**
         * ルートディレクトリ
         * 各ソースの先頭でrequire_once(このクラスに対する相対パス）
         * ファイルをrequire_once()する時、Config::APP_ROOT_DIR.パスとする
         */
        const APP_ROOT_DIR = "C:".DIRECTORY_SEPARATOR."xampp".DIRECTORY_SEPARATOR."htdocs".DIRECTORY_SEPARATOR."calender".DIRECTORY_SEPARATOR;//スラッシュいらない

        /**
         * 以下、DB接続用
         *  @var string ユーザー名*/
        const CONFIG_USER = 'root';
    
        /** @var string データベース名、ホスト名、文字コード
         */
        const CONFIG_DSN = 'mysql:dbname=calender;host=localhost;charset=utf8';
        
        /**　@var string パスワード 設定なし*/
        const CONFIG_PASSWORD = '';
    }
?>