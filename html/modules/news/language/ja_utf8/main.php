<?php
// $Id: main.php,v 1.40 2005/03/13 12:59:36 hthouzard Exp $
//%%%%%%		File Name index.php 		%%%%%
define("_NW_NEWSRELEASE","ニュースリリース");
define("_NW_ALLTOPIC","すべてのトピック");
define("_NW_NEWARRIVAL","最新ニュース・トピック別");
define("_NW_ARCHIVE","アーカイブ（発行年月別）");
define("_NW_SELECTTOPIC","トピックごとに表示する ");
define("_NW_SELECT","表示 ");
define("_NW_PRINTER","印刷用ページ");
define("_NW_SENDSTORY","このニュースを友達に送る");
define("_NW_READMORE","続き...");
define("_NW_COMMENTS","コメントする");
define("_NW_ONECOMMENT","1コメント");
define("_NW_BYTESMORE","残り%sバイト");
define("_NW_NUMCOMMENTS","%sコメント");
define("_NW_MORERELEASES","もっと記事...");
define('_NW_GOTOMODULEADMIN','モジュール管理画面');


//%%%%%%		File Name submit.php		%%%%%
define("_NW_SUBMITNEWS","ニュース投稿");
define("_NW_TITLE","表題");
define("_NW_TOPIC","トピック");
define("_NW_THESCOOP","メッセージ本文");
define("_NW_NOTIFYPUBLISH","ニュースが承認された旨をメールで受け取る");
define("_NW_POST","投稿する");
define("_NW_GO","送信");
define("_NW_THANKS","投稿を受付けました。当サイトスタッフによる承認を経た後に正式掲載となることをご了承ください。"); //submission of news article
define("_NW_THANKS_APPROVE","投稿を受付けました。本記事は、掲載許可済です。");

define("_NW_NOTIFYSBJCT","NEWS for my site"); // Notification mail subject
define("_NW_NOTIFYMSG","新規ニュースの投稿がありました。"); // Notification mail message

//%%%%%%		File Name archive.php		%%%%%
define("_NW_NEWSARCHIVES","ニュースアーカイブ");
define("_NW_YEARC","年");
define("_NW_NEWS_OF","のニュース");
define("_NW_NEWSLIST_OF","のニュース");
define("_NW_ARTICLES","ニュース");
define("_NW_VIEWS","ヒット");
define("_NW_DATE","掲載日");
define("_NW_ACTIONS","");
define("_NW_PRINTERFRIENDLY","印刷用ページ");

define("_NW_THEREAREINTOTAL","計 %s件のニュース記事があります");

// %s is your site name
define("_NW_INTARTICLE","%sで見つけた興味深いニュース");
define("_NW_INTARTFOUND","以下は%sで見つけた非常に興味深いニュース記事です：");

define("_NW_TOPICC","トピック：");
define("_NW_URL","URL：");
define("_NW_NOSTORY","選択されたニュース記事は存在しません");

//%%%%%%	File Name print.php 	%%%%%

define("_NW_URLFORSTORY","このニュース記事が掲載されているURL：");

// %s represents your site name
define("_NW_THISCOMESFROM","%sにて更に多くのニュース記事をよむことができます");

// Added by Herv・
define("_NW_ATTACHEDFILES","添付ファイル:");
define("_NW_ATTACHEDLIB","添付ファイル有り");
define("_NW_NEWSSAMEAUTHORLINK","この投稿者の記事");
define("_NW_NEWS_NO_TOPICS","申し訳ありません。トピックが一つもまだありません。記事を投稿する前にトピックを作成してください。");
define("_NW_PREVIOUS_ARTICLE","前へ");
define("_NW_NEXT_ARTICLE","次へ");
define("_NW_OTHER_ARTICLES","他の記事");

// Added by Herv・in version 1.3 for rating
define("_NW_RATETHISNEWS","投票する");
define("_NW_RATEIT","評価する!");
define("_NW_TOTALRATE","総評価");
define("_NW_RATINGLTOH","評価 (最低評価から最高評価)");
define("_NW_RATINGHTOL","評価 (最高評価から最低評価)");
define("_NW_RATINGC","評価: ");
define("_NW_RATINGSCALE","1 - 10の間で指定してください、最低評価は 1 、最高評価なら 10　とします");
define("_NW_BEOBJECTIVE","客観的な評価でお願いします。もしもすべて 1 または 10だけなら, 評価としては余り役に立ちません。");
define("_NW_DONOTVOTE","あなたご自身が投稿したの記事は評価できません。");
define("_NW_RATING","評価");
define("_NW_VOTE","投票");
define("_NW_NORATING","評価点が選択されていません。");
define("_NW_USERAVG","平均評価");
define("_NW_DLRATINGS","全記事評価 (総投票数: %s)");
define("_NW_ONEVOTE","1 投票");
define("_NW_NUMVOTES","%u 投票");// Warning
define("_NW_CANTVOTEOWN","あなたはこの記事に投票することはできません.<br />すべての投票は記録されて評価されます。");
define("_NW_VOTEDELETED","投票データを削除しました。");
define("_NW_VOTEONCE","同じ記事への投票は１回だけしかできません。");
define("_NW_VOTEAPPRE","あなたの投票は受理されました。");
define("_NW_THANKYOU","お忙しいところ、ここ「 %s 」の記事に投票して頂きまして、ありがとうございます。"); // %s is your site name
define("_NW_RSSFEED","RSS送信");// Warning, this text is included insided an Alt attribut (for a picture), so take care to the quotes
define("_NW_AUTHOR","投稿者");
define("_NW_META_DESCRIPTION","ページdescriptionメタタグに挿入する文字");
define("_NW_META_KEYWORDS","ページkeywordsメタタグに挿入する文字");
define("_NW_MAKEPDF","記事をPDFにする");
define('_MD_POSTEDON',"Posted on : ");
define("_NW_AUTHOR_ID","投稿者のID");
define("_NW_POST_SORRY","すみません、トピックが無いか、投稿許可されたトピックが無いかのどちらかです。あなたがこのウェブマスターのであるなら、「アクセス権」の設定で'投稿可'を設定しに行ってください。");
?>