<?php
// $Id: admin.php,v 1.49 2005/03/13 12:59:35 hthouzard Exp $
//%%%%%%	Admin Module Name  Articles 	%%%%%
define("_AM_DBUPDATED","データベースを更新しました");
define("_AM_CONFIG","ニュース 設定");
define("_AM_AUTOARTICLES","掲載予定の記事");
define("_AM_STORYID","ニュース記事ID");
define("_AM_TITLE","表題");
define("_AM_TOPIC","トピック");
define("_AM_POSTER","投稿者");
define("_AM_PROGRAMMED","掲載予定日時");
define("_AM_ACTION","管理");
define("_AM_EDIT","編集");
define("_AM_DELETE","削除");
define("_AM_LAST10ARTS","最新 %d ニュース記事");
define("_AM_PUBLISHED","掲載日時"); // Published Date
define("_AM_GO","送信");
define("_AM_EDITARTICLE","ニュース記事を編集");
define("_AM_POSTNEWARTICLE","新規ニュース記事作成");
define("_AM_ARTPUBLISHED","ニュース記事が掲載されました");
define("_AM_HELLO","%sさん、こんにちは");
define("_AM_YOURARTPUB","あなたが投稿したニュース記事が、当サイトにて正式掲載されました。");
define("_AM_TITLEC","表題：");
define("_AM_URLC","URL：");
define("_AM_PUBLISHEDC","掲載日時：");
define("_AM_RUSUREDEL","このニュース記事および記事に対するコメントを全て削除してもいいですか？");
define("_AM_YES","はい");
define("_AM_NO","いいえ");
define("_AM_INTROTEXT","本文");
define("_AM_EXTEXT","本文２");
define("_AM_ALLOWEDHTML","使用可能なHTMLタグ：");
define("_AM_DISAMILEY","顔アイコンを無効にする");
define("_AM_DISHTML","HTMLタグを無効にする");
define("_AM_APPROVE","承認");
define("_AM_MOVETOTOP","この記事をトップページ最上部に移動する");
define("_AM_CHANGEDATETIME","掲載日時を変更する");
define("_AM_NOWSETTIME","現在の掲載予定日時： %s"); // %s is datetime of publish
define("_AM_CURRENTTIME","現在時間： %s");  // %s is the current datetime
define("_AM_SETDATETIME","掲載日時を設定する");
define("_AM_MONTHC","月：");
define("_AM_DAYC","日：");
define("_AM_YEARC","年：");
define("_AM_TIMEC","時間：");
define("_AM_PREVIEW","プレビュー");
define("_AM_SAVE","保存");
define("_AM_PUBINHOME","トップページに掲載する");
define("_AM_ADD","追加");

//%%%%%%	Admin Module Name  Topics 	%%%%%

define("_AM_ADDMTOPIC","メイントピックの作成");
define("_AM_TOPICNAME","トピック名");
// Warning, changed from 40 to 255 characters.
define("_AM_MAX40CHAR","（最大255文字（半角））");
define("_AM_TOPICIMG","トピック画像");
define("_AM_IMGNAEXLOC","%s 下にある画像ファイル名");
define("_AM_FEXAMPLE","例： games.gif");
define("_AM_ADDSUBTOPIC","サブトピックの作成");
define("_AM_IN","親トピック：");
define("_AM_MODIFYTOPIC","トピックの編集");
define("_AM_MODIFY","送信");
define("_AM_PARENTTOPIC","親トピック");
define("_AM_SAVECHANGE","変更を保存");
define("_AM_DEL","削除");
define("_AM_CANCEL","キャンセル");
define("_AM_WAYSYWTDTTAL","このトピックおよびこのトピック内の全てのニュース記事およびコメントを削除してもいいですか？");


// Added in Beta6
define("_AM_TOPICSMNGR","トピック管理メニュー");
define("_AM_PEARTICLES","ニュース記事の投稿／編集");
define("_AM_NEWSUB","新規投稿ニュース");
define("_AM_POSTED","投稿日時");
define("_AM_GENERALCONF","一般設定");

