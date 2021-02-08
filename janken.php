<?php
//定数の宣言
//グーチョキパーを定数で指定
const STONE = 0;
const SCISSORS = 1;
const PAPER = 2;

//ジャンケンの手を配列化
const HAND_TYPE = array(
    STONE => "グー",
    SCISSORS => "チョキ",
    PAPER => "パー",
);

//ジャンケン結果を定数で指定
const DRAW = 0;
const LOSE = 1;
const WIN = 2;
//勝敗結果を配列化
const RESULT = array(
    DRAW => "引き分けでした",
    LOSE => "負けました",
    WIN => "勝ちました！",
);

//再戦決定時の値を定数で指定
const REGAME_SELECT = 1;

//ゲーム内のテキストを定数化
const GAME_TEXT = "プログラムとジャンケンしましょう、[0:グー、1:チョキ、2:パー]から選んでください！"."\n";
const REGAME_TEXT = "もう一度ジャンケンしますか？ [1:再戦、1以外：やめる]"."\n";
const REGAME_START_TEXT = "それでは、[0:グー、1:チョキ、2:パー]から選んでください！"."\n";
const LAST_TEXT = "ジャンケン終了！"."\n";
const ERRER_TEXT_NULL = "入力が空です、再入力してください"."\n";
const ERRER_TEXT_INT = "入力が数字ではないです、再入力してください"."\n";
const ERRER_TEXT_LIMIT = "[0:グー、1:チョキ、2:パー]の3つの数字から選択してください"."\n";
const DRAW_TEXT ="あいこですね、もう一度。[0:グー、1:チョキ、2:パー]から選択してください"."\n";

// 関数の作成

// 入力値をバリデーションする関数を作成
function check($get_player_hand){
    //値が空でないことを確認
    if($get_player_hand === ""){
        echo ERRER_TEXT_NULL;
        return false;
    }
    // 値が数字であることを確認
    if(!preg_match('/^[0-9]+$/',$get_player_hand)){
        echo ERRER_TEXT_INT;
        return false;
    }
    // 選択した手が0～2の間になっているか
    if($get_player_hand < STONE || $get_player_hand > PAPER){
        echo ERRER_TEXT_LIMIT;
        return false;
    }
    return true; 
}

//標準入力処理を関数化
function player_hand(){
    $player_hand = trim(fgets(STDIN));
    if(check($player_hand) === false){
        return player_hand();
    }
    return $player_hand;
}

// プログラムのジャンケンの手を決定する関数
function Com_hand(){
    $com_hand = array_rand(HAND_TYPE);
    return $com_hand;
}

// ジャンケンの勝敗判定する処理
function judge($myhand,$pchand){
    $result = ($myhand - $pchand +3) % 3;
    return $result;
}

// 勝敗結果を表示する処理
function show($get_player_hand,$get_com_hand,$result){
    $player_hand = HAND_TYPE[$get_player_hand];
    $com_hand = HAND_TYPE[$get_com_hand];
    $show_result = RESULT[$result];
    echo sprintf("あなたは%s、PCは%sで%s",$player_hand,$com_hand,$show_result)."\n";
}

//再戦選択
function regame(){
    $regame_select = trim(fgets(STDIN));
    return $regame_select;
}

// ジャンケンの処理を関数化
function main(){
    $player_hand = Player_hand();
    $com_hand = Com_hand();
    $result = judge($player_hand,$com_hand);
    show($player_hand,$com_hand,$result);
    if($result == DRAW){
        echo DRAW_TEXT;
        return main();
    }
    echo REGAME_TEXT;
    if(regame() == REGAME_SELECT){
        echo REGAME_START_TEXT;
        main();
    }else{
    echo LAST_TEXT;
    }
}


//標準入力のじゃんけんの処理
echo GAME_TEXT;
main();
?>