// Added in RC2
define("_AM_TOPICDISPLAY","トピック画像を表示");
define("_AM_TOPICALIGN","位置");
define("_AM_RIGHT","右側");
define("_AM_LEFT","左側");

define("_AM_EXPARTS","期限切れ記事");
define("_AM_EXPIRED","期限切れ");
define("_AM_CHANGEEXPDATETIME","有効期限を変更する");
define("_AM_SETEXPDATETIME","有効期限を設定する");
define("_AM_NOWSETEXPTIME","現在設定されている期限： %s");

// Added in RC3
define("_AM_ERRORTOPICNAME", "トピック名が記入されていません。");
define("_AM_EMPTYNODELETE", "削除できません");

// Added 240304 (Mithrandir)
define('_AM_GROUPPERM', '投稿・承認・参照の権限');
define('_AM_SELFILE','アップロードファイルの選択');

// Added by Herv釥��
define('_AM_UPLOAD_DBERROR_SAVE','ニュース記事にファイルを添付するのにエラーが発生しました。');
define('_AM_UPLOAD_ERROR','ファイル更新にエラーが発生しました。');
define('_AM_UPLOAD_ATTACHFILE','添付ファイル');
define('_AM_APPROVEFORM', '承認の権限');
define('_AM_SUBMITFORM', '投稿の権限');
define('_AM_VIEWFORM', '閲覧の権限');
define('_AM_APPROVEFORM_DESC', '承認者の選択');
define('_AM_SUBMITFORM_DESC', '投稿者の選択');
define('_AM_VIEWFORM_DESC', '閲覧者の選択');
define('_AM_DELETE_SELFILES', '選択したファイルの削除');
define('_AM_TOPIC_PICTURE', '画像のアップロード');
define('_AM_UPLOAD_WARNING', '<B>警告:, 以下のフォルダーに対するアクセス権を必ず設定してください。: %s</B>');

define('_AM_NEWS_UPGRADECOMPLETE', 'アップグレードが完了しました。');
define('_AM_NEWS_UPDATEMODULE', 'モジュールとテンプレートのアップデート');
define('_AM_NEWS_UPGRADEFAILED', 'アップグレード失敗！！');
define('_AM_NEWS_UPGRADE', 'アップグレード');
define('_AM_ADD_TOPIC','トピック追加');
define('_AM_ADD_TOPIC_ERROR','エラー:トピックが既に存在します');
define('_AM_ADD_TOPIC_ERROR1','エラー:このトピックは親トピックとして選択できません');
define('_AM_SUB_MENU','このトピックをサブメニューとして公開する');
define('_AM_SUB_MENU_YESNO','サブメニューですか?');
define('_AM_HITS', 'ヒット数');
define('_AM_CREATED', '作成済み');

define('_AM_TOPIC_DESCR', "トピックの概要");
define('_AM_USERS_LIST', "ユーザーリスト");
define('_AM_PUBLISH_FRONTPAGE', "フロントページに公開しましすか?");
define('_AM_NEWS_UPGRADEFAILED1', 'stories_filesテーブルの作成失敗');
define('_AM_NEWS_UPGRADEFAILED2', "トピックタイトル長の変更失敗");
define('_AM_NEWS_UPGRADEFAILED21', "topicsテーブルへの新規フィールド追加失敗");
define('_AM_NEWS_UPGRADEFAILED3', 'stories_votedataテーブルの作成失敗');
define('_AM_NEWS_UPGRADEFAILED4', "storyテーブルへの'rating'、'votes'フィールド追加失敗");
define('_AM_NEWS_UPGRADEFAILED0', "メッセージに注意して、ニュースモジュールの'sql'フォルダーで利用可能なsql定義ファイルに関する問題をphpMyadminで修正するようにしてください。");
define('_AM_NEWS_UPGR_ACCESS_ERROR',"エラー: このモジュールの管理権限がないとこのスクリプトを利用出来ません");
define('_AM_NEWS_PRUNE_BEFORE',"以前公開されたニュース記事取り除く");
define('_AM_NEWS_PRUNE_EXPIREDONLY',"終了したニュース記事のみを取り除く");
define('_AM_NEWS_PRUNE_CONFIRM',"警告: %s以前に公開されたニュース記事永久に取り除こうとしてます。(このアクションは取り消せません)%s ストーリーを示してます。<br />本当にやりますか ?");
define('_AM_NEWS_PRUNE_TOPICS',"以下のトピックスの制限");
define('_AM_NEWS_PRUNENEWS', 'ニュースを取り除く');
define('_AM_NEWS_EXPORT_NEWS', 'ニュースをエクスポート');
define('_AM_NEWS_EXPORT_NOTHING', "エクスポートするものがありません。 条件について確かめてください。");
define('_AM_NEWS_PRUNE_DELETED', '%d 個のニュースが削除されました');
define('_AM_NEWS_PERM_WARNING', '<h2>警告: 3つのフォームがあるので、3個の送信ボタンがあります。</h2>');
define('_AM_NEWS_EXPORT_BETWEEN', 'ニュースの日付（公開日付）を指定');
define('_AM_NEWS_EXPORT_AND', ' 及び ');
define('_AM_NEWS_EXPORT_PRUNE_DSC', "チェックしたトピックのみが使用されます。<br/>何もチェックしないとすべてのトピックスが使用されます。");
define('_AM_NEWS_EXPORT_INCTOPICS', 'トピックの定義を取り込みますか？');
define('_AM_NEWS_EXPORT_ERROR', 'ファイル %s の作成試行中にエラーが発生しました。 操作は停止されました。');
define('_AM_NEWS_EXPORT_READY', "XML エクスポートファイルの準備が出来ました。 <br /><a href='%s'>ここをクリックしてダウンロードしてください。</a><br />ダウンロードし終えた後<a href='%s'>削除する</a>のを忘れないでください。");
define('_AM_NEWS_RSS_URL', "RSS送信のURL");
define('_AM_NEWS_NEWSLETTER', "ニュースレター");
define('_AM_NEWS_NEWSLETTER_BETWEEN', 'ニュースの日付（公開日付）を指定');
define('_AM_NEWS_NEWSLETTER_READY', "ニュースレターファイルの準備が出来ました。 <br /><a href='%s'>ここをクリックしてダウンロードしてください。</a>.<br />ダウンロードし終えた後<a href='%s'>削除する</a>のを忘れないでください。");
define('_AM_NEWS_DELETED_OK','ファイルの削除に成功しました');
define('_AM_NEWS_DELETED_PB','そのファイル削除中に問題発生');
define('_AM_NEWS_STATS0','トピックスの統計');
define('_AM_NEWS_STATS','統計');
define('_AM_NEWS_STATS1','投稿者');
define('_AM_NEWS_STATS2','総数');
define('_AM_NEWS_STATS3','記事の統計');
define('_AM_NEWS_STATS4','もっとも読まれた記事');
define('_AM_NEWS_STATS5','もっとも読まれなかった記事');
define('_AM_NEWS_STATS6','もっとも評価の高い記事');
define('_AM_NEWS_STATS7','もっとも読まれた投稿者');
define('_AM_NEWS_STATS8','もっとも評価の高い投稿者');
define('_AM_NEWS_STATS9','もっとも貢献度大きい投稿者');
define('_AM_NEWS_STATS10','投稿者の統計');
define('_AM_NEWS_STATS11','記事数');
define('_AM_NEWS_HELP','ヘルプ');
define('_AM_NEWS_MODULEADMIN','モジュール管理');
define('_AM_NEWS_GENERALSET', "モジュール設定" );
define('_AM_NEWS_GOTOMOD','モジュールへ');
define('_AM_NEWS_NOTHING',"ダウンロードするものがありません。 条件について確かめてください。");
define('_AM_NEWS_NOTHING_PRUNE',"削除するニュースがありません。 条件について確かめてください。");
define('_AM_NEWS_TOPIC_COLOR','トピックスの色');
define('_AM_NEWS_COLOR','色');
define('_AM_NEWS_REMOVE_BR',"&lt;br&gt; タグを改行に変換しましすか?");
// Added in 1.3 RC2
define('_AM_NEWS_PLEASE_UPGRADE',"<a href='upgrade.php'><font color='#FF0000'>モジュールのアップグレード処理をしてください!</font></a>");
?